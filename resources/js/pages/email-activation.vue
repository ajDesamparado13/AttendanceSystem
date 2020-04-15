<template>
  <b-container class="bv-example-row" fluid>
    <div class="text-center center-spinner">
      <b-spinner variant="primary" type="grow" label="Spinning" v-if="loader"></b-spinner>
      <h3 class="danger">{{ msg }}</h3>
    </div>
  </b-container>
</template>
<script>
export default {
  data() {
    return {
      loader: true,
      msg: "Verifying your account..."
    };
  },
  mounted() {
    axios
      .get(`verify-user/${this.$route.params.token}`)
      .then(res => {
        this.loader = false;
        this.msg = "Email verified. You may now login.";
      })
      .catch(err => {
        this.loader = false;
        this.msg = err.response.data.message;
      });
  }
};
</script>
<style >
.center-spinner {
  margin-top: 250px;
}
</style>

