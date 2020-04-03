<template>
  <div>
    <h5>Delete Company</h5>
    <b-alert variant="danger" :show="alertShow" dismissible>Are you sure you want to delete?</b-alert>
    <b-alert variant="success" :show="successDialog" dismissible>Company deleted successfully</b-alert>
    <b-alert variant="info" :show="responseError" dismissible>Integrity constraint...</b-alert>
    <form-generic
      :company="company"
      ref="company"
      @success="success"
      @error="error"
      v-if="successDialog === false"
    >
      <b-button variant="danger" type="submit" @click="deletee">Delete</b-button>
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
      alertShow: true,
      successDialog: false,
      responseError: false
    };
  },
  computed: {
    ...mapState("company", ["company"])
  },
  methods: {
    ...mapActions("company", ["setCompany"]),
    error(v) {
      this.responseError = true;
      this.alertShow = false;
      this.successDialog = false;
    },
    success(v) {
      this.responseError = false;
      this.alertShow = false;
      this.successDialog = true;
    },
    deletee() {
      this.$refs.company.deletee();
    }
  }
};
</script>