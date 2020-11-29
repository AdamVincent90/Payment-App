<template>
    <div>
        <nav
            class="navbar bg-primary border-bottom border-shadow navbar-light mb-1"
        >
            <p class="brand-logo text-light" style="letter-spacing: 2px">
                Transaction App
            </p>
            <router-link
                v-if="!isLoggedIn"
                class="nav-link ml-auto text-light"
                :to="{ name: 'login' }"
                >Login</router-link
            >
            <a
                v-if="isLoggedIn"
                class="nav-link ml-auto text-light"
                href="#"
                @click="logOut"
                >Logout</a
            >
        </nav>
        <div class="mt-2 mb-2 pr-2 pl-2"><router-view></router-view></div>
    </div>
</template>

<script>
import { mapState } from "vuex";
export default {
    computed: {
        ...mapState({
            isLoggedIn: "isLoggedIn"
        })
    },
    methods: {
        async logOut() {
            try {
                axios.post("/logout");
                this.$store.dispatch("logout");
                this.$router.push("/");
            } catch (error) {
                this.$store.dispatch("logout");
            }
        }
    }
};
</script>
