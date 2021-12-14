<template>
    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <form @submit.prevent="saveDoctor">
            <div class="grid grid-cols-1 gap-2 md:grid-cols-3">
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                        Name <span class="-ml-1 text-red-500">*</span>
                    </span>
                    <input type="text" v-model="formData.name" required class="block rounded w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="name">
                </label>

                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                        Email <span class="-ml-1 text-red-500">*</span>
                    </span>
                    <input type="email" v-model="formData.email" required class="block rounded w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="email">
                </label>

                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                        Phone Number <span class="-ml-1 text-red-500">*</span>
                    </span>
                    <input type="number" v-model="formData.phone_no" required class="block rounded w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="phone number">
                </label>
            </div>

            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                    Specialities <span class="-ml-1 text-red-500">*</span>
                </span>
                <select v-model="formData.specialities" required multiple class="block rounded w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-multiselect focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                    <option value="">--Select Speciality---</option>
                    <option v-for="speciality in specialities" :key="speciality.id" :value="speciality.id">
                        {{ speciality.name }}
                    </option>
                </select>
            </label>

            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                    Address <span class="-ml-1 text-red-500">*</span>
                </span>
                <textarea v-model="formData.address" required class="block rounded w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" rows="3" placeholder="address"></textarea>
            </label>

            <div class="mt-6 mb-2">
                <button type="submit" :disabled="isLoading" class="w-auto flex items-center justify-center gap-1 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    <span>Add Doctor</span>
                    <span v-if="isLoading">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 animate-spin" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/>
                        </svg>
                    </span>
                </button>
            </div>
            
            <span v-if="isSaved" class="mt-2 px-2 py-1 text-sm font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                Doctor has been added
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
import {ref, onMounted} from "vue";
import DoctorService from "../../../services/DoctorService";
import SpecialityService from "../../../services/SpecialityService";

export default {
    setup(){

        // formData and save doctor
        const formData = ref({
            name: "",
            email: "",
            phone_no: "",
            address: "",
            specialities: [],
        });
        const isLoading = ref(false);
        const isSaved = ref(null);
        const errors = ref(null);

        function saveDoctor() {
			this.isLoading = true;
            DoctorService.saveDoctor(this.formData)
            .then((saveDoctorResponse) => {
                isSaved.value = saveDoctorResponse.data.status;
                isLoading.value = false;
                errors.value = null;
            })
            .catch((saveDoctorError) => {
                errors.value = saveDoctorError.response.data;
                isLoading.value = false;
                isSaved.value = false;
            });
		}


        //get specialities
        const specialities = ref(null);

        function getSpecialities() {
			SpecialityService.getSpecialities()
				.then((getSpecialitiesResponse) => {
					specialities.value = getSpecialitiesResponse.data.data;
				})
				.catch((getSpecialitiesError) => {
					alert(getSpecialitiesError);
				});
		}

        onMounted(() => {
            getSpecialities()
        })



        return {
            formData,
            isLoading,
            isSaved,
            errors,
            saveDoctor,

            specialities,
        }
    },
};
</script>
