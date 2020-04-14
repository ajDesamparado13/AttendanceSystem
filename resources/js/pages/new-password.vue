<template>
  <b-container class="bv-example-row" fluid>
    <b-row align-h="center">
      <b-col id="form">
        <h2 style="text-align:center; margin-bottom: 30px;">NEW PASSWORD</h2>
        <b-alert :variant="variant" :show="alertShow" dismissible>
          <ul v-if="errors.length > 0" style="padding-top: 10px;">
            <li v-for="(v, i) in errors" :key="i">{{ v }}</li>
          </ul>
          <span v-else>Password reset successfully.</span>
        </b-alert>
        <b-form @submit="onSubmit">
          <b-input
            type="password"
            v-model="password"
            placeholder="Password"
            class="mb-sm-2"
            required
          ></b-input>
          <b-input
            type="password"
            v-model="password_confirmation"
            placeholder="Confirm Password"
            class="mb-sm-2"
            required
          ></b-input>
          <b-button variant="secondary" to="/">Cancel</b-button>
          <b-button type="submit" variant="primary">
            <b-spinner small v-if="loader"></b-spinner>&nbsp; Submit
          </b-button>
          <br />
        </b-form>
      </b-col>
    </b-row>
  </b-container>
</template>
<script>
import { mapActions } from "vuex";
export default {
  data() {
    return {
      alertShow: false,
      loader: false,
      variant: "danger",
      error: false,
      errorMessage: [],
      password: "",
      password_confirmation: "",
      email: "",
      errors: []
    };
  },
  methods: {
    ...mapActions("users", ["setToken", "setUser"]),
    onSubmit(evt) {
      evt.preventDefault();
      this.loader = true;
      axios
        .post("password/reset", {
          email: this.email,
          password: this.password,
          password_confirmation: this.password_confirmation,
          token: this.$route.params.token
        })
        .then(res => {
          this.loader = false;
          this.variant = "success";
          this.alertShow = true;
          this.errors = [];
          this.password = "";
          this.password_confirmation = "";
        })
        .catch(err => {
          this.loader = false;
          this.variant = "danger";
          this.alertShow = true;
          this.errors = err.response.data.errors.password;
        });
    }
  },
  mounted() {
    axios
      .get(`/password/find/${this.$route.params.token}`)
      .then(res => {
        this.email = res.data.email;
      })
      .catch(err => {
        this.$router.go(-1);
      });
  }
};
</script>

<style scope>
#form {
  max-width: 500px;
  margin-top: 150px;
  padding: 30px;
  padding-top: 40px;
  border: 1px solid grey;
  border-radius: 5px;
}
</style>
