<template>
  <div>
    <h5>Edit Company</h5>
    <b-alert variant="success" :show="alertShow" dismissible>Company updated successfully.</b-alert>
    <form-generic :company="company" ref="company" @success="success">
      <b-button variant="primary" type="submit" @click="update">Update</b-button>
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
  computed: {
    ...mapState("company", ["company"])
  },
  methods: {
    ...mapActions("company", ["setCompany"]),
    success(v) {
      this.alertShow = v;
    },
    update() {
      this.$refs.company.update();
    }
  }
};
</script>