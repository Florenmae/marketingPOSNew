<template>
    <div>
        <!-- Hide the password input area for existing users -->
        <div v-if="isNewUser">
            <label for="password">Password</label>
            <input
                v-model="password"
                type="password"
                id="password"
                name="password"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="Enter password"
            />
        </div>

        <button @click="submitUser">
            {{ isNewUser ? "Add User" : "Update User" }}
        </button>
    </div>
</template>

<script>
export default {
    props: {
        editedUserId: String,
    },
    data() {
        return {
            name: "",
            email: "",
            role: "",
            password: "",
        };
    },
    computed: {
        isNewUser() {
            return !this.editedUserId;
        },
    },
    methods: {
        submitUser() {
            const userData = {
                ...(this.isNewUser ? { password: this.password } : {}),
            };

            this.$emit("update-user", userData);
        },
    },
};
</script>
