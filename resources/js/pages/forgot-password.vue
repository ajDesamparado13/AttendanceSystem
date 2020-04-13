<template>
  <b-container class="bv-example-row" fluid>
    <b-row align-h="center">
      <b-col id="form">
        <h2 style="text-align:center; margin-bottom: 30px;">FORGOT PASSWORD</h2>
        <b-alert
          style="text-align:center"
          :show="error"
          dismissible
          :variant="variant"
          @dismissed="error=false"
        >{{ errorMessage }}</b-alert>
        <b-form @submit="onSubmit">
          <b-input type="email" v-model="email" placeholder="Email" class="mb-sm-2" required></b-input>
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
      loader: false,
      variant: "danger",
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
      this.loader = true;
      axios
        .post("password/create", {
          email: this.email
        })
        .then(res => {
          this.loader = false;
          this.variant = "success";
          this.error = true;
          this.errorMessage = res.data.message;
        })
        .catch(err => {
          this.loader = false;
          this.variant = "danger";
          this.error = true;
          this.errorMessage = err.response.data.message;
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
