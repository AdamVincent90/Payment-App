<template>
    <div class="container pt-2">
        <h1 class="text-primary text-center">Log into your account</h1>
        <div class="d-flex justify-content-center ">
            <div class="mt-5 bg-white ">
                <div
                    v-if="loading"
                    class="spinner-border text-primary"
                    role="status"
                ></div>
                <div v-else class="pt-1 bg-primary border border-secondary w-75 container">
                    <div class="form-row p-3">
                        <div class="form-group col-12">
                            <label for="email" class="form-label text-light"
                                >Email Address:
                            </label>
                            <input
                                type="text"
                                class="form-control form-control-sm"
                                name="email"
                                v-model="email"
                                :class="[
                                    { 'is-invalid': errorHandler('email') }
                                ]"
                            />
                            <div
                                class="invalid-feedback"
                                v-for="(error, index) in this.errorHandler(
                                    'email'
                                )"
                                :key="'email' + index"
                            >
                                {{ error }}
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <label for="password" class="form-label text-light"
                                >Password:
                            </label>
                            <input
                                type="password"
                                class="form-control form-control-sm"
                                name="password"
                                v-model="password"
                                :class="[
                                    { 'is-invalid': errorHandler('password') }
                                ]"
                            />
                            <div
                                class="invalid-feedback"
                                v-for="(error, index) in this.errorHandler(
                                    'password'
                                )"
                                :key="'end_date' + index"
                            >
                                {{ error }}
                            </div>
                        </div>
                        <div class="form-group col-12 text-center w-100">
                            <button class="btn-light" @click="validate()">
                                Login
                            </button>
                        </div>
                        <div class="form-group col-12 text-center">
                            <strong class="text-light"
                                >New user?
                                <router-link class="text-light" :to="{ name: 'register' }"
                                    >Register</router-link
                                >
                                here.</strong
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { logIn } from "../../utils/auth";

export default {
    data() {
        return {
            email: null,
            password: null,
            loading: false,
            errors: null
        };
    },
    methods: {
        async validate() {
            this.errors = null;
            try {
                await axios.get("/sanctum/csrf-cookie");
                await axios.post("/login", {
                    email: this.email,
                    password: this.password
                });
                this.loading = true;
                logIn();
                this.$store.dispatch("checkUser");
                setTimeout(() => {
                    this.$router.push({name: 'landing'});
                }, 2000)
            } catch (error) {
                this.errors = error.response && error.response.data.errors;
                this.loading = false;
            }

        },
        errorHandler(field) {
            return this.errors ? this.errors[field] : null;
        }
    }
};
</script>

<style scoped>
    label {
        font-weight: bolder;
    }
    .invalid-feedback {
        font-weight: bold;
        color: white;
    }
</style>