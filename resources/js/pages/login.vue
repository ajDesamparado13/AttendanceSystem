<template>
  <b-container class="bv-example-row" fluid>
    <b-row align-h="center">
      <b-col id="form">
        <h2 style="text-align:center; margin-bottom: 30px;">LOGIN</h2>
        <b-alert
          :show="error"
          dismissible
          variant="danger"
          @dismissed="error=false"
        >{{ errorMessage }}</b-alert>
        <b-form @submit="onSubmit">
          <b-input
            type="email"
            v-model="email"
            placeholder="Enter your email"
            class="mb-sm-2"
            required
          ></b-input>
          <b-input
            type="password"
            v-model="password"
            placeholder="Password"
            class="mb-sm-2"
            required
          ></b-input>
          <br />
          <b-button variant="secondary" to="/">Cancel</b-button>
          <b-button type="submit" variant="primary">Submit</b-button>
          <br />
          <br />
          <router-link to="/register">Register</router-link>&nbsp;|
          <router-link to="/forgot-password">Forgot Password</router-link>
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
      error: false,
      errorMessage: null,
      email: "",
      password: ""
    };
  },
  methods: {
    ...mapActions("users", ["setToken", "setUser"]),
    onSubmit(evt) {
      evt.preventDefault();
      axios
        .post("login", {
          email: this.email,
          password: this.password
        })
        .then(res => {
          var token = res.data.success.token;
          this.setToken(token);
          this.setUser(res.data.user);
          this.$router.push("/user/dashboard");
        })
        .catch(err => {
          this.error = true;
          this.errorMessage = err.response.data.error;
        });
    }
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
