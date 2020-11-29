<template>
    <div class="container w-lg-50 pt-3">
        <h2 class="text-primary pb-2">Register your details</h2>
        <div v-if="loading" class="spinner-border text-primary" role="status"></div>
        <div v-else class="row bg-primary border border-secondary">
            <div class="col-12 pt-2">
                <label for="address" class="control-form font-weight-bolder text-light"
                    >Name and Email</label
                >
            </div>
            <div class="col-lg-6 pb-1">
                <input
                    type="text"
                    placeholder="Email"
                    name="email"
                    class="form-control"
                    v-model="user.email"
                    :class="[{ 'is-invalid': errorHandler('email') }]"
                />
                <div
                    class="invalid-feedback"
                    v-for="(error, index) in this.errorHandler('email')"
                    :key="'email' + index"
                >
                    {{ error }}
                </div>
            </div>
            <div class="col-lg-6 pb-2 border-light">
                <input
                    type="text"
                    placeholder="Full Name"
                    name="name"
                    class="form-control"
                    v-model="user.name"
                    :class="[{ 'is-invalid': errorHandler('name') }]"
                />
                 <div
                    class="invalid-feedback"
                    v-for="(error, index) in this.errorHandler('name')"
                    :key="'email' + index"
                >
                    {{ error }}
                </div>
            </div>
            <div class="col-12 pt-2">
                <label for="address" class="control-form font-weight-bolder text-light"
                    >Address</label
                >
            </div>
            <div class="col-lg-2 pb-2">
                <input
                    type="text"
                    placeholder="House No."
                    name="houseNumber"
                    class="form-control"
                    v-model="user.house_number"
                    :class="[{ 'is-invalid': errorHandler('house_number') }]"
                />
                 <div
                    class="invalid-feedback"
                    v-for="(error, index) in this.errorHandler('house_number')"
                    :key="'email' + index"
                >
                    {{ error }}
                </div>
            </div>
            <div class="col-lg-10 pb-2">
                <input
                    type="text"
                    placeholder="Street Name"
                    name="street"
                    class="form-control"
                    v-model="user.street"
                    :class="[{ 'is-invalid': errorHandler('street') }]"
                />
                 <div
                    class="invalid-feedback"
                    v-for="(error, index) in this.errorHandler('street')"
                    :key="'email' + index"
                >
                    {{ error }}
                </div>
            </div>
            <div class="col-lg-4 pb-2">
                <input
                    type="text"
                    placeholder="City"
                    name="city"
                    class="form-control"
                    v-model="user.city"
                    :class="[{ 'is-invalid': errorHandler('city') }]"
                />
                 <div
                    class="invalid-feedback"
                    v-for="(error, index) in this.errorHandler('city')"
                    :key="'email' + index"
                >
                    {{ error }}
                </div>
            </div>
            <div class="col-lg-4 pb-2">
                <input
                    type="text"
                    placeholder="Postcode"
                    name="postcode"
                    class="form-control"
                    v-model="user.postcode"
                    :class="[{ 'is-invalid': errorHandler('postcode') }]"
                />
                 <div
                    class="invalid-feedback"
                    v-for="(error, index) in this.errorHandler('postcode')"
                    :key="'email' + index"
                >
                    {{ error }}
                </div>
            </div>
            <div class="col-lg-4 border-light pb-2">
                <input
                    type="text"
                    placeholder="Country"
                    name="country"
                    class="form-control"
                    v-model="user.country"
                    :class="[{ 'is-invalid': errorHandler('country') }]"
                />
                 <div
                    class="invalid-feedback"
                    v-for="(error, index) in this.errorHandler('country')"
                    :key="'email' + index"
                >
                    {{ error }}
                </div>
            </div>
            <div class="col-12 pt-2">
                <label for="password" class="control-form font-weight-bolder text-light"
                    >Create Password</label
                >
            </div>
            <div class="col-lg-6 pb-2">
                <input
                    type="password"
                    placeholder="Password"
                    name="password"
                    class="form-control"
                    v-model="user.password"
                    :class="[{ 'is-invalid': errorHandler('password') }]"
                />
                 <div
                    class="invalid-feedback"
                    v-for="(error, index) in this.errorHandler('password')"
                    :key="'email' + index"
                >
                    {{ error }}
                </div>
            </div>
            <div class="col-lg-6 pb-2">
                <input
                    type="password"
                    placeholder="Confirm Password"
                    name="confirmPassword"
                    class="form-control"
                    v-model="user.password_confirmation"
                    :class="[{ 'is-invalid': errorHandler('password_confirmation') }]"
                />
                 <div
                    class="invalid-feedback"
                    v-for="(error, index) in this.errorHandler('password_confirmation')"
                    :key="'email' + index"
                >
                    {{ error }}
                </div>
            </div>
            <div class="col-12 pt-4 pb-1 text-center">
                <button class="btn-light w-50" @click.prevent="register">
                    Register
                </button>
            </div>
            <strong class="p-2 text-light"
                >Already Registered?
                <router-link class="text-light" :to="{ name: 'login' }"
                    >Log In here</router-link
                ></strong
            >
        </div>
    </div>
</template>

<script>
import { logIn } from '../../utils/auth';
export default {
    data() {
        return {
            user: {
            name: null,
            email: null,
            house_number: null,
            street: null,
            city: null,
            country: null,
            postcode: null,
            password: null,
            password_confirmation: null
            },
            loading: false,
            errors: null
        };
    },
    methods: {
       async register() {
            this.errors = null;
            try {
               const response = await axios.post('/register', this.user);

               if (response.status === 201)
               {    
                   this.loading = true;
                   logIn();
                   await this.$store.dispatch('checkUser');
                   this.$router.push('/landing');
               }

            } catch (error) {
                this.loading = false;
                this.errors = error.response && error.response.data.errors;
            }
        },
        errorHandler(field) {
            return this.errors ? this.errors[field] : null;
        }
    }
};
</script>

<style scoped>
.invalid-feedback {
    color: white;
    font-weight: bold;
}
</style>