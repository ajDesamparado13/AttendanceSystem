<template>
  <b-form @submit="onSubmit">
    <b-input
      v-model="locCompany.name"
      id="inline-form-input-name"
      class="mb-sm-2"
      placeholder="Company Name"
      required
    ></b-input>
    <b-input
      v-model="locCompany.address"
      id="inline-form-input-name"
      class="mb-sm-2"
      placeholder="Address"
      required
    ></b-input>
    <b-input
      v-model="locCompany.website"
      id="inline-form-input-name"
      class="mb-sm-2"
      placeholder="Website"
      required
    ></b-input>
    <slot></slot>
  </b-form>
</template>
<script>
export default {
  props: ["company"],
  data() {
    return {
      locCompany: this.company
    };
  },
  methods: {
    onSubmit(evt) {
      evt.preventDefault();
    },
    add() {
      axios.post("companies", this.locCompany).then(res => {
        this.locCompany = {
          name: "",
          address: "",
          website: ""
        };
        this.$emit("success", true);
      });
    },
    update() {
      axios
        .put(`companies/${this.$route.params.id}`, this.locCompany)
        .then(res => {
          this.$emit("success", true);
        });
    },
    deletee() {
      axios
        .delete(`companies/${this.$route.params.id}`, this.locCompany)
        .then(res => {
          this.$emit("success", true);
        })
        .catch(err => {
          this.$emit("error", true);
        });
    }
  },
  mounted() {
    this.locCompany = this.company;
  }
};
</script>