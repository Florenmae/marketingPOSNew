<template>
    <Layout>
        <!-- Add User button -->
        <button
            class="fixed top-20 right-10 block text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            type="button"
            @click="addUser"
        >
            Add User
        </button>

        <!-- Main modal -->
        <Modal
            :modal-content="modalContent"
            :button-label="isNewUser ? 'Add User' : 'Edit User'"
            :cancel-label="isNewUser ? 'Cancel' : 'Close'"
            :save-label="isNewUser ? 'Save' : 'Update'"
            @save="submitUser"
        >
            <form slot="content" @submit.prevent="submitUser">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2 border-red-500">
                        <label
                            for="name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            >Name</label
                        >
                        <input
                            v-model="editedUser.name"
                            type="text"
                            name="name"
                            id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Name"
                            required
                        />
                    </div>
                    <div class="col-span-2 border-red-500">
                        <label
                            for="email"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            >Email</label
                        >
                        <input
                            v-model="editedUser.email"
                            type="text"
                            name="email"
                            id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Email"
                            required
                        />
                    </div>
                    <div class="col-span-2">
                        <label
                            for="role"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            >Select a Role</label
                        >
                        <select
                            v-model="editedUser.role"
                            name="role"
                            id="role"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Select a role"
                            required
                        >
                            <option selected>Choose a role</option>
                            <option value="admin">admin</option>
                            <option value="IGP">IGP</option>
                            <option value="Project">Project</option>
                            <option value="Employee">Employee</option>
                        </select>
                    </div>
                    <div v-if="isNewUser" class="col-span-2 border-red-500">
                        <label
                            for="password"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            >Temporary Password</label
                        >
                        <input
                            v-model="password"
                            type="text"
                            name="password"
                            id="password"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Type Temporary Password"
                            required=""
                        />
                    </div>
                </div>
            </form>
        </Modal>

        <!-- Table -->
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table
                class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
            >
                <thead
                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                >
                    <tr>
                        <th scope="col" class="px-6 py-3">Name</th>
                        <th scope="col" class="px-6 py-3">Role</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="user in users"
                        :key="user.id"
                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700"
                    >
                        <th
                            scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                        >
                            {{ user.name }}
                        </th>
                        <td class="px-6 py-4">{{ user.role }}</td>
                        <td class="px-6 py-4">{{ user.email }}</td>
                        <td>
                            <button
                                class="bg-green-700 py-2 px-4 rounded text-white"
                                @click="editUser(user)"
                            >
                                Edit
                            </button>
                        </td>
                        <td class="py-4">
                            <button
                                class="bg-red-500 py-2 px-4 rounded text-white"
                                @click="deleteUser(user.id)"
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
import axios from "axios";
import Modal from "@/Component/Modal.vue"; // Adjust the import path based on your actual file structure

export default {
    components: {
        Modal,
    },
    data() {
        return {
            name: "",
            email: "",
            role: "",
            password: "",
            modalStatus: false,
            users: [],
            editingUserId: null,
            editedUser: {
                id: null,
                name: "",
                email: "",
                role: "",
                password: "",
            },
            modalContent: {
                title: "User Details",
                content: "Please fill in the user details",
                disablebtn: false,
            },
        };
    },
    computed: {
        isNewUser() {
            return !this.editingUserId;
        },
    },
    methods: {
        submitUser() {
            const { editedUser, editingUserId, isNewUser, password } = this;
            const userPayload = {
                ...editedUser,
            };

            if (editingUserId) {
                delete userPayload.password;
                axios
                    .post(`/update-user/${editingUserId}`, userPayload)
                    .then(({ data }) => {
                        this.clearForm();
                        this.changeModalStatus();
                        this.getUsers();
                    });
            } else {
                axios.post("/submit-user", userPayload).then(({ data }) => {
                    this.clearForm();
                    this.changeModalStatus();
                    this.getUsers();
                    this.users.push(data);
                });
            }
        },
        changeModalStatus() {
            this.modalStatus = !this.modalStatus;
        },
        getUsers() {
            axios.get("/get-users").then(({ data }) => {
                console.log(data);
                this.users = data;
            });
        },
        addUser() {
            this.clearForm();
            this.modalContent.title = "Create New User";
            this.modalStatus = true;
        },
        editUser(user) {
            this.editedUser = { ...user }; // Copy the user object to avoid modifying the original
            this.editingUserId = user.id;
            this.modalContent.title = "Edit User";
            this.modalStatus = true;
        },
        deleteUser(id) {
            axios.post("/delete-user", { id }).then(({ data }) => {
                this.getUsers();
            });
        },
        clearForm() {
            this.editedUser = {
                id: null,
                name: "",
                email: "",
                role: "",
                password: "",
            };
            this.editingUserId = null;
        },
    },
    mounted() {
        this.getUsers();
    },
};
</script>
