<template>
	<div class="container px-6 mx-auto grid">
		<h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
			Schedule
		</h2>

		<suspense>
			<template #default>
				<DoctorScheduleTable></DoctorScheduleTable>
			</template>
			<template #fallback>
				<DoctorScheduleTableSkeleton />
			</template>
		</suspense>
	</div>
</template>

<script setup>
import DoctorScheduleTable from "../../components/doctor/schedule/ScheduleTable.vue";
import DoctorScheduleTableSkeleton from "../../components/doctor/schedule/ScheduleTableSkeleton.vue";
</script>
