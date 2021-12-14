<template>
    <div>
        <div class="mb-2">
            <span v-if="isUpdated" class="text-sm px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                Update Successfull
            </span>
        </div>
        <div class="w-full mb-4 overflow-hidden rounded-lg shadow-sm border">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class=" text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Created at</th>
                            <th class="px-4 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        <tr v-for="(speciality, index) in specialities" :key="speciality.id" class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3 text-sm">
                                {{ index + 1 }}
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <div>
                                        <p class="font-semibold">
                                            {{ speciality.name ? speciality.name : "N/A" }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-xs">
                                {{ moment(speciality.created_at).fromNow() }}
                            </td>
                            <td class="px-4 py-3 text-xs">
                                <div class="flex items-center space-x-4 text-sm">
                                    <button @click="openModel(index)" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div v-if="isModalOpen" class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center">
                <div v-if="isModalOpen" class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl" role="dialog" id="modal">
                    <form @submit.prevent="updateSpeciality()">
                        <header class="flex justify-end">
                            <button @click="closeModal" class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-700" aria-label="close">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img" aria-hidden="true">
                                    <path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path>
                                </svg>
                            </button>
                        </header>
                        <div class="mb-6">
                            <p class="mb-4 text-lg font-semibold text-gray-700 dark:text-gray-300">
                                Edit speciality
                            </p>
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">
                                    Name
                                </span>
                                <input v-model="formData.name" required class=" block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input rounded" placeholder="Ex: Heart"/>
                            </label>

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
                        <footer class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800">
                            <button @click="closeModal" class="w-full px-5 py-3 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                                Cancel
                            </button>
                            <button type="submit" :disabled="isLoading" class="flex items-center gap-1.5 w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                Update Speciality
                                <span v-if="isLoading">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 animate-spin" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/>
                                    </svg>
                                </span>
                            </button>
                        </footer>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { ref } from "vue";
import moment from 'moment';
import SpecialityService from "../../../services/SpecialityService";

export default {
	async setup() {

        //get and update speciality functons
		const response = ref(await SpecialityService.getSpecialities());
		const specialities = response.value.data.data;
		const isLoading = ref(false);
        const isUpdated = ref(false);
        const errors = ref(null);

        function updateSpeciality() {
			isLoading.value = true;
			SpecialityService.updateSpeciality(formData.value.id, formData.value)
            .then((updateSpecialityResponse) => {
                errors.value = null;
                isLoading.value = false;
                isUpdated.value = updateSpecialityResponse.status;
                closeModal();
            })
            .catch((updateSpecialityError) => {
                errors.value = updateSpecialityError.response.data;
                isUpdated.value = false;
				isLoading.value = false;
            });
		}


        //modal functions
        const formData = ref({});
        const isModalOpen = ref(false);

		function openModel(index) {
			formData.value = specialities[index];
			isModalOpen.value = true;
            errors.value = null;
		}

		function closeModal() {
            formData.value = {};
			isModalOpen.value = false;
            errors.value = null;
		}


		return {
			specialities,
			isLoading,
            isUpdated,
            errors,
			updateSpeciality,

            formData,
            isModalOpen,
			openModel,
			closeModal,

            moment
		};
	},
};
</script>
