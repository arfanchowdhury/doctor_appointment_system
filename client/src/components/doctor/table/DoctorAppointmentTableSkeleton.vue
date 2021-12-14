<template>
	<div class="mb-4 w-full overflow-hidden rounded-lg shadow-sm border">
		<div class="w-full overflow-x-auto">
			<table class="w-full whitespace-no-wrap">
				<thead>
					<tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">Patient</th>
						<th class="px-4 py-3">Email / Phone</th>
						<th class="px-4 py-3">Date & Time</th>
						<th class="px-4 py-3">Status</th>
						<th class="px-4 py-3"> Action </th>
					</tr>
				</thead>
				<tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
					<tr v-for="i in 5" :key="i" class="text-gray-700 dark:text-gray-400">
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
								<div class="w-36 h-3 bg-gray-200 dark:bg-gray-500 animate-pulse"></div>
							</div>
						</td>
						<td class="px-4 py-3 text-xs">
							<div class="flex flex-col gap-1">
								<div class="w-24 h-3 bg-gray-200 dark:bg-gray-500 animate-pulse"></div>
							</div>
						</td>
                        <td class="px-4 py-3 text-xs">
							<div class="flex flex-col gap-1">
								<div class="w-24 h-3 bg-gray-200 dark:bg-gray-500 animate-pulse"></div>
							</div>
						</td>
                        <td class="px-4 py-3 text-xs">
							<div class="flex flex-col gap-1">
								<div class="w-24 h-3 bg-gray-200 dark:bg-gray-500 animate-pulse"></div>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</template>
