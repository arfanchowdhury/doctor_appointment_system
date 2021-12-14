<template>
    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <form @submit.prevent="updateUser()">
            <div class="grid grid-cols-1 gap-2 md:grid-cols-3">
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Name</span>
                    <input v-model="user.name" type="text" required class="block w-full mt-1 text-sm rounded dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-purple-500 dark:text-gray-300 dark:focus:shadow-gray-500 form-input" placeholder="name">
                </label>

                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Email</span>
                    <input v-model="user.email" type="email" required class="block w-full mt-1 text-sm rounded dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-purple-500 dark:text-gray-300 dark:focus:shadow-gray-500 form-input" placeholder="email">
                </label>

                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Phone number</span>
                    <input v-model="user.phone_no" type="number" required class="block w-full mt-1 text-sm rounded dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-purple-500 dark:text-gray-300 dark:focus:shadow-gray-500 form-input" placeholder="phone number">
                </label>
            </div>

            <div class="grid grid-cols-1 gap-2 mt-4 md:grid-cols-3">
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                    Gender
                    </span>
                    <select v-model="user.gender" class="block w-full mt-1 text-sm rounded dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                        <option value="-1">--Select Gender--</option>
                        <option value="1">Male</option>
                        <option value="2">Female</option>
                    </select>
                </label>
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                    Blood Group
                    </span>
                    <select v-model="user.blood_group_id" class="block w-full mt-1 text-sm rounded dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                        <option value="-1">--Select Blood Group--</option>
                        <option v-for="bloodGroup in bloodGroups" :key="bloodGroup.id" :value="bloodGroup.id">
                            {{ bloodGroup.name }}
                        </option>
                    </select>
                </label>

                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Birthdate</span>
                    <input v-model="user.birth_date" type="date" required class="block w-full mt-1 text-sm rounded dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-purple-500 dark:text-gray-300 dark:focus:shadow-gray-500 form-input" placeholder="birth date">
                </label>
            </div>
            
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Address</span>
                <textarea v-model="user.address" class="block w-full mt-1 text-sm rounded dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" rows="3" placeholder="Address" spellcheck="false"></textarea>
            </label>

            <label class="block mt-8 text-sm text-center">
                <button type="submit" class="w-full flex justify-center items-center gap-2 px-4 py-2 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Update profile
                    <span v-if="isLoading">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 animate-spin" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </button>
            </label>

            <label class="block mt-4 text-sm">
                <span v-if="isSaved" class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                    Updated
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
import { useStore } from 'vuex';
import UserService from '../services/UserService';
import BloodGroupService from '../services/BloodGroupService';


//get user
const user = ref({});

UserService.getUserDetails()
.then((response) => {
    user.value = response.data;
    })
.catch((err) => {alert(err)});


//get bloodgroups
const bloodGroups = ref({});

BloodGroupService.getBloodGroups()
.then((response) => {
    bloodGroups.value = response.data.data;
    })
.catch((err) => {alert(err)});


//update patient
const store = useStore();
const isLoading = ref(false);
const isSaved = ref(false);
const errors = ref(null);

function updateUser(){
    isLoading.value = true;
    UserService.updateUser(user.value.id, user.value)
    .then(() => {
        store.dispatch("getCurrentUser").then(() => {
            isLoading.value = false;
            isSaved.value = true;
        }).catch((error) => {alert(error)});
        errors.value = null;
    })
    .catch((updateUserError) => {
        errors.value = updateUserError.response.data;
        isLoading.value = false;
        isSaved.value = false;

    });
}
</script>

