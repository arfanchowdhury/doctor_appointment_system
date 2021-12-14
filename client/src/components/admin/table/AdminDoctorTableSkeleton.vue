<template>
	<!-- New Table -->
	<div class="w-full overflow-hidden rounded-lg shadow-xs">
		<div class="w-full overflow-x-auto">
			<table class="w-full whitespace-no-wrap">
				<thead>
					<tr
						class="
							text-xs
							font-semibold
							tracking-wide
							text-left text-gray-500
							uppercase
							border-b
							dark:border-gray-700
							bg-gray-50
							dark:text-gray-400
							dark:bg-gray-800
						"
					>
						<th class="px-4 py-3">User(Doctor)</th>
						<th class="px-4 py-3">Email</th>
						<th class="px-4 py-3">Phone no</th>
						<th class="px-4 py-3">Specialities</th>
						<th class="px-4 py-3">Action</th>
					</tr>
				</thead>
				<tbody
					class="
						bg-white
						divide-y
						dark:divide-gray-700
						dark:bg-gray-800
					"
				>
					<tr
						class="text-gray-700 dark:text-gray-400"
						v-for="i in 5"
						:key="i"
					>
						<td class="px-4 py-3">
							<div class="flex items-center text-sm">
								<div class="flex flex-col gap-1">
									<div class="w-20 h-3 bg-gray-200 dark:bg-gray-500 animate-pulse"></div>
									<div class="w-16 h-2 bg-gray-100 dark:bg-gray-600"></div>
								</div>
							</div>
						</td>
						<td class="px-4 py-3 text-sm">
							<div class="flex flex-col gap-1">
								<div class="w-28 h-3 bg-gray-200 dark:bg-gray-500 animate-pulse"></div>
							</div>
						</td>
						<td class="px-4 py-3 text-xs">
							<div class="flex flex-col gap-1">
								<div class="w-24 h-3 bg-gray-200 dark:bg-gray-500 animate-pulse"></div>
							</div>
						</td>
                        <td class="px-4 py-3 text-xs">
							<div class="w-40 grid grid-cols-3">
								<div class="w-12 h-5 px-2 py-1 font-semibold leading-tight text-gray-700 bg-gray-100 rounded-full dark:text-gray-100 dark:bg-gray-700"></div>
								<div class="w-12 h-5 px-2 py-1 font-semibold leading-tight text-gray-700 bg-gray-100 rounded-full dark:text-gray-100 dark:bg-gray-700"></div>
								<div class="w-12 h-5 px-2 py-1 font-semibold leading-tight text-gray-700 bg-gray-100 rounded-full dark:text-gray-100 dark:bg-gray-700"></div>
							</div>
						</td>
                        <td class="px-4 py-3 text-xs">
							<div class="flex flex-col gap-1">
								<div class="w-24 h-7 rounded bg-gray-200 dark:bg-gray-500 animate-pulse"></div>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</template>
