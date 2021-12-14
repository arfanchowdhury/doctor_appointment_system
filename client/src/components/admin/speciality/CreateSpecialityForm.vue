<template>
    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <form @submit.prevent="saveSpeciality">
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                    Speciality name
                </span>
                <input type="text" required v-model="formData.name" class=" block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input rounded" placeholder="Ex: Heart"/>
            </label>
            
            <div class="mt-4 mb-2">
                <button type="submit" :disabled="isLoading" class="w-auto flex items-center justify-center gap-1 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    <span>Add Speciality</span>
                    <span v-if="isLoading">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 animate-spin" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/>
                        </svg>
                    </span>
                </button>
            </div>

            <span v-if="isSaved" class="mt-2 px-2 py-1 text-sm font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                Speciality has been added
            </span>
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
<script>
import {ref} from "vue";
import SpecialityService from "../../../services/SpecialityService";

export default {
	setup() {
        const formData = ref({name: ""});
        const isLoading = ref(false);
        const isSaved = ref(null);
        const errors = ref(null);

        function saveSpeciality() {
			this.isLoading = true;
            SpecialityService.saveSpeciality(this.formData)
            .then((saveSpecialityResponse) => {
                isSaved.value = saveSpecialityResponse.data.status;
				isLoading.value = false;
				formData.value.name = "";
                errors.value = null;
            })
            .catch((saveSpecialityError) => {
                errors.value = saveSpecialityError.response.data;
                isSaved.value = false;
				isLoading.value = false;
            });
		}

		return {
			formData,
            isLoading,
            isSaved,
            errors,
            saveSpeciality
		};
	},
};
</script>
