import "./bootstrap";
import { createApp } from "vue/dist/vue.esm-bundler";
import App from "@/Component/App.vue";
import Modal from "@/Component/Modal.vue";
import User from "@/Component/UserComp/User.vue";
import AddUser from "@/Component/UserComp/AddUser.vue";
import EditUser from "@/Component/UserComp/EditUser.vue";
import MainUser from "@/Component/UserComp/MainUser.vue";
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
app.component("MainUser", MainUser);
app.component("AddUser", AddUser);
app.component("EditUser", EditUser);
app.component("modal", Modal);
//app.component("userform", UserForm);
app.component("Layout", Layout);

app.mount("#app");
