<template>
  <div style="padding-left: 20px; margin-top: 10px; ">
    <b-container fluid>
      <b-row>
        <b-col col lg="8">
          <b-form-input
            v-model="filter"
            placeholder="Search Causer Id... "
            style="margin-bottom: 5px;"
            debounce="500"
          ></b-form-input>
        </b-col>
        <b-col col lg="4">
          <b-button-group>
            <b-button variant="success" :disabled="lastAction === 'time-in'" @click="login">Login</b-button>
            <b-button variant="danger" :disabled="lastAction === 'time-out'" @click="logout">Logout</b-button>
          </b-button-group>
        </b-col>
      </b-row>
    </b-container>
    <b-alert variant="success" :show="alertShow" dismissible>User deleted successfully.</b-alert>
    <b-table striped hover :items="timelogs" small :fields="fields">
      <!-- <template v-slot:cell(causer_type)="data">
        {{data.item.causerable}}
        <b-button variant="info" style="margin-bottom: 5px;" @click="edit(`${data.item.id}`)">Edit</b-button>
        <b-button
          variant="danger"
          style="margin-bottom: 5px;"
          @click="showMsgBoxTwo(`${data.item.id}`)"
        >Delete</b-button>
      </template>-->
    </b-table>

    <b-pagination
      v-model="currentPage"
      :total-rows="rows"
      :per-page="perPage"
      first-text="⏮"
      prev-text="⏪"
      next-text="⏩"
      last-text="⏭"
      class="mt-4"
    ></b-pagination>
  </div>
</template>

<script>
import { mapActions } from "vuex";
export default {
  data() {
    return {
      lastAction: null,
      alertShow: false,
      userId: null,
      confirmDelete: false,
      filter: "",
      fields: [
        { key: "employee", label: "Employee" },
        { key: "phone", label: "Phone" },
        { key: "action", label: "Actions" },
        { key: "created_at", label: "Created At" }
      ],
      page: 1,
      rows: 10,
      perPage: 10,
      currentPage: 1,
      timelogs: []
    };
  },
  methods: {
    ...mapActions("users", ["setUser", "setRoleIds"]),
    showMsgBoxTwo(userId) {
      var app = this;
      this.$bvModal
        .msgBoxConfirm("Please confirm that you want to delete everything.", {
          title: "Please Confirm",
          size: "sm",
          buttonSize: "sm",
          okVariant: "danger",
          okTitle: "YES",
          cancelTitle: "NO",
          footerClass: "p-2",
          hideHeaderClose: false,
          centered: true
        })
        .then(value => {
          axios.delete(`users/${userId}`).then(res => {
            app.getUsers();
            app.alertShow = true;
          });
        })
        .catch(err => {
          // An error occurred
        });
    },
    login(id) {
      axios
        .post(`timelogs`, {
          action: "time-in"
        })
        .then(res => {
          this.getTimelogs();
        });
    },
    logout(id) {
      axios
        .post(`timelogs`, {
          action: "time-out"
        })
        .then(res => {
          this.getTimelogs();
        });
    },
    deletee(id) {
      this.userId = id;
    },
    getTimelogs() {
      axios
        .get(
          `timelogs?search=${this.filter}&page=${this.currentPage}&perPage=${this.perPage}`
        )
        .then(res => {
          this.timelogs = _.values(res.data.data.data);
          this.rows = res.data.data.total;
          this.lastAction = res.data.lastAction;
        });
    }
  },
  mounted() {
    this.getTimelogs();
  },
  watch: {
    currentPage() {
      this.getTimelogs();
    },
    filter() {
      this.getTimelogs();
    }
  }
};
</script>
