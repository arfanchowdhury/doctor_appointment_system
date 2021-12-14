<template>
	<div class="w-full overflow-hidden rounded-lg shadow-xs">
		<div class="w-full overflow-x-auto">
            <label class="md:w-1/5 mb-4 ml-1 block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Timing Slot Duration
                </span>
                <div class="flex justify-center items-center gap-2">
                    <select class="block rounded w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900 dark:focus:ring-purple-500">  
                    </select>
                </div>
            </label>
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
						<th class="px-4 py-3">Day</th>
						<th class="px-4 py-3">Time</th>
						<th class="px-4 py-3">Break</th>
						<th class="px-4 py-3">Offday</th>
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
									<div class="w-16 h-3 bg-gray-200 dark:bg-gray-500 animate-pulse"></div>
								</div>
							</div>
						</td>
						<td class="px-4 py-3 text-sm">
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
								<div class="w-12 h-3 bg-gray-200 dark:bg-gray-500 animate-pulse"></div>
							</div>
						</td>
                        <td class="px-4 py-3 text-xs">
							<div class="flex flex-col gap-1">
								<div class="w-12 h-3 bg-gray-200 dark:bg-gray-500 animate-pulse"></div>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</template>
