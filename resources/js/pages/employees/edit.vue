<template>
  <div>
    <h5>Edit Employee</h5>
    <b-alert variant="success" :show="alertShow" dismissible>Employee updated successfully.</b-alert>
    <form-generic :employee="employee" ref="employee" @success="success">
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
      companies: [],
      alertShow: false
    };
  },
  computed: {
    ...mapState("employees", ["employee"])
  },
  methods: {
    success(v) {
      this.alertShow = true;
    },
    update() {
      this.$refs.employee.update();
    }
  }
};
</script>