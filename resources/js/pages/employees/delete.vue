<template>
  <div>
    <h5>Delete Employee</h5>
    <b-alert :variant="variant" :show="warning === true" dismissible>{{ warningContent }}</b-alert>
    <b-alert variant="success" :show="warning === false" dismissible>Employee deleted successfuly.</b-alert>
    <form-generic :employee="employee" ref="employee" @success="success" v-if="warning === true">
      <b-button variant="danger" type="submit" @click="deletee">Confirm Delete</b-button>
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
      warning: true,
      variant: "danger",
      warningContent: "Are you sure you want to delete?",
      companies: [],
      alertShow: false
    };
  },
  computed: {
    ...mapState("employees", ["employee"])
  },
  methods: {
    success(v) {
      this.warning = false;
    },
    deletee() {
      this.$refs.employee.deletee();
    }
  }
};
</script>