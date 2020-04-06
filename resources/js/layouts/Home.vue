<template>
  <div>
    <header>
      <b-navbar toggleable="lg" type="dark" variant="info">
        <b-navbar-brand href="/">Attendance System</b-navbar-brand>
        <b-button variant="success" to="/login">Login</b-button>
      </b-navbar>
    </header>
    <div>
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style scoped>
</style>