<template>
	<div class="container px-6 mx-auto grid">
		<h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
			Make an appointment
		</h2>
		<suspense>
			<template #default>
				<PatientAppointmentTable></PatientAppointmentTable>
			</template>
			<template #fallback>
				<AppointmentCreateSkeleton />
			</template>
		</suspense>
	</div>
</template>

<script setup>
import PatientAppointmentTable from "../../components/patient/appointment/AppointmentCreate.vue";
import AppointmentCreateSkeleton from "../../components/patient/appointment/AppointmentCreateSkeleton.vue";
</script>
