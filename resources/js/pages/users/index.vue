<template>
  <div style="padding-left: 20px;">
    <b-form-input
      v-model="filter"
      placeholder="Search role name... "
      style="margin-bottom: 5px;"
      debounce="500"
    ></b-form-input>
    <b-button variant="primary" style="margin-bottom: 5px;" @click="add">Add Role</b-button>
    <b-table striped hover :items="roles" small :fields="fields">
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
      aria-controls="my-table"
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
        { key: "name", label: "Name" },
        { key: "desc", label: "Description" },
        { key: "action", label: "Actions" }
      ],
      page: 1,
      perPage: 10,
      currentPage: 1,
      rows: 0,
      roles: []
    };
  },
  methods: {
    ...mapActions("roles", ["setRole"]),
    add() {
      this.setRole({
        name: "",
        desc: ""
      });
      this.$router.push({
        path: "/roles/create"
      });
    },
    edit(id) {
      axios.get(`roles/${id}/edit`).then(res => {
        this.setRole(res.data.role);
        this.$router.push({
          path: `/roles/${id}/edit`
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
    getCompanies() {
      axios
        .get(
          `roles?page=${this.currentPage}&perPage=${this.perPage}&filter=${this.filter}`
        )
        .then(res => {
          this.roles = _.values(res.data.roles.data);
          this.rows = res.data.roles.total;
        });
    }
  },
  mounted() {
    this.getCompanies();
  },
  watch: {
    currentPage() {
      this.getCompanies();
    },
    filter() {
      this.getCompanies();
    }
  }
};
</script>
