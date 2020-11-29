import VueRouter from "vue-router";
import Login from "./components/auth/login";
import Register from "./components/auth/register";
import Landing from "./components/landing/landing";
import Confirmation from "./components/landing/confirmation";

const routes = [
    {
        path: "/confirmation",
        name: "confirmation",
        component: Confirmation
    },
    {
        path: "/",
        name: "login",
        component: Login
    },
    {
        path: "/register",
        name: "register",
        component: Register
    },
    {
        path: "/landing",
        name: "landing",
        component: Landing
    }
];

const router = new VueRouter({
    routes,
    mode: "history"
});

export default router;
