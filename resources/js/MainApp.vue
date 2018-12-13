<template>
  <div>
    <transition 
      name="component-fade" 
      mode="out-in">
      <router-view/>
    </transition>
    <vue-progress-bar/>
  </div>
</template>

<script>
export default {
	name: "MainApp",
};
</script>
