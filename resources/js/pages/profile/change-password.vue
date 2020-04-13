<template>
  <div style="margin-top: 20px;">
    <h5>Change Password</h5>
    <b-form @submit="onSubmit">
      <b-alert :variant="variant" :show="alertShow" dismissible>
        <ul v-if="errors.length > 0" style="padding-top: 10px;">
          <li v-for="(v, i) in errors" :key="i">{{ v }}</li>
        </ul>
        <span v-else>Password updated successfully.</span>
      </b-alert>
      <b-input
        type="password"
        v-model="password"
        class="mb-sm-2"
        placeholder="New Password"
        required
      ></b-input>
      <b-input
        type="password"
        v-model="confirmPassword"
        class="mb-sm-2"
        placeholder="Confirm Password"
        required
      ></b-input>
      <b-button variant="primary" type="submit">Submit</b-button>
    </b-form>
  </div>
</template>

<script>
import formGeneric from "./form/generic";
import { mapState, mapActions } from "vuex";
export default {
  components: {
    formGeneric
  },
  data() {
    return {
      variant: "success",
      alertShow: false,
      password: "",
      confirmPassword: "",
      errors: []
    };
  },
  methods: {
    onSubmit(evt) {
      evt.preventDefault();
      this.submit();
    },
    success(v) {
      this.alertShow = v;
    },
    submit() {
      axios
        .post(`profile_change_password`, {
          password: this.password,
          password_confirmation: this.confirmPassword
        })
        .then(res => {
          this.variant = "success";
          this.alertShow = true;
          this.errors = [];
        })
        .catch(err => {
          this.variant = "danger";
          this.alertShow = true;
          this.errors = err.response.data.errors.password;
        });
    }
  }
};
</script>