<template>
    <Layout>
        <MainUser :userData="userData" />
        <Product :productData="productData" />
    </Layout>
</template>

<script>
import Layout from "../Layout/Layout.vue";
import MainUser from "@/Component/UserComp/MainUser.vue";
import EditUser from "@/Component/UserComp/EditUser.vue";
import Product from "@/Component/ProdComp/Product.vue";
import Modal from "../Component/Modal.vue";

export default {
    props: ["authenticated"],
    components: {
        Layout,
        MainUser,
        EditUser,
        Modal,
        Product,
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
        fetchData() {
            axios.get("/get-users").then(({ data }) => {
                this.userData = data;
            });

            axios.get("/get-categories").then(({ data }) => {
                this.categoryData = data;
            });

            axios.get("/get-products").then(({ data }) => {
                this.productData = data;
            });
        },
    },
    mounted() {
        this.checkAuth();
        this.fetchData();
    },
};
</script>
