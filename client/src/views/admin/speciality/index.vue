<template>
	<div class="container px-6 mx-auto grid">
		<h2
			class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
		>
			Specialities
		</h2>

        <div class="mb-4">
            <router-link :to="{ name: 'admin.specialities.create' }" >
                <a
                    class="
                        px-3
                        py-2
                        text-sm
                        font-medium
                        leading-5
                        text-white
                        transition-colors
                        duration-150
                        bg-purple-600
                        border border-transparent
                        rounded-lg
                        active:bg-purple-600
                        hover:bg-purple-700
                        focus:outline-none
                        focus:shadow-outline-purple
                    "
                >
                    Add Speciality
                </a>
            </router-link>
        </div>
		<suspense>
			<template #default>
				<SpecialitiesTable></SpecialitiesTable>
			</template>
			<template #fallback>
				<SpecialitiesTableSkeleton />
			</template>
		</suspense>
	</div>
</template>

<script setup>
import SpecialitiesTable from "../../../components/admin/speciality/SpecialitiesTable.vue";
import SpecialitiesTableSkeleton from "../../../components/admin/speciality/SpecialitiesTableSkeleton.vue";
</script>

<style></style>
