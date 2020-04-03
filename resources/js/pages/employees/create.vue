<template>
    <div>
        <h5>New Employee</h5>
        <b-alert variant="success" :show="alertShow" dismissible
            >Employee created successfully.</b-alert
        >
        <form-generic :employee="employee" ref="employee" @success="success">
            <b-button
                variant="primary"
                type="submit"
                @click="save"
                class="mt-sm-1"
                >Save</b-button
            >
        </form-generic>
    </div>
</template>

<script>
import formGeneric from "./form/generic";
import { mapState } from "vuex";
export default {
    components: {
        formGeneric
    },
    data() {
        return {
            companies: [],
            alertShow: false
        };
    },
    computed: {
        ...mapState("employees", ["employee"])
    },
    methods: {
        success(v) {
            this.alertShow = true;
        },
        save() {
            this.$refs.employee.add();
        }
    }
};
</script>
