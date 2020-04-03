<template>
  <b-form @submit="onSubmit">
    <b-input
      v-model="locRole.name"
      id="inline-form-input-name"
      class="mb-sm-2"
      placeholder="Role Name"
      required
    ></b-input>
    <b-form-textarea
      id="textarea"
      v-model="locRole.desc"
      placeholder="Description"
      rows="3"
      class="mb-sm-2"
      max-rows="6"
    ></b-form-textarea>
    <slot></slot>
  </b-form>
</template>
<script>
export default {
  props: ["role"],
  data() {
    return {
      locRole: this.role
    };
  },
  methods: {
    onSubmit(evt) {
      evt.preventDefault();
    },
    add() {
      axios.post("roles", this.locRole).then(res => {
        this.locRole = {
          name: "",
          desc: ""
        };
        this.$emit("success", true);
      });
    },
    update() {
      axios.put(`roles/${this.$route.params.id}`, this.locRole).then(res => {
        this.$emit("success", true);
      });
    },
    deletee() {
      axios
        .delete(`roles/${this.$route.params.id}`, this.locRole)
        .then(res => {
          this.$emit("success", true);
        })
        .catch(err => {
          this.$emit("error", true);
        });
    }
  },
  mounted() {
    this.locRole = this.role;
  }
};
</script>