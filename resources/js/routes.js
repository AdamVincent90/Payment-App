import VueRouter from "vue-router";
import Login from "./components/auth/login";
import Register from "./components/auth/register";
import Landing from "./components/landing/landing";
import Confirmation from "./components/landing/confirmation";
import store from "./store";

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
        path: "/reset",
        name: "reset",
        component: Register
    },
    {
        path: "/landing/",
        name: "landing",
        component: Landing,
        // beforeEnter: (to, from, next) => {
        //     if(store.dispatch("checkUser")) {
        //         next();
        //     } else {
        //         next({name: "login"});
        //     }
        // }
    }
];

const router = new VueRouter({
    routes,
    mode: 'history',
});

export default router;
