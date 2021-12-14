<template>
	<div class="container px-6 mx-auto grid">
		<h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
			Make an appointment
		</h2>
		<suspense>
			<template #default>
				<doctor-appointment-create></doctor-appointment-create>
			</template>
			<template #fallback>
				<doctor-appointment-create-skeleton />
			</template>
		</suspense>
	</div>
</template>

<script setup>
import DoctorAppointmentCreate from "../../components/doctor/appointment/AppointmentCreate.vue";
import DoctorAppointmentCreateSkeleton from "../../components/doctor/appointment/AppointmentCreateSkeleton.vue";
</script>
