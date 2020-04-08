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
      </b-row>
    </b-container>

    <slot></slot>
  </b-form>
</template>
<script>
export default {
  data() {
    return {
      options: [],
      locUser: {
        email: "",
        employee: {
          firstname: "",
          lastname: ""
        }
      }
    };
  },
  methods: {
    onSubmit(evt) {
      evt.preventDefault();
    },
    update() {
      axios
        .post(`profile_update`, {
          email: this.locUser.email,
          employee: this.locUser.employee
        })
        .then(res => {
          this.$emit("success", true);
        });
    }
  },
  mounted() {
    axios.get(`profile`).then(res => {
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

      this.locUser = editUser;
    });
  }
};
</script>