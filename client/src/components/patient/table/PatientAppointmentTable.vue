<template>
	<!-- New Table -->
	<div class="w-full overflow-hidden rounded-lg shadow-xs">
		<div class="w-full overflow-x-auto">
			<table class="w-full whitespace-no-wrap border dark:border-gray-200">
				<thead>
					<tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
						<th class="px-4 py-3">ID</th>
						<th class="px-4 py-3">Doctor's Details</th>
						<th class="px-4 py-3">Date & Time</th>
						<th class="px-4 py-3">Status</th>
						<th class="px-4 py-3">Completed at</th>
						<th class="px-4 py-3"></th>
					</tr>
				</thead>
				<tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800 text-left">
                    <tr
						class="text-gray-700 dark:text-gray-400"
						v-for="(appointment, index) in appointments"
						:key="appointment.id"
					>
						<td class="px-4 py-3">
							<p class="font-semibold text-sm">
                                #{{ appointment.id }}
                            </p>
						</td>
                        <td class="px-4 py-3">
							<div class="flex items-center text-xs">
								<div>
									<p class="text-gray-600 dark:text-gray-400">
										<strong>Name:</strong> {{ appointment.doctor_name }}
									</p>
									<p class="text-gray-600 dark:text-gray-400">
										<strong>Email:</strong> {{ appointment.doctor_email }}
									</p>
                                    <p class="text-gray-600 dark:text-gray-400">
										<strong>Phone:</strong> +88{{ appointment.doctor_phone_no }}
									</p>
                                    <p class="text-gray-600 dark:text-gray-400">
										<strong>Address:</strong> {{ appointment.doctor_address }}
									</p>
								</div>
							</div>
						</td>
                        <td class="px-4 py-3 text-xs">
                            {{ moment(appointment.appointment_date).format('DD-MMM-YYYY')  }}
                            ,
							{{ moment(appointment.start_at, "hh:mm:ss").format('hh:mm A') }} 
                            -
                            {{ moment(appointment.end_at, "hh:mm:ss").format('hh:mm A') }}
						</td>
                        <td class="px-4 py-3 text-xs">
                            <span v-if="appointment.is_pending" class="px-2 py-1 font-semibold leading-tight text-yellow-700 bg-yellow-100 rounded-full dark:text-white dark:bg-yellow-600">
                                Pending
                            </span>
                            <span v-else class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                Completed
                            </span>
						</td>
                        <td class="px-4 py-3 text-xs">
							{{appointment.checked_at ? moment(appointment.checked_at).format('DD-MMM-YYYY, hh:mm A') : 'N/A' }}
						</td>
                        <td class="px-4 py-3 text-xs">
							<button v-if="appointment.feedback == null" @click="openModel(index)" class="px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 active:bg-purple-500 active:text-white" aria-label="Edit">
                                Give feedback
                            </button>
                            <p v-else>Feedback provided</p>
						</td>
					</tr>
				</tbody>
			</table>
            <p v-if="appointments.length == 0" class="mt-4 text-gray-700 dark:text-gray-400 text-center">You have no appointments</p>
            <div v-show="isModalOpen" class=" fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center">
			    <div v-show="isModalOpen" class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl" role="dialog" id="modal">
                    <header class="flex justify-end">
                        <button class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-700" aria-label="close" @click="closeModal">
                            <svg
                                class="w-4 h-4"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                                role="img"
                                aria-hidden="true"
                            >
                                <path
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"
                                    fill-rule="evenodd"
                                ></path>
                            </svg>
                        </button>
                    </header>
                    <div class="mt-4 mb-6">
                        <p class="mb-6 text-lg font-semibold text-gray-700 dark:text-gray-300">
                            How was the experience?
                        </p>
                        <label class="block mt-4 text-sm">
                            <textarea v-model="formData.feedback  " class="block w-full mt-1 rounded text-sm border-gray-500 dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:ring-purple-500 dark:focus:ring-gray-500" rows="3" placeholder="Describe your experience" spellcheck="false"></textarea>
                        </label>
                    </div>
                    <footer class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800">
                        <button @click="closeModal" class="w-full px-5 py-3 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                            Cancel
                        </button>
                        <button @click="saveFeedback()" class="flex items-center justify-center gap-2 w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            Submit
                            <span v-if="isLoading">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 animate-spin" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/>
                                    </svg>
                                </span>
                        </button>
                    </footer>
			    </div>
		    </div>
        </div>
	</div>
</template>
<script> 
import AppointmentService from "../../../services/AppointmentService";
import { ref, computed } from "vue";
import moment from 'moment';

export default {
	async setup() {
		const response = ref(await AppointmentService.getAppointments());
		const appointments = computed(() => response.value.data.data);
		const isLoading = ref(false);
        const isModalOpen = ref(false);
        const formData = ref({id: null, feedback  : null});
        
        function openModel(index) {
			formData.value.id = appointments.value[index].id;
			isModalOpen.value = true;
		}
        function closeModal() {
            isModalOpen.value = false;
        }

        function saveFeedback()
        {
            isLoading.value = true;
            AppointmentService.saveFeedback(formData.value.id, formData.value)
            .then(() => {
                AppointmentService.getAppointments()
                .then((appointmentResponse) => {
                    response.value = appointmentResponse;
                    isLoading.value = false;
                    isModalOpen.value = false;
                })
                .catch((appointmentError) => alert(appointmentError));
            })
            .catch((saveFeedbackError) => alert(saveFeedbackError));

        }

		return {
			appointments,
            formData,
			isLoading,
            isModalOpen,
            openModel,
            closeModal,
            saveFeedback,
            moment
		};
	},
};
</script>
