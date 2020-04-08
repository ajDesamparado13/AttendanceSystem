<template>
  <b-container fluid>
    <b-row>
      <b-col col lg="12">
        <h5 style="margin-top: 20px; margin-left: 20px;">MAC Address</h5>
        <b-alert variant="success" :show="alertShow" dismissible>Machine updated successfully.</b-alert>
        <form-generic :machine="machine" ref="machine" @success="success">
          <b-button variant="primary" type="submit" @click="update">Update</b-button>
        </form-generic>
      </b-col>
    </b-row>
  </b-container>
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
      employeeId: null
    };
  },
  computed: {
    ...mapState("machines", ["machine"])
  },
  methods: {
    ...mapActions("machines", ["setEmployeeId", "setMACAddress"]),
    success(v) {
      this.alertShow = v;
      this.getMacAddress();
    },
    update() {
      this.$refs.machine.update();
    },
    getEmployeeId() {
      axios.get("machine_employee_id").then(res => {
        this.setEmployeeId(res.data.employeeId);
        this.employeeId = res.data.employeeId;
        this.getMacAddress();
      });
    },
    getMacAddress() {
      axios
        .get(`machine_mac_address?employee_id=${this.employeeId}`)
        .then(res => {
          this.setMACAddress(res.data.macAddress);
        });
    }
  },
  mounted() {
    this.getEmployeeId();
  }
};
</script>