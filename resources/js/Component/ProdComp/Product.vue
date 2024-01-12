<template>
    <Layout>
        <Modal
            :modalContent="modalContent"
            :buttonLabel="'Add Product'"
            :cancelLabel="'Cancel'"
            :saveLabel="'Save'"
            @save="submitProduct"
            :save-option="true"
        >
            <form @submit.prevent="submitProduct" class="p-4 md:p-5">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label
                            for="product_code"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            >Product Code</label
                        >
                        <input
                            v-model="product_code"
                            type="text"
                            name="product_code"
                            id="product_code"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Type the product code"
                            required=""
                        />
                    </div>
                    <div class="col-span-2">
                        <label
                            for="description"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            >Item Code</label
                        >
                        <input
                            v-model="item_code"
                            type="text"
                            name="item_code"
                            id="item_code"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Type the item code"
                            required=""
                        />
                    </div>
                    <div class="col-span-2 border-red-500">
                        <label
                            for="name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            >Product Name</label
                        >
                        <input
                            v-model="name"
                            type="text"
                            name="name"
                            id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Type product name"
                            required=""
                        />
                    </div>
                    <div class="col-span-2 border-red-500">
                        <label
                            for="supplier"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            >Product supplier</label
                        >
                        <select
                            v-model="supplier"
                            type="text"
                            name="supplier"
                            id="supplier"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Type product name"
                            required=""
                        >
                            <option selected>Choose a supplier</option>
                            <option value="IGP">IGP</option>
                            <option value="Project">Project</option>
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label
                            for="price"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            >Price</label
                        >
                        <input
                            v-model="price"
                            type="text"
                            name="price"
                            id="price"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Type the product price"
                            required=""
                        />
                    </div>
                    <div class="col-span-2">
                        <label
                            for="qty"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            >Quantity</label
                        >
                        <input
                            v-model="qty"
                            type="text"
                            name="qty"
                            id="qty"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Product Quantity"
                            required=""
                        />
                    </div>
                    <div class="col-span-2">
                        <label
                            for="description"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            >Description</label
                        >
                        <textarea
                            v-model="description"
                            type="text"
                            name="description"
                            id="description"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Product Details"
                            required=""
                        />
                    </div>
                </div>
            </form>
        </Modal>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table
                class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
            >
                <thead
                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                >
                    <tr>
                        <th scope="col" class="px-6 py-3">Product Name</th>
                        <th scope="col" class="px-6 py-3">Category</th>
                        <th scope="col" class="px-6 py-3">Item Code</th>
                        <th scope="col" class="px-6 py-3">Product Supplier</th>
                        <th scope="col" class="px-6 py-3">Price</th>
                        <th scope="col" class="px-6 py-3">Quantity</th>
                        <th scope="col" class="px-6 py-3">Description</th>
                        <th scope="col" class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="product in products"
                        :key="product.id"
                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700"
                    >
                        <th
                            scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                        >
                            {{ product.name }}
                        </th>
                        <td class="px-6 py-4">{{ product.product_code }}</td>
                        <td class="px-6 py-4">{{ product.item_code }}</td>
                        <td class="px-6 py-4">{{ product.supplier }}</td>
                        <td class="px-6 py-4">{{ product.price }}</td>
                        <td class="px-6 py-4">{{ product.qty }}</td>
                        <td class="px-6 py-4">{{ product.description }}</td>
                        <td>
                            <a
                                @click="editProduct(product)"
                                class="bg-green-700 py-2 px-4 rounded text-white"
                                >Edit</a
                            >
                        </td>
                        <td class="py-4">
                            <button
                                class="bg-red-500 py-2 px-4 rounded text-white"
                                @click="deleteProduct(product.id)"
                            >
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </Layout>
</template>

<script>
import Modal from "@/Component/Modal.vue";
export default {
    components: {
        Modal,
    },
    data() {
        return {
            item_code: "",
            product_code: "",
            name: "",
            supplier: "",
            price: "",
            qty: "",
            description: "",
            products: [],
            modalStatus: false,
            modalContent: {
                title: "Create New Product",
                content: "Please fill in the product details",
                disablebtn: false,
            },
        };
    },
    methods: {
        submitProduct() {
            const {
                item_code,
                product_code,
                name,
                supplier,
                price,
                qty,
                description,
            } = this;
            axios
                .post("/submit-product", {
                    item_code,
                    product_code,
                    name,
                    supplier,
                    price,
                    qty,
                    description,
                })
                .then(({ data }) => {
                    this.item_code = "";
                    this.product_code = "";
                    this.name = "";
                    this.supplier = "";
                    this.price = "";
                    this.qty = "";
                    this.description = "";
                    this.changeModalStatus();
                    this.getProducts();
                });
        },
        changeModalStatus() {
            this.modalStatus = !this.modalStatus;
            this.$router.push("/product");
        },
        getProducts() {
            axios.get("/get-products").then(({ data }) => {
                this.products = data;
            });
        },
        deleteProduct(id) {
            axios.post("/delete-product", { id }).then(({ data }) => {
                this.emit("success");
            });
        },
        clearForm() {
            this.product_code = " ";
            this.item_code = " ";
            this.name = " ";
            this.price = " ";
            this.qty = " ";
            this.description = " ";
            this.editingCategoryId = null;
        },
    },
    mounted() {
        this.getProducts();
    },
};
</script>
