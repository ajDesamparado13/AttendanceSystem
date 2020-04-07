<template>
  <div>
    <header>
      <b-navbar toggleable="lg" type="dark" variant="info">
        <b-navbar-brand href="/">Attendance System</b-navbar-brand>
        <b-button variant="danger" @click="logout">Logout</b-button>
      </b-navbar>
    </header>
    <b-container fluid>
      <b-row>
        <b-col col lg="3">
          <b-list-group>
            <b-list-group-item :to="v.path" v-for="(v, i) in menus" :key="i">{{ v.name }}</b-list-group-item>
          </b-list-group>
        </b-col>
        <b-col col lg="9">
          <router-view></router-view>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>
import { mapState, mapActions } from "vuex";
export default {
  computed: {
    ...mapState("users", ["user", "menus"])
  },
  methods: {
    ...mapActions("users", ["setToken", "setMenus"]),
    logout() {
      axios.post(`logout`).then(res => {
        this.setToken(null);
        this.$router.push({
          path: "/"
        });
      });
    },
    getMenus() {
      axios.get("dashboard_menus").then(res => {
        this.setMenus(res.data.menus);
      });
    }
  },
  mounted() {
    this.getMenus();
  }
};
</script>
