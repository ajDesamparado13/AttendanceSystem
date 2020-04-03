<template>
  <div style="padding-left: 20px;">
    <b-form-input
      v-model="filter"
      placeholder="Search name... "
      style="margin-bottom: 5px;"
      debounce="500"
    ></b-form-input>
    <b-button variant="primary" style="margin-bottom: 5px;" @click="add">Add Employee</b-button>
    <b-table striped hover :items="employees" small :fields="fields">
      <template v-slot:cell(action)="data">
        <b-button variant="info" style="margin-bottom: 5px;" @click="edit(data.item.id)">Edit</b-button>
        <b-button variant="danger" style="margin-bottom: 5px;" @click="deletee(data.item.id)">Delete</b-button>
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
        { key: "email", label: "Email" },
        { key: "phone", label: "Phone" },
        { key: "company", label: "Company" },
        { key: "roles", label: "Roles" },
        { key: "action", label: "Actions" }
      ],
      page: 1,
      perPage: 10,
      currentPage: 1,
      rows: 0,
      employees: []
    };
  },
  methods: {
    ...mapActions("employees", ["setEmployee"]),
    edit(id) {
      axios.get(`employees/${id}/edit`).then(res => {
        this.setEmployee(res.data.employee);
        this.$router.push({
          path: `/employees/${id}/edit`
        });
      });
    },
    deletee(id) {
      axios.get(`employees/${id}/edit`).then(res => {
        this.setEmployee(res.data.employee);
        this.$router.push({
          path: `/employees/${id}/delete`
        });
      });
    },
    add() {
      this.setEmployee({
        company_id: null,
        firstname: "",
        lastname: "",
        email: "",
        phone: "",
        role_id: []
      });
      this.$router.push({
        path: "/employees/create"
      });
    },
    getEmployees() {
      axios
        .get(
          `employees?page=${this.currentPage}&perPage=${this.perPage}&filter=${this.filter}`
        )
        .then(res => {
          this.employees = _.values(res.data.employees.data);
          this.rows = res.data.employees.total;
        });
    }
  },
  mounted() {
    this.getEmployees();
  },
  watch: {
    currentPage() {
      this.getEmployees();
    },
    filter() {
      this.getEmployees();
    }
  }
};
</script>
