<template>
  <b-form @submit="onSubmit">
    <b-container fluid>
      <b-row>
        <b-col col lg="12">
          <b-input
            v-model="locMachine.MAC_Address"
            id="inline-form-input-name"
            class="mb-sm-2"
            placeholder="MAC address"
            required
          ></b-input>
        </b-col>
      </b-row>
      <slot></slot>
    </b-container>
  </b-form>
</template>
<script>
export default {
  props: ["machine"],
  data() {
    return {
      locMachine: this.machine
    };
  },
  methods: {
    onSubmit(evt) {
      evt.preventDefault();
    },
    update() {
      axios
        .post(`my-machine`, {
          employee_id: this.locMachine.employee_id,
          MAC_Address: this.locMachine.MAC_Address
        })
        .then(res => {
          this.$emit("success", true);
        });
    }
  },
  mounted() {
    this.locMachine = this.machine;
  }
};
</script>