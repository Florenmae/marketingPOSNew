<template>
    <Layout> <MainUser /> </Layout>
</template>

<script>
import Layout from "../Layout/Layout.vue";
import MainUser from "@/Component/UserComp/MainUser.vue";
import EditUser from "@/Component/UserComp/EditUser.vue";
import Modal from "../Component/Modal.vue";

export default {
    props: ["authenticated"],
    components: {
        Layout,
        MainUser,
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
