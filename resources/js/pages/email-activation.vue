<template>
  <b-container class="bv-example-row" fluid>
    <div class="text-center center-spinner">
      <b-spinner variant="primary" label="Spinning" v-if="loader"></b-spinner>
      <div style="width: 400px; margin: 5px auto;">
        <b-alert :variant="variant" show>{{ msg }}</b-alert>
      </div>
    </div>
  </b-container>
</template>
<script>
export default {
  data() {
    return {
      variant: "info",
      loader: true,
      msg: "Verifying your account..."
    };
  },
  mounted() {
    axios
      .get(`verify-user/${this.$route.params.token}`)
      .then(res => {
        this.variant = "success";
        this.loader = false;
        this.msg = "Email verified. You may now login.";
      })
      .catch(err => {
        this.variant = "danger";
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

