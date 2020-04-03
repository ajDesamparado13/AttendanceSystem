<template>
  <div style="padding-left: 20px;">
    <b-form-input
      v-model="filter"
      placeholder="Search company name... "
      style="margin-bottom: 5px;"
      debounce="500"
    ></b-form-input>
    <b-button variant="primary" style="margin-bottom: 5px;" @click="addCompany">Add Company</b-button>
    <b-table striped hover :items="companies" small :fields="fields">
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
        { key: "address", label: "Address" },
        { key: "website", label: "Website" },
        { key: "action", label: "Actions" }
      ],
      page: 1,
      perPage: 10,
      currentPage: 1,
      rows: 0,
      companies: []
    };
  },
  methods: {
    ...mapActions("company", ["setCompany"]),
    addCompany() {
      this.setCompany({
        name: "",
        address: "",
        website: ""
      });
      this.$router.push({
        path: "/companies/create"
      });
    },
    edit(id) {
      axios.get(`companies/${id}/edit`).then(res => {
        this.setCompany(res.data.company);
        this.$router.push({
          path: `/companies/${id}/edit`
        });
      });
    },
    deletee(id) {
      axios.get(`companies/${id}/edit`).then(res => {
        this.setCompany(res.data.company);
        this.$router.push({
          path: `/companies/${id}/delete`
        });
      });
    },
    getCompanies() {
      axios
        .get(
          `companies?page=${this.currentPage}&perPage=${this.perPage}&filter=${this.filter}`
        )
        .then(res => {
          this.companies = _.values(res.data.companies.data);
          this.rows = res.data.companies.total;
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
