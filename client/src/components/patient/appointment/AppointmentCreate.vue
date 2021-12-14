<template>
	<div class="w-full overflow-hidden rounded-lg shadow-xs">
		<div class="w-full overflow-x-auto">
			<div class=" px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
				<form @submit.prevent="makePatientAppointment()" class="flex flex-col gap-4">
					<label class="block text-sm">
						<span class="text-gray-700 dark:text-gray-400">
							Select a doctor
						</span>
						<select v-model="formData.doctor_id" @change="getTimingSchedules()" required class="block rounded w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900 dark:focus:ring-purple-500">
                            <option value="null">--Select Doctor--</option>
                            <option v-for="doctor in doctors" :key="doctor.id" :value="doctor.id">
                                {{ doctor.name }} - Specialist in (
                                <div v-for="(speciality, index) in doctor.specialities" :key="speciality">
									<span>{{ speciality.name }}</span>
                                    <span v-if="index < doctor.specialities.length - 1">{{ ", " }}</span>
								</div>
                                )
                            </option>
                        </select>
					</label>
                    <label class="block text-sm" v-if="formData.doctor_id != null">
						<span class="text-gray-700 dark:text-gray-400">
							Select a date
						</span>
						<input type="date" v-model="formData.appointment_date" @change="getTimingSchedules()" required :min="moment().format('YYYY-MM-DD')" :max="moment().add(1, 'w').format('YYYY-MM-DD')" class="block rounded w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-input focus:border-purple-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900 dark:focus:ring-purple-500" />  
					</label>
                    <span v-if="isTimingScheduleLoading">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-500 animate-spin" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/>
                        </svg>
                    </span>
                    <label class="block text-sm text-center" v-if="formData.doctor_id != null && formData.appointment_date != null && isAppointmentAvailable == false">
						<div class="mt-4 animate-pulse">
                            Appointment is not available
                        </div>
                    </label>
					<label class="block text-sm" v-if="formData.doctor_id != null && formData.appointment_date != null && isAppointmentAvailable">
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
					</label>
					<div v-if="isSaved">
                        <span class="text-sm px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                            Appointment is successfully saved
                        </span>
                    </div>
				</form>
			</div>
		</div>
	</div>
</template>
<script>
import DoctorService from "../../../services/DoctorService";
import AppointmentService from "../../../services/AppointmentService";
import ScheduleService from "../../../services/ScheduleService";
import { ref, computed } from "vue";
import moment from 'moment';

export default {
	async setup() {
        const doctorsResponse = ref(await DoctorService.getDoctors());
		const doctors = computed(() => doctorsResponse.value.data.data);
        const isAppointmentAvailable = ref(null);
		const isTimingScheduleLoading = ref(false);
		const isLoading = ref(false);
		const isSaved = ref(false);
        const formData = ref({doctor_id: null, appointment_date: null});
        
        function getTimingSchedules()
        {
            if(formData.value.doctor_id !== null && formData.value.appointment_date !== null)
            {
                isSaved.value = false;
                isTimingScheduleLoading.value = true;
                
                ScheduleService.getTimingSchedules(formData.value.doctor_id, formData.value.appointment_date)
                .then((response) => {
                    isTimingScheduleLoading.value = false;
                    isAppointmentAvailable.value = response.data.status;
                    console.log(isAppointmentAvailable.value);
                })
                .catch((error) => {
                    isTimingScheduleLoading.value = false;
                    alert(error);
                })
            }
        }

        function makePatientAppointment() {
            if(formData.value.doctor_id !== null && formData.value.appointment_date !== null && isAppointmentAvailable)
            {
                isLoading.value = true;

                AppointmentService.makePatientAppointment(formData.value)
                .then((makePatientAppointmentResponse) => {
                    isLoading.value = false;
                    isSaved.value = makePatientAppointmentResponse.data.status;
                    formData.value.doctor_id = null;
                    formData.value.appointment_date = null;
                })
                .catch((error) => {
                    isLoading.value = false;
                    isSaved.value = false;
                    alert(error);
                });
            }
        }


		return {
            doctors,
            formData,
            isAppointmentAvailable,
            isTimingScheduleLoading,
            isLoading,
            isSaved,
            getTimingSchedules,
            makePatientAppointment,
            moment
		};
	},
};
</script>
