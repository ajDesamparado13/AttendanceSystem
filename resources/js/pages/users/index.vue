<template>
  <div style="padding-left: 20px; margin-top: 10px; ">
    <b-form-input
      v-model="filter"
      placeholder="Search email... "
      style="margin-bottom: 5px;"
      debounce="500"
    ></b-form-input>
    <b-alert variant="success" :show="alertShow" dismissible>User deleted successfully.</b-alert>
    <b-table striped hover :items="users" small :fields="fields">
      <template v-slot:cell(action)="data">
        <b-button variant="info" style="margin-bottom: 5px;" @click="edit(`${data.item.id}`)">Edit</b-button>
        <b-button
          variant="danger"
          style="margin-bottom: 5px;"
          @click="showMsgBoxTwo(`${data.item.id}`)"
        >Delete</b-button>
      </template>
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
      alertShow: false,
      userId: null,
      confirmDelete: false,
      filter: "",
      fields: [
        { key: "employeeName", label: "Name" },
        { key: "email", label: "Email" },
        { key: "action", label: "Actions" }
      ],
      page: 1,
      rows: 10,
      perPage: 10,
      currentPage: 1,
      users: []
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
    edit(id) {
      axios.get(`users/${id}/edit`).then(res => {
        let user = res.data.user;
        let editUser = {
          email: user.email,
          employee: {
            firstname: "",
            lastname: ""
          }
        };
        let firstname = "";
        let lastname = "";
        if (user.employee !== null) {
          editUser.employee.firstname = user.employee.firstname;
          editUser.employee.lastname = user.employee.lastname;
        }

        this.setUser(editUser);
        this.setRoleIds(res.data.roles);
        this.$router.push({
          path: `/users/${id}/edit`
        });
      });
    },
    deletee(id) {
      this.userId = id;
    },
    getUsers() {
      axios
        .get(
          `users?search=${this.filter}&page=${this.currentPage}&limit=${this.perPage}`
        )
        .then(res => {
          this.users = _.values(res.data.data.data);
          this.rows = res.data.data.total;
        });
    }
  },
  mounted() {
    this.getUsers();
  },
  watch: {
    currentPage() {
      this.getUsers();
    },
    filter() {
      this.getUsers();
    }
  }
};
</script>
