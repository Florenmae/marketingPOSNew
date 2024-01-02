<template>
    <Layout :authenticated="this.authenticated"> </Layout>
</template>

<script>
import Layout from "../Layout/Layout.vue";
import User from "../Component/UserComp/User.vue";
import UserForm from "../Component/UserComp/UserForm.vue";

export default {
    props: ["authenticated"],
    components: {
        Layout,
        User,
        UserForm,
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
