import "./bootstrap";
import { createApp } from "vue/dist/vue.esm-bundler";
import App from "@/Component/App.vue";
import Modal from "@/Component/Modal.vue";
import User from "@/Component/UserComp/User.vue";
//import UserForm from "@/Component/UserComp/UserForm.vue";

import { createRouter, createWebHistory } from "vue-router";
import { routes } from "./routes";

import Layout from "@/Layout/Layout.vue";

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});
const app = createApp({});

app.use(router);

app.component("app", App);
app.component("user", User);
app.component("modal", Modal);
//app.component("userform", UserForm);
app.component("Layout", Layout);

app.mount("#app");
