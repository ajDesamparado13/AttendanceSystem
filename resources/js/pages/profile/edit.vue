<template>
  <div>
    <h5>Profile</h5>
    <b-alert variant="success" :show="alertShow" dismissible>Profile updated successfully.</b-alert>
    <form-generic ref="user" @success="success">
      <b-button variant="primary" type="submit" @click="update">Update</b-button>
    </form-generic>
  </div>
</template>

<script>
import formGeneric from "./form/generic";
export default {
  components: {
    formGeneric
  },
  data() {
    return {
      alertShow: false
    };
  },
  methods: {
    success(v) {
      this.alertShow = v;
    },
    update() {
      this.$refs.user.update();
    }
  }
};
</script>