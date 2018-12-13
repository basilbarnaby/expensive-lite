<?php

namespace App\Http\Controllers\API\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Core\User; 
use App\Http\Resources\User as UserResource; 
use App\Models\Globals\Oauth; 
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:api')->except(['userLogout']);
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        return Auth::guard('web')->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }

     /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        // $this->clearLoginAttempts($request);

        $user = User::where('email', $request->email)->first();
        $oauth = Oauth::findOrFail(2);

        if($oauth->password_client == true){
            $grantType = "password";
        }

        $http = new Client();

        $response = $http->post(url('oauth/token'), [
            'form_params' => [
                'grant_type' => $grantType,
                'client_id' => $oauth->id,
                'client_secret' => $oauth->secret,
                'username' => $request->email,
                'password' => $request->password,
                'scope' => '',
            ],
        ]);

        return response([
            'auth' => json_decode((string) $response->getBody(), true),
            'user' => new UserResource($user),
        ]);
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    public function userLogout(Request $request)
    {
        Auth::guard('web')->logout();
        // return redirect()->route('admin.dashboard');
    }
}