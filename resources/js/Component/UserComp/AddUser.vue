<template>
    <form @submit.prevent="submitUser">
        <div class="grid gap-4 mb-4 grid-cols-2">
            <div class="col-span-2 border-red-500">
                <label
                    for="name"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Name</label
                >
                <input
                    v-model="name"
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
                    v-model="email"
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
                    v-model="role"
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
                    v-model="password"
                    type="text"
                    id="password"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Type Temporary Password"
                    required=""
                />
            </div>
        </div>
    </form>
</template>

<script>
import EditUser from "./EditUser.vue";

export default {
    props: {
        user: Object,
    },
    data() {
        return {
            name: "",
            email: "",
            role: "",
            password: "",
        };
    },
    methods: {
        methods: {
            // submitUser() {
            //     const { name, email, role, password } = this;
            //     axios
            //         .post("/submit-student", { name, email, role, password })
            //         .then(({ data }) => {
            //             this.name = "";
            //             this.email = "";
            //             this.role = " ";
            //             this.password = "";
            //             this.clearForm();
            //             this.getUsers();
            //             this.changeModalStatus();
            //         });
            // },
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
        },
    },
};
</script>
