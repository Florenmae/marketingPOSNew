<template>
    <Layout>
        <!-- Main modal -->
        <Modal
            :modalContent="{
                title: 'Create New User',
                content: 'Please fill in the user details',
            }"
            buttonLabel="Add User"
            cancelLabel="Cancel"
            saveLabel="Submit"
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
                            v-model="name"
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
                            v-model="email"
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
                            v-model="role"
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
                    <div class="col-span-2 border-red-500">
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
                            <!-- Modal for editing user -->
                            <Modal
                                :modalContent="{
                                    title: 'Edit User',
                                    content: 'Please edit in the user details',
                                }"
                                buttonLabel="Edit"
                                cancelLabel="Cancel"
                                saveLabel="Update"
                                @save="updateUser"
                            >
                                <form @submit.prevent="updateUser">
                                    <div class="mb-4">
                                        <label
                                            for="name"
                                            class="block text-sm font-medium text-gray-900 dark:text-white"
                                        >
                                            Name
                                        </label>
                                        <input
                                            type="text"
                                            name="name"
                                            id="name"
                                            :value="user.name"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Name"
                                            required
                                        />
                                    </div>

                                    <!-- Add fields for user.email and user.role -->
                                    <div class="mb-4">
                                        <label
                                            for="email"
                                            class="block text-sm font-medium text-gray-900 dark:text-white"
                                        >
                                            Email
                                        </label>
                                        <input
                                            type="text"
                                            name="email"
                                            id="email"
                                            :value="user.email"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Email"
                                            required
                                        />
                                    </div>

                                    <div class="mb-4">
                                        <label
                                            for="role"
                                            class="block text-sm font-medium text-gray-900 dark:text-white"
                                        >
                                            Role
                                        </label>

                                        <select
                                            :value="user.role"
                                            name="role"
                                            id="role"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Select a role"
                                            required
                                        >
                                            <option selected>
                                                Choose a role
                                            </option>
                                            <option value="admin">admin</option>
                                            <option value="IGP">IGP</option>
                                            <option value="Project">
                                                Project
                                            </option>
                                            <option value="Employee">
                                                Employee
                                            </option>
                                        </select>
                                    </div>
                                </form>
                            </Modal>
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
import Modal from "@/Component/Modal.vue";

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
        },
    },
    };
</script>
