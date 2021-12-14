<template>
	<div class="container px-6 mx-auto grid">
		<h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"> 
            Dashboard
		</h2>
		<suspense>
			<template #default>
				<admin-card></admin-card>
			</template>
			<template #fallback>
				<admin-card-skeleton />
			</template>
		</suspense>

        <div class="mb-4">
            <router-link :to="{ name: 'admin.doctor.create' }">
                <a class=" px-3 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purpl ">
                    Add Doctor
                </a>
		    </router-link>
        </div>
		
		<suspense>
			<template #default>
				<admin-doctor-table></admin-doctor-table>
			</template>
			<template #fallback>
				<admin-doctor-tableSkeleton />
			</template>
		</suspense>
		
        <br /> <hr /> <br />

		<suspense>
			<template #default>
				<admin-patient-table></admin-patient-table>
			</template>
			<template #fallback>
				<admin-patient-tableSkeleton />
			</template>
		</suspense>
	</div>
</template>

<script setup>
import AdminCard from "../../components/admin/card/AdminCard.vue";
import AdminCardSkeleton from "../../components/admin/card/AdminCardSkeleton.vue";
import AdminDoctorTable from "../../components/admin/table/AdminDoctorTable.vue";
import AdminDoctorTableSkeleton from "../../components/admin/table/AdminDoctorTableSkeleton.vue";
import AdminPatientTable from "../../components/admin/table/AdminPatientTable.vue";
import AdminPatientTableSkeleton from "../../components/admin/table/AdminPatientTableSkeleton.vue";
</script>
