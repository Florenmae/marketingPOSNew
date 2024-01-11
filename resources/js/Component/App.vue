<template>
    <Layout :authenticated="this.authenticated"> <MainUser /> </Layout>
</template>

<script>
import Layout from "../Layout/Layout.vue";
//import User from "@/Component/UserComp/User.vue";
import MainUser from "@/Component/UserComp/MainUser.vue";
import AddUser from "@/Component/UserComp/AddUser.vue";
import EditUser from "@/Component/UserComp/EditUser.vue";
import Modal from "../Component/Modal.vue";

export default {
    props: ["authenticated"],
    components: {
        Layout,
        MainUser,
        AddUser,
        EditUser,
        Modal,
    },
    data() {
        return {
            authenticated: 0,
            users: [],
        };
    },
    methods: {
        //check user if authenticated
        checkAuth() {
            axios.get("/checkUser").then(({ data }) => {
                console.log(data);
                this.authenticated = data;
                console.log(this.authenticated);
                if (this.authenticated == 0) {
                    this.$router.push("/");
                }
            });
        },
        editSuccess() {
            this.checkAuth();
        },
    },
    mounted() {
        this.checkAuth();
    },

    watch: {
        authenticated(newValue) {
            if (!newValue) {
                this.$router.push("/");
            }
        },
    },
};
</script>
