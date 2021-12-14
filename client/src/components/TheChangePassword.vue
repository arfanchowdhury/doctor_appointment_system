<template>
    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <form @submit.prevent="changePassword()">
            <div class="grid grid-cols-1 gap-2">
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">New password</span>
                    <input v-model="formData.password" type="password" required class="block w-full mt-1 text-sm rounded dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-purple-500 dark:text-gray-300 dark:focus:shadow-gray-500 form-input" placeholder="new password">
                </label>

                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Confirm Password</span>
                    <input v-model="formData.password_confirmation" type="password" required class="block w-full mt-1 text-sm rounded dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-purple-500 dark:text-gray-300 dark:focus:shadow-gray-500 form-input" placeholder="confirm password">
                </label>
            </div>

            <label class="block mt-8 text-sm text-center">
                <button type="submit" class="w-full flex justify-center items-center gap-2 px-4 py-2 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Change password
                    <span v-if="isLoading">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 animate-spin" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </button>
            </label>

            <label class="block mt-4 text-sm">
                <span v-if="isSaved" class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                    Your password has been changed.
                </span>
            </label>
        </form>

        <div v-if="errors" class="mt-4 px-3 py-2 w-full rounded text-sm text-red-500 bg-red-100 animate-pulse">
            <p class="font-semibold tracking-wide">
                <strong>Error:</strong> {{ errors.message }}
            </p>
            <ul class="mt-1 ml-2 list-disc list-inside">
                <li v-for="allErrors in errors.errors" :key="allErrors">
                    <span v-for="errorKeys in allErrors" :key="errorKeys">
                        <span v-for="errorMessage in errorKeys" :key="errorMessage">
                            {{ errorMessage }}
                        </span> 
                    </span>
                </li>
            </ul>
        </div>
    </div>
</template>
<script setup>
import { ref } from 'vue';
import UserService from '../services/UserService';


//change password
const formData = ref({
    password: null,
    password_confirmation: null
});
const isLoading = ref(false);
const isSaved = ref(false);
const errors = ref(null);

function changePassword(){
    isLoading.value = true;
    UserService.changePassword(formData.value)
    .then(() => {
        isLoading.value = false;
        isSaved.value = true;
        errors.value = null;
    })
    .catch((changePasswordError) => {
        isLoading.value = false;
        isSaved.value = false;
        errors.value = changePasswordError.response.data;
    });
}
</script>

