<template>
  <b-form @submit="onSubmit">
    <b-container fluid>
      <b-row>
        <b-col col lg="12">
          <b-input
            v-model="locUser.email"
            id="inline-form-input-name"
            class="mb-sm-2"
            placeholder="Email"
            required
          ></b-input>
        </b-col>
      </b-row>
      <b-row>
        <b-col col lg="6">
          <b-input
            v-model="locUser.employee.firstname"
            id="inline-form-input-name"
            class="mb-sm-2"
            placeholder="Firstname"
            required
          ></b-input>
        </b-col>
        <b-col col lg="6">
          <b-input
            v-model="locUser.employee.lastname"
            id="inline-form-input-name"
            class="mb-sm-2"
            placeholder="Firstname"
            required
          ></b-input>
        </b-col>
        <b-col col lg="12">
          <b-form-select v-model="locRoleIds" :options="options" class="mb-3" multiple>
            <!-- This slot appears above the options from 'options' prop -->
            <template v-slot:first>
              <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
            </template>
          </b-form-select>
        </b-col>
      </b-row>
    </b-container>

    <slot></slot>
  </b-form>
</template>
<script>
export default {
  props: ["user", "roleIds"],
  data() {
    return {
      options: [],
      locUser: this.user,
      locRoleIds: []
    };
  },
  methods: {
    onSubmit(evt) {
      evt.preventDefault();
    },
    update() {
      axios
        .put(`users/${this.$route.params.id}?id=${this.$route.params.id}`, {
          email: this.locUser.email,
          employee: this.locUser.employee,
          roleIds: this.locRoleIds
        })
        .then(res => {
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
    },
    getRoles() {
      axios.get("user_roles").then(res => {
        this.options = res.data.roles;
      });
    }
  },
  mounted() {
    this.locUser = this.user;
    this.locRoleIds = this.roleIds;
    this.getRoles();
  }
};
</script>