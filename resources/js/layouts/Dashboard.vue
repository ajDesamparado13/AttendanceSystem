<template>
  <div>
    <header>
      <b-navbar toggleable="lg" type="dark" variant="info">
        <b-navbar-brand href="/">Attendance System</b-navbar-brand>
        <b-button variant="danger" @click="logout">Logout</b-button>
      </b-navbar>
    </header>
    <div>
      <div style="float: left">
        <b-list-group>
          <b-list-group-item to="/dashboard/roles">Roles</b-list-group-item>
          <b-list-group-item to="/dashboard/companies">Companies</b-list-group-item>
          <b-list-group-item to="/dashboard/employees">Employees</b-list-group-item>
        </b-list-group>
      </div>
      <div style="float: left; padding-left: 10px;">
        <router-view></router-view>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState, mapActions } from "vuex";
export default {
  computed: {
    ...mapState("users", ["user"])
  },
  methods: {
    ...mapActions("users", ["setToken"]),
    logout() {
      axios.post(`logout`).then(res => {
        this.setToken(null);
        this.$router.push({
          path: "/"
        });
      });
    }
  }
};
</script>
