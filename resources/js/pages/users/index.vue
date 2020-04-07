<template>
  <div style="padding-left: 20px; margin-top: 10px; ">
    <b-form-input
      v-model="filter"
      placeholder="Search email... "
      style="margin-bottom: 5px;"
      debounce="500"
    ></b-form-input>
    <b-table striped hover :items="users" small :fields="fields">
      <template v-slot:cell(action)="data">
        <b-button variant="info" style="margin-bottom: 5px;" @click="edit(`${data.item.id}`)">Edit</b-button>
        <b-button
          variant="danger"
          style="margin-bottom: 5px;"
          @click="deletee(`${data.item.id}`)"
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
    ...mapActions("users", ["setUser"]),
    edit(id) {
      axios.get(`users/${id}/edit`).then(res => {
        this.setUser(res.data.data);
        this.$router.push({
          path: `/users/${id}/edit`
        });
      });
    },
    deletee(id) {
      axios.get(`roles/${id}/edit`).then(res => {
        this.setRole(res.data.role);
        this.$router.push({
          path: `/roles/${id}/delete`
        });
      });
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
