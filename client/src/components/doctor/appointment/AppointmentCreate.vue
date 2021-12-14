<template>
	<div class="w-full overflow-hidden rounded-lg shadow-xs">
		<div class="w-full overflow-x-auto">
			<div class=" px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
				<form @submit.prevent="makeDoctorAppointment()" class="flex flex-col gap-4">
					<label class="block text-sm">
						<span class="text-gray-700 dark:text-gray-400">
							Select a patient
						</span>
						<select v-model="formData.patient_id" required class="block rounded w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900 dark:focus:ring-purple-500">
                            <option value="null">--Select Patient--</option>
                            <option v-for="patient in patients" :key="patient.id" :value="patient.id">
                                {{ patient.name }} - {{ patient.email }}
                            </option>
                        </select>
					</label>
                    <label class="block text-sm">
						<span class="text-gray-700 dark:text-gray-400">
							Select a date
						</span>
						<input type="date" v-model="formData.appointment_date" required :min="moment().format('YYYY-MM-DD')" :max="moment().add(1, 'w').format('YYYY-MM-DD')" class="block rounded w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-input focus:border-purple-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900 dark:focus:ring-purple-500" />  
					</label>
                    <div class="flex flex-col md:flex-row md:justify-between gap-2">
                        <label class="w-full block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">
                                From
                            </span>
                            <input type="time" v-model="formData.start_at" required class="block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input rounded" />
                        </label>

                        <label class="w-full block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">
                                To
                            </span>
                            <input type="time" v-model="formData.end_at" required :min="formData.start_at" class="block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input rounded" />
                        </label>
                    </div>

					<div class="mb-2">
                        <button type="submit" class=" w-auto flex items-center justify-center gap-1 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            <span>Make Appointment</span>
                            <span v-if="isLoading">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 animate-spin" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/>
                                </svg>
                            </span>
                        </button>
                    </div>
					<div v-if="isSaved">
                        <span class="text-sm px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                            Appointment is successfully saved
                        </span>
                    </div>
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
		</div>
	</div>
</template>
<script>
import PatientService from "../../../services/PatientService";
import AppointmentService from "../../../services/AppointmentService";
import { ref, computed } from "vue";
import moment from 'moment';

export default {
	async setup() {
        const patientsResponse = ref(await PatientService.getPatientForDoctor());
		const patients = computed(() => patientsResponse.value.data.data);
		const isLoading = ref(false);
		const isSaved = ref(false);
        const errors = ref(null);
        const formData = ref({patient_id: null, appointment_date: null, start_at: null, end_at: null});
        

        function makeDoctorAppointment() {
            if(formData.value.doctor_id !== null && formData.value.appointment_date !== null)
            {
                isLoading.value = true;

                AppointmentService.makeDoctorAppointment(formData.value)
                .then((makeDoctorAppointmentResponse) => {
                    isLoading.value = false;
                    isSaved.value = makeDoctorAppointmentResponse.data.status;
                    formData.value.patient_id = null;
                    formData.value.appointment_date = null;
                    formData.value.start_at = null;
                    formData.value.end_at = null;
                    errors.value = null;
                })
                .catch((makeDoctorAppointmentError) => {
                    isLoading.value = false;
                    isSaved.value = false;
                    errors.value = makeDoctorAppointmentError.response.data;
                });
            }
        }


		return {
            patients,
            formData,
            isLoading,
            isSaved,
            errors,
            makeDoctorAppointment,
            moment
		};
	},
};
</script>
