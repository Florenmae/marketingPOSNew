<template>
    <Layout>
        <!-- Add User Modal -->
        <Modal
            :modalContent="modalContent"
            :buttonLabel="'Add User'"
            :cancelLabel="'Cancel'"
            :saveLabel="'Save'"
            @save="submitUser"
            :save-option="true"
        >
            <form @submit.prevent="submitUser">
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
                    <div class="col-span-2 border-red-500">
                        <label
                            for="password"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            >Temporary Password</label
                        >
                        <input
                            v-model="editedUser.password"
                            type="text"
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
                        <EditUser :user="user" />
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
    </Layout>
</template>

<script>
import axios from "axios";
import Modal from "@/Component/Modal.vue";
import EditUser from "@/Component/UserComp/EditUser.vue";

export default {
    components: {
        Modal,
        EditUser,
    },
    data() {
        return {
            modalStatus: false,
            users: [],
            editedUser: {
                name: "",
                email: "",
                role: "",
                password: "",
            },
            editingUserId: null,
            modalContent: {
                title: "Create New User",
                content: "Please fill in the user details",
                disablebtn: false,
            },
        };
    },

    methods: {
        submitUser() {
            const { editedUser } = this;

            const userPayload = {
                name: editedUser.name,
                email: editedUser.email,
                role: editedUser.role,
                password: editedUser.password,
            };

            axios
                .post("/submit-user", userPayload)
                .then(({ data }) => {
                    this.clearForm();
                    this.getUsers();
                    this.changeModalStatus();
                })
                .catch((error) => {
                    console.error("Error submitting user:", error);
                });
        },
        changeModalStatus() {
            this.modalStatus = !this.modalStatus;
        },
        getUsers() {
            axios
                .get("/get-users")
                .then(({ data }) => {
                    this.users = data;
                    console.log(data);
                })
                .catch((error) => {
                    console.error("Error fetching users:", error);
                });
        },
        updateExistingUser(data) {
            const { editedUser, editingUserId } = this;
            const userPayload = { ...editedUser };
            delete userPayload.password;

            axios
                .post("/update-user", { userPayload, editingUserId })
                .then(({ data }) => {
                    this.clearForm();
                    this.getUsers();
                    this.changeModalStatus();
                })
                .catch((error) => {
                    console.error("Error updating user:", error);
                });
        },

        editUser(user) {
            this.editedUser = { ...user };
            this.editingUserId = user.id;
            this.modalContent.title = "Edit User";
            this.modalStatus = true;
        },

        deleteUser(id) {
            axios
                .post("/delete-user", { id })
                .then(({ data }) => {
                    this.getUsers();
                })
                .catch((error) => {
                    console.error("Error deleting user:", error);
                });
        },
        clearForm() {
            this.editedUser = {
                name: "",
                email: "",
                role: "",
                password: "",
            };
            this.changeModalStatus();
            this.editingUserId = null;
        },
    },
    mounted() {
        this.getUsers();
    },
};
</script>
