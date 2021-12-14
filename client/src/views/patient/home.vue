<template>
	<div class="container px-6 mx-auto grid">
		<h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
			Dashboard
		</h2>
        <suspense>
			<template #default>
				<user-card></user-card>
			</template>
			<template #fallback>
				<user-card-skeleton />
			</template>
		</suspense>
        <h2 class="my-6 text-lg font-semibold text-gray-700 dark:text-gray-200">
			Appointments
		</h2>
		<suspense>
			<template #default>
				<PatientAppointmentTable></PatientAppointmentTable>
			</template>
			<template #fallback>
				<PatientAppointmentTableSkeleton />
			</template>
		</suspense>
	</div>
</template>

<script setup>
import UserCard from "../../components/usercard/UserCard.vue";
import UserCardSkeleton from "../../components/usercard/UserCardSkeleton.vue";
import PatientAppointmentTable from "../../components/patient/table/PatientAppointmentTable.vue";
import PatientAppointmentTableSkeleton from "../../components/patient/table/PatientAppointmentTableSkeleton.vue";

</script>
