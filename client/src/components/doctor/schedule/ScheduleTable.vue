<template>
    <div>
        <div class="w-1/5 mb-4">
            <span class="text-gray-700 dark:text-gray-400">
                Timing Slot Duration
            </span>
            <div class="flex justify-center items-center gap-2">
                <select v-model="timeGap" @change="updateGap(timeGap)" :disabled="has_appointment" class="block rounded w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900 dark:focus:ring-purple-500">
                    <option value="">--Select duration--</option>
                    <option v-for="gap in gaps" :key="gap" :value="gap">{{ gap }}</option>
                </select>
                <span v-if="isTimeGapLoading">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 my-2 text-purple-500 animate-spin" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/>
                    </svg>
                </span>
            </div>
        </div>
	    <div class="mb-4 w-full overflow-hidden rounded-lg shadow-sm border">
		<div class="w-full overflow-x-auto">
			<table class="w-full whitespace-no-wrap">
				<thead>
					<tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
						<th class="px-4 py-3">Day</th>
						<th class="px-4 py-3">Time</th>
						<th class="px-4 py-3">Break</th>
						<th class="px-4 py-3">Offday</th>
						<th class="px-4 py-3" v-if="has_appointment == false">Action</th>
					</tr>
				</thead>
				<tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    <tr v-for="(schedule, index) in schedules" :key="schedule.id" class="text-gray-700 dark:text-gray-400">
						<td class="px-4 py-3">
							<div class="flex items-center text-sm">
								<div v-for="day in days" :key="day.id">
									<p class="font-semibold" v-if="day.id == schedule.day_id">
										{{ day.name }}
									</p>
								</div>
							</div>
						</td>
						<td class="px-4 py-3 text-sm">
							{{ moment(schedule.start_at, "hh:mm:ss").format('hh:mm A') }}
                            -
                            {{ moment(schedule.end_at, "hh:mm:ss").format('hh:mm A') }}
						</td>
                        <td class="px-4 py-3 text-sm">
                            <span v-if="schedule.break_start_at && schedule.break_end_at">
                                {{ moment(schedule.break_start_at, "hh:mm:ss").format('hh:mm A') }}
                                -
                                {{ moment(schedule.break_end_at, "hh:mm:ss").format('hh:mm A') }}
                            </span>
                            <span v-else class="px-2 py-1 text-xs font-semibold leading-tight text-gray-700 bg-gray-100 rounded-full dark:text-gray-100 dark:bg-gray-700">
                                No-Break
                            </span>
						</td>
                        <td class="px-4 py-3 text-xs">
                            <span v-if="schedule.is_offday" class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-white dark:bg-red-600">
                                Off-Day
                            </span>
                            <span v-else class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                Active
                            </span>
						</td>
						<td class="px-4 py-3 text-xs">
							<button v-if="has_appointment == false" @click="openModel(index)" class="px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 active:bg-purple-500 active:text-white" aria-label="Edit">
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                </svg>
                             </button>
						</td>
					</tr>
				</tbody>
			</table>
            <p v-if="has_appointment == true" class="mt-4 text-lg">Because of having pending appointments, you can not update schedule.</p>
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
                        <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">
                            Edit Schedule
                        </p>
                        <form @submit.prevent="updateSchedule()" class="flex flex-col gap-4">
                            <div class="flex flex-col md:flex-row md:justify-between gap-2">
                                <label class="w-full block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">
                                        From
                                    </span>
                                    <input type="time" v-model="formData.start_at" class="block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input rounded" />
                                </label>

                                <label class="w-full block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">
                                        To
                                    </span>
                                    <input type="time" v-model="formData.end_at" :min="formData.start_at" class="block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input rounded" />
                                </label>
                            </div>

                            <div class="flex flex-col md:flex-row md:justify-between gap-2">
                                <label class="w-full block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">
                                        Break From
                                    </span>
                                    <input type="time" v-model="formData.break_start_at" :min="formData.start_at" class="block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input rounded" />
                                </label>
                                <label class="w-full block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">
                                        Break To
                                    </span>
                                    <input type="time" v-model="formData.break_end_at" :min="formData.break_start_at" :max="formData.end_at" class="block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input rounded" />
                                </label>
                            </div>

                            <div class="flex flex-col md:flex-row md:justify-start gap-2">
                                <label class="flex items-center dark:text-gray-400">
                                    <input type="checkbox" v-model="formData.noBreak" @change="makeNoBreak()" class="text-purple-600 form-checkbox rounded focus:border-purple-400 focus:outline-none focus:ring-purple-500 dark:focus:shadow-outline-gray">
                                    <span class="ml-2">
                                        No Break
                                    </span>
                                </label>
                                
                                <label class="flex items-center dark:text-gray-400">
                                    <input type="checkbox" v-model="formData.is_offday" class="text-purple-600 form-checkbox rounded focus:border-purple-400 focus:outline-none focus:ring-purple-500 dark:focus:shadow-outline-gray">
                                    <span class="ml-2">
                                        Off Day
                                    </span>
                                </label>
                            </div>

                            <div class="mt-4">
                                <button class="flex items-center justify-center gap-1 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" :disabled="isLoading" type="submit">
                                    <span>Update Schedule</span>
                                    <span v-if="isLoading">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5 animate-spin"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                    </span>
                                </button>
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
		</div>
	    </div>
    </div>
