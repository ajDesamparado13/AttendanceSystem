<template>
  <div style="margin-top: 20px;">
    <h5>Change Password</h5>
    <b-input type="password" v-model="password" class="mb-sm-2" placeholder="New Password" required></b-input>
    <b-input
      type="password"
      v-model="confirmPassword"
      class="mb-sm-2"
      placeholder="Confirm Password"
      required
    ></b-input>
    <b-button variant="primary" type="submit" @click="submit">Submit</b-button>
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
      alertShow: false,
      password: "",
      confirmPassword: ""
    };
  },
  methods: {
    success(v) {
      this.alertShow = v;
    },
    submit() {
      axios.post(`change_password?id=${this.$route.params.id}`, {
        password: this.password,
        password_confirmation: this.confirmPassword
      });
    }
  }
};
</script>