import VueRouter from "vue-router";
import Login from "./components/auth/login";
import Register from "./components/auth/register";
import Landing from "./components/landing/landing";
import Confirmation from "./components/landing/confirmation";
import BookIndex from "./components/books/BookIndex.vue";
import BookInfoIndex from "./components/bookinfo/BookInfoIndex.vue";

const routes = [
    {
        path: "/confirmation",
        name: "confirmation",
        component: Confirmation
    },
    {
        path: "/login",
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
    },
    {
        path: "/",
        name: "books",
        component: BookIndex
    },
    {
        path: "/book/:id",
        name: "book",
        component: BookInfoIndex
    }
];

const router = new VueRouter({
    routes,
    mode: "history"
});

export default router;
