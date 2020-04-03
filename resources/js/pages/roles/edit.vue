<template>
  <div>
    <h5>Edit Role</h5>
    <b-alert variant="success" :show="alertShow" dismissible>Role updated successfully.</b-alert>
    <form-generic :role="role" ref="role" @success="success">
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
    ...mapState("roles", ["role"])
  },
  methods: {
    success(v) {
      this.alertShow = v;
    },
    update() {
      this.$refs.role.update();
    }
  }
};
</script>