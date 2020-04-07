<template>
  <div>
    <h5>New Role</h5>
    <b-alert variant="success" :show="alertShow" dismissible>Role created successfully.</b-alert>
    <form-generic :role="role" ref="role" @success="success">
      <b-button variant="primary" type="submit" @click="add">Save</b-button>
    </form-generic>
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
      alertShow: false
    };
  },
  methods: {
    success(v) {
      this.alertShow = v;
    },
    add() {
      this.$refs.role.add();
    }
  },
  computed: {
    ...mapState("roles", ["role"])
  }
};
</script>