</template>
<script> 
import { ref, computed } from "vue";
import moment from 'moment';
import ScheduleService from "../../../services/ScheduleService";
import DoctorService from "../../../services/DoctorService";

export default {
	async setup() {
		const response = ref(await ScheduleService.getSchedules());
		const schedules = computed(() =>  response.value.data.schedules);
		const days = computed(() =>  response.value.data.days);
        const gaps = ['10', '20','30', '40','50', '60'];
        const timeGap = ref(response.value.data.gap);
		const has_appointment = computed(() => response.value.data.has_appointment);
		const isLoading = ref(false);
		const isTimeGapLoading = ref(false);
        const successMessage = ref(false);
        const errors = ref(null);
        const formData = ref({
            id: null,
            start_at: null,
            end_at: null,
            break_start_at: null,
            break_end_at: null,
            is_offday: false,
            noBreak: false
        });
        


        function getDay(id){
            days.value.forEach((day) => {
                if(day.id == id)
                    console.log(day.name);
                    return day.name;
            })
        }


        const isModalOpen = ref(false);
        
        function openModel(index) {
            formData.value.id = schedules.value[index].id;
            formData.value.start_at = schedules.value[index].start_at;
            formData.value.end_at = schedules.value[index].end_at;
            formData.value.break_start_at = schedules.value[index].break_start_at;
            formData.value.break_end_at = schedules.value[index].break_end_at;
            formData.value.is_offday = schedules.value[index].is_offday ? true : false;

            isModalOpen.value = true;
        }

        function closeModal() {
            formData.value = {};
            isModalOpen.value = false;
        }


        function makeNoBreak()
        {
            if(formData.value.noBreak) {
                formData.value.break_start_at = "";
                formData.value.break_end_at = "";
            }
            else {
                formData.value.break_start_at = "14:00";
                formData.value.break_end_at = "15:00";
            }

        }

        async function updateSchedule() {
			isLoading.value = true;
			await ScheduleService.updateSchedule( formData.value.id, formData.value )
				.then(() => {
                    ScheduleService.getSchedules()
                    .then((getScheduleResponse) => {
                        response.value = getScheduleResponse;
                        isLoading.value = false;
                        closeModal();
                        successMessage.value = true;
                        errors.value = null;
                    })
                    .catch((getScheduleError) => {
                        errors.value = getScheduleError.response.data;
                        isLoading.value = false;
                        successMessage.value = false;
                    });
					
				})
				.catch((updateScheduleError) => {
                    errors.value = updateScheduleError.response.data;
                    isLoading.value = false;
                    successMessage.value = false;
				});
		}

        async function updateGap(value) {
            isTimeGapLoading.value = true;
            const form = {
                gap: value
            };
			await DoctorService.updateGap( form )
				.then(() => {
					isTimeGapLoading.value = false;
				})
				.catch((error) => {
					alert(error);
				});
        }

		return {
			schedules,
            gaps,
            timeGap,
            has_appointment,
            errors,
            formData,
            isModalOpen,
            isTimeGapLoading,
            openModel,
            closeModal,
            makeNoBreak,
            updateSchedule,
            updateGap,
			isLoading,
            successMessage,
            getDay,
            days,
            moment
		};
	},
};
</script>
