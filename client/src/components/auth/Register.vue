<template>
    <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
        <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800">
            <div class="flex flex-col overflow-y-auto md:flex-row">
                <div class="h-32 md:h-auto md:w-1/2">
                    <img aria-hidden="true" class="object-cover w-full h-full dark:hidden" src="https://images.unsplash.com/photo-1607368386669-d940ce438fba?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=333&q=80" alt="Office">
                </div>
                <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                    <div class="w-full">
                        <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">
                            Create account
                        </h1>
                        <form @submit.prevent="register(formData)">
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Name</span>
                                <input type="text" v-model="formData.name" required class="block rounded w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="name">
                            </label>
                            <label class="block mt-4 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Email</span>
                                <input type="email" v-model="formData.email" required class="block rounded w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="email">
                            </label>
                            <label class="block mt-4 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Phone number</span>
                                <input type="number" v-model="formData.phone_no" required class="block rounded w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="phone number">
                            </label>
                            <label class="block mt-4 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Password</span>
                                <input type="password" v-model="formData.password" class="block rounded w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="***************">
                            </label>
                            <label class="block mt-4 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">
                                    Confirm password
                                </span>
                                <input type="password" v-model="formData.password_confirmation" class="block rounded w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="***************">
                            </label>

                            <button type="submit" class="flex justify-center items-center gap-1.5 w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" href="./login.html">
                                Create account
                                <span v-if="isLoading">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 animate-spin" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/>
                                    </svg>
                                </span>
                            </button>
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
                        <hr class="my-8">
                        <p class="mt-4">
                            Already have an account?
                            <router-link :to="{ name: 'auth.login' }">
                                <a class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline">
                                    Login
                                </a>
                            </router-link>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {ref} from "vue";
import {useStore} from "vuex";
import {useRouter} from "vue-router";
import AuthenticationService from "../../services/AuthenticationService";

export default {
	setup() {
        //login function
        const store = useStore();
        const router = useRouter();

        function login(user) {
			Store.dispatch("login", user)
            .then(() => {
                store.dispatch("getCurrentUser")
                .then((currentUserResponse) => {
                    const ROLE_ID = currentUserResponse.data.role_id;
                    if (ROLE_ID === 1) {
                        router.push({ name: "admin.home" });
                    } else if (ROLE_ID === 2) {
                        router.push({ name: "doctor.home" });
                    } else if (ROLE_ID === 3) {
                        router.push({ name: "patient.home" });
                    }
                })
                .catch((getCurrentUserError) => {
                    alert(getCurrentUserError);
                });
            })
            .catch((loginError) => {
                alert(loginError);
            });
		};
        
        //register function
        const formData = ref({
            name: "",
            email: "",
            phone_number: "",
            password: "",
            password_confirmation: "",
        });
        const isLoading = ref(false);
        const errors = ref(null);

        function register() {
            isLoading.value = true;
            AuthenticationService.register( formData.value )
            .then(() => {
                login(formData.value);
                isLoading.value = false;
            })
            .catch((registerError) => {
               errors.value = registerError.response.data;
               isLoading.value = false;
            });
		}

		return {
			formData,
            isLoading,
            errors,
            register
		};
	},
};
</script>

<style></style>
