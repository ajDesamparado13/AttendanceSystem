<template>
  <div>
    <h5>Edit User</h5>
    <b-alert variant="success" :show="alertShow" dismissible>User updated successfully.</b-alert>
    <form-generic :user="user" ref="role" @success="success">
      <b-button variant="primary" type="submit" @click="update">Update</b-button>
    </form-generic>
  </div>
</template>

<script>
import formGeneric from "./form/generic";
import { mapState } from "vuex";
export default {
  components: {
    formGeneric
  },
  data() {
    return {
      alertShow: false
    };
  },
  computed: {
    ...mapState("users", ["user"])
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