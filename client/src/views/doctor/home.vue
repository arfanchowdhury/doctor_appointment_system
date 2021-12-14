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
        <div class="mb-4">
            <router-link :to="{ name: 'doctor.appointment.create' }">
                <a class=" px-3 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purpl ">
                    Add an appointment
                </a>
		    </router-link>
        </div>
		<suspense>
			<template #default>
				<DoctorAppointmentTable></DoctorAppointmentTable>
			</template>
			<template #fallback>
				<DoctorAppointmentTableSkeleton />
			</template>
		</suspense>
	</div>
</template>

<script setup>
import UserCard from "../../components/usercard/UserCard.vue";
import UserCardSkeleton from "../../components/usercard/UserCardSkeleton.vue";
import DoctorAppointmentTable from "../../components/doctor/table/DoctorAppointmentTable.vue";
import DoctorAppointmentTableSkeleton from "../../components/doctor/table/DoctorAppointmentTableSkeleton.vue";
</script>
