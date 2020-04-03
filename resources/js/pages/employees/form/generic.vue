<template>
    <div>
        <b-form @submit.stop.prevent="onSubmit">
            <b-form-select
                id="example-input-3"
                name="example-input-3"
                v-model="$v.locEmployee.company_id.$model"
                :options="companies"
                :state="validateState('company_id')"
                aria-describedby="input-3-live-feedback"
                class="mb-sm-1"
            >
                <template v-slot:first>
                    <b-form-select-option :value="null" disabled
                        >-- Please select company --</b-form-select-option
                    >
                </template>
            </b-form-select>

            <b-form-invalid-feedback id="input-3-live-feedback"
                >Company is required.</b-form-invalid-feedback
            >
            <b-form-input
                id="example-input-1"
                name="example-input-1"
                v-model="$v.locEmployee.firstname.$model"
                :state="validateState('firstname')"
                aria-describedby="input-1-live-feedback"
                placeholder="Firstname"
                class="mb-sm-1 mt-sm-1"
            ></b-form-input>

            <b-form-invalid-feedback id="input-1-live-feedback"
                >Firstname is required.</b-form-invalid-feedback
            >

            <b-form-input
                id="example-input-2"
                name="example-input-2"
                v-model="$v.locEmployee.lastname.$model"
                :state="validateState('lastname')"
                aria-describedby="input-2-live-feedback"
                placeholder="Lastname"
                class="mb-sm-1 mt-sm-1"
            ></b-form-input>

            <b-form-invalid-feedback id="input-2-live-feedback"
                >Lastname is required.</b-form-invalid-feedback
            >
            <slot></slot>
        </b-form>
    </div>
    <!-- <b-form @submit.stop.prevent="onSubmit">
        <b-form-select
            v-model="locEmployee.company_id"
            :options="companies"
            class="mb-sm-2"
        >
            <template v-slot:first>
                <b-form-select-option :value="null" disabled
                    >-- Please select company --</b-form-select-option
                >
            </template>
        </b-form-select>
        <b-form-select
            v-model="locEmployee.role_id"
            :options="roles"
            class="mb-sm-2"
            multiple
        >
            <template v-slot:first>
                <b-form-select-option :value="null" disabled
                    >-- Please select role --</b-form-select-option
                >
            </template>
        </b-form-select>
        <b-input
            v-model="locEmployee.firstname"
            id="inline-form-input-name"
            class="mb-sm-2"
            placeholder="Firstname"
            :state="validateState('name')"
        ></b-input>
        <b-input
            v-model="locEmployee.lastname"
            id="inline-form-input-name"
            class="mb-sm-2"
            placeholder="Lastname"
        ></b-input>
        <b-input
            type="email"
            v-model="locEmployee.email"
            id="inline-form-input-name"
            class="mb-sm-2"
            placeholder="Email"
        ></b-input>
        <b-input
            v-model="locEmployee.phone"
            id="inline-form-input-name"
            class="mb-sm-2"
            placeholder="Phone"
        ></b-input>
        <slot></slot>
    </b-form> -->
</template>
<script>
import { validationMixin } from "vuelidate";
import { required, minLength } from "vuelidate/lib/validators";
export default {
    mixins: [validationMixin],
    validations: {
        locEmployee: {
            company_id: {
                required
            },
            firstname: {
                required
            },
            lastname: {
                required
            }
        }
    },
    props: ["employee"],
    data() {
        return {
            roles: [],
            companies: [],
            locEmployee: this.employee
        };
    },
    methods: {
        validateState(name) {
            const { $dirty, $error } = this.$v.locEmployee[name];
            return $dirty ? !$error : null;
        },
        resetForm() {
            this.locEmployee = {
                firstname: null,
                lastname: null,
                company_id: null,
                phone: null,
                email: null,
                role_id: []
            };

            this.$nextTick(() => {
                this.$v.$reset();
            });
        },
        onSubmit() {
            this.$v.locEmployee.$touch();
            if (this.$v.locEmployee.$anyError) {
                return;
            }

            alert("Form submitted!");
        },
        add() {
            axios.post("employees", this.locEmployee).then(res => {
                this.locEmployee = {
                    company_id: null,
                    firstname: "",
                    lastname: "",
                    email: "",
                    phone: "",
                    role_id: []
                };
                this.$emit("success", true);
            });
        },
        update() {
            axios
                .put(`employees/${this.$route.params.id}`, this.locEmployee)
                .then(res => {
                    this.$emit("success", true);
                });
        },
        deletee() {
            axios
                .delete(`employees/${this.$route.params.id}`, this.locEmployee)
                .then(res => {
                    this.$emit("success", true);
                })
                .catch(err => {
                    this.$emit("error", true);
                });
        },
        getCompanies() {
            axios.get("employees_companies").then(res => {
                this.companies = res.data.companies;
            });
        },
        getRoles() {
            axios.get("employees_roles").then(res => {
                this.roles = res.data.roles;
            });
        }
    },
    mounted() {
        this.getCompanies();
        this.getRoles();
        this.locEmployee = this.employee;
    }
};
</script>
