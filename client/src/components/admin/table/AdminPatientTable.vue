<template>
	<!-- New Table -->
	<div class="w-full overflow-hidden rounded-lg shadow-sm border">
		<div class="w-full overflow-x-auto">
			<table class="w-full whitespace-no-wrap">
				<thead>
					<tr class=" text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
						<th class="px-4 py-3">User(Patient)</th>
						<th class="px-4 py-3">Email</th>
						<th class="px-4 py-3">Phone no</th>
						<th class="px-4 py-3">Registerd At</th>
						<th class="px-4 py-3 flex items-center gap-1.5">
							Action
							<span v-if="isLoading" class="inline-block">
								<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 animate-spin" viewBox="0 0 20 20" fill="currentColor">
									<path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/>
								</svg>
							</span>
						</th>
					</tr>
				</thead>
				<tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
					<tr v-for="patient in patients" :key="patient.id" class="text-gray-700 dark:text-gray-400">
						<td class="px-4 py-3">
							<div class="flex items-center text-sm">
								<div>
									<p class="font-semibold">
										{{ patient.name ? patient.name : "N/A" }}
									</p>
									<p class="text-xs text-gray-600 dark:text-gray-400">
										patient
									</p>
								</div>
							</div>
						</td>
						<td class="px-4 py-3 text-sm">
							{{ patient.email ? patient.email : "N/A" }}
						</td>
						<td class="px-4 py-3 text-xs">
							{{ patient.phone_no ? patient.phone_no : "N/A" }}
						</td>
						<td class="px-4 py-3 text-xs">
							{{ moment(patient.created_at).fromNow() }}
						</td>
						<td class="px-4 py-3 text-xs">
                            <button type="submit" @click="makeAdmin(patient.id)" class="px-3 py-1 text-xs font-medium leading-5 text-purple-800 dark:text-purple-100 transition-colors duration-150 bg-transparent ring-2 ring-offset-1 dark:ring-offset-0 ring-purple-500 rounded-md active:bg-purple-500 hover:bg-purple-700 hover:text-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-400">
								Make him admin
							</button>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</template>
<script>
import PatientService from "../../../services/PatientService";
import AdminService from "../../../services/AdminService";
import { ref, computed } from "vue";
import moment from "moment";

export default {
	async setup() {
		const response = ref(await PatientService.getPatientForAdmin());
		const patients = computed(() => response.value.data.data);
		const isLoading = ref(false);

		function makeAdmin(id) {
			if (confirm("Are you sure?")) {
				const formData = {
					role_id: 1,
				};
				isLoading.value = true;
				AdminService.makeAdmin(id, formData)
					.then(() => {
						PatientService.getPatients().then((patientResponse) => {
							response.value = patientResponse;
							isLoading.value = false;
						});
					})
					.catch(() => alert("Something went wrong!!!"));
			}
		}

		return {
			patients,
			moment,
			makeAdmin,
			isLoading,
		};
	},
};
</script>
