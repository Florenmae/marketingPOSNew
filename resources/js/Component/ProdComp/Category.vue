<template>
    <Layout>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <addCategory class="fixed top-20 right-10"></addCategory>
            <table
                class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
            >
                <thead
                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                >
                    <tr>
                        <th scope="col" class="px-6 py-3">Category Name</th>
                        <th scope="col" class="px-6 py-3">Category Code</th>
                        <th scope="col" class="px-6 py-3">Product Count</th>
                        <th scope="col" class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="category in categories"
                        :key="category.id"
                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700"
                    >
                        <th
                            scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                        >
                            {{ category.categoryName }}
                        </th>
                        <td class="px-6 py-4">{{ category.cat_code }}</td>
                        <td class="px-6 py-4">{{ category.product_count }}</td>

                        <td>
                            <editCategory :category="category" />
                        </td>
                        <td class="py-4">
                            <button
                                class="bg-red-500 py-2 px-4 rounded text-white"
                                @click="deleteCategory(category.id)"
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
import editCategory from "@/Component/ProdComp/editCategory.vue";
import addCategory from "@/Component/ProdComp/addCategory.vue";
export default {
    components: {
        Modal,
        addCategory,
        editCategory,
    },
    data() {
        return {
            editCategory: {
                cat_code: "",
                categoryName: "",
                product_count: "",
            },
            categories: [],
            editingCategoryId: null,
            modalStatus: false,
        };
    },
    methods: {
        submitCategory() {
            const { editCategory } = this;
            const catPayload = {
                ...editCategory,
            };

            axios
                .post("/submit-category", catPayload)
                .then(({ data }) => {
                    this.clearForm();
                    this.getCategories();
                    this.changeModalStatus();
                })
                .catch((error) => {
                    console.error("Error submitting category:", error);
                });
        },
        changeModalStatus() {
            this.modalStatus = !this.modalStatus;
        },

        getCategories() {
            axios.get("/get-categories").then(({ data }) => {
                this.categories = data;
            });
        },
        editCategory(category) {
            this.editCategory = { ...category };
            this.editingCategoryId = category.id;
            this.modalContent.title = "Edit Category";
            this.modalStatus = true;
        },

        updateCategory(data) {
            const { editCategory, editingCategoryId } = this;
            const catPayload = { ...editCategory };

            axios
                .post("/update-category", { catPayload, editingCategoryId })
                .then(({ data }) => {
                    this.getCategories();
                    this.changeModalStatus();
                });
        },

        deleteCategory(id) {
            axios.post("/delete-category", { id }).then(({ data }) => {
                this.getCategories();
            });
        },
        // clearForm() {
        //     this.editCategory = {
        //         cat_code: "",
        //         categoryName: "",
        //         product_count: "",
        //     };
        //     this.changeModalStatus();
        //     this.editingCategoryId = null;
        // },
    },
    mounted() {
        this.getCategories();
    },
};
</script>
