<template>
    <aside class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0">
        <div class="py-4 text-gray-500 dark:text-gray-400">
            <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#">
                5MG
            </a>
            <ul class="mt-6">
                <li v-if="roleId == 1" class="relative px-6 py-3 font-semibold">
                    <router-link :to="{ name: 'admin.home' }" exact-active-class="font-bold text-purple-700 dark:text-gray-100">
                        <a class="inline-flex items-center w-full text-sm  transition-colors duration-150 hover:text-purple-700 dark:hover:text-gray-200">
                            <svg
                                class="w-5 h-5"
                                aria-hidden="true"
                                fill="none"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                                ></path>
                            </svg>
                            <span class="ml-4">Dashboard</span>
                        </a>
                    </router-link>
                </li>
                <li v-if="roleId == 1" class="relative px-6 py-3 font-semibold">
                    <router-link :to="{ name: 'admin.specialities'}" exact-active-class="font-bold text-purple-700 dark:text-gray-100">
                        <a class="inline-flex items-center w-full text-sm  transition-colors duration-150 hover:text-purple-700 dark:hover:text-gray-200">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
                                />
                            </svg>
                            <span class="ml-4">Speciality</span>
                        </a>
                    </router-link>
                </li>

                <li v-if="roleId == 2" class="relative px-6 py-3 font-semibold">
                    <router-link :to="{ name: 'doctor.home' }" exact-active-class="font-bold text-purple-700 dark:text-gray-100">
                        <a class="inline-flex items-center w-full text-sm transition-colors duration-150 hover:text-purple-700 dark:hover:text-gray-200">
                            <svg
                                class="w-5 h-5"
                                aria-hidden="true"
                                fill="none"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                                ></path>
                            </svg>
                            <span class="ml-4">Dashboard</span>
                        </a>
                    </router-link>
                </li>
                <li v-if="roleId == 2" class="relative px-6 py-3 font-semibold">
                    <router-link :to="{ name: 'doctor.schedule' }" exact-active-class="font-bold text-purple-700 dark:text-gray-100">
                        <a class="inline-flex items-center w-full text-sm transition-colors duration-150 hover:text-purple-700 dark:hover:text-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="ml-4">Schedule</span>
                        </a>
                    </router-link>
                </li>

                <li v-if="roleId == 3" class="relative px-6 py-3 font-semibold">
                    <router-link :to="{ name: 'patient.home' }" exact-active-class="font-bold text-purple-700 dark:text-purple-400">
                        <a class="inline-flex items-center w-full text-sm transition-colors duration-150 hover:text-purple-700 dark:hover:text-gray-200">
                            <svg
                                class="w-5 h-5"
                                aria-hidden="true"
                                fill="none"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                                ></path>
                            </svg>
                            <span class="ml-4">Dashboard</span>
                        </a>
                    </router-link>
                </li>
                <li v-if="roleId == 3" class="relative px-6 py-3 font-semibold">
                    <router-link :to="{ name: 'patient.appointment.create' }" exact-active-class="font-bold text-purple-700 dark:text-gray-100">
                        <a class="inline-flex items-center w-full text-sm transition-colors duration-150 hover:text-purple-700 dark:hover:text-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="ml-4">Make an appointment</span>
                        </a>
                    </router-link>
                </li>
                <li v-if="roleId == 3" class="relative px-6 py-3 font-semibold">
                    <router-link :to="{ name: 'patient.ambulance' }" exact-active-class="font-bold text-purple-700 dark:text-gray-100">
                        <a class="inline-flex items-center w-full text-sm transition-colors duration-150 hover:text-purple-700 dark:hover:text-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                            </svg>
                            <span class="ml-4">Ambulance</span>
                        </a>
                    </router-link>
                </li>
                <li v-if="roleId == 3" class="relative px-6 py-3 font-semibold">
                    <router-link :to="{ name: 'patient.hospital' }" exact-active-class="font-bold text-purple-700 dark:text-gray-100">
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-purple-700 dark:hover:text-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            <span class="ml-4">Hospital</span>
                        </a>
                    </router-link>
                </li>
                <li v-if="roleId == 3" class="relative px-6 py-3 font-semibold">
                    <router-link :to="{ name: 'patient.blood' }" exact-active-class="font-bold text-purple-700 dark:text-gray-100">
                        <a class="inline-flex items-center w-full text-sm font-semibold  transition-colors duration-150 hover:text-purple-700 dark:hover:text-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                            </svg>
                            <span class="ml-4">Blood Donation</span>
                        </a>
                    </router-link>
                </li>
                <li v-if="roleId == 3" class="relative px-6 py-3 font-semibold">
                    <router-link :to="{ name: 'patient.medicine' }" exact-active-class="font-bold text-purple-700 dark:text-gray-100">
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-purple-700 dark:hover:text-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                            <span class="ml-4">Medicine</span>
                        </a>
                    </router-link>
                </li>
                <li v-if="roleId == 3" class="relative px-6 py-3 font-semibold">
                    <router-link :to="{ name: 'patient.covid' }" exact-active-class="font-bold text-purple-700 dark:text-gray-100">
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-purple-700 dark:hover:text-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span class="ml-4">Covid note</span>
                        </a>
                    </router-link>
                </li>
            </ul>
        </div>
        <div class="ml-6 text-sm dark:text-gray-50">
            <span class=" px-2 py-1 font-semibold leading-tight text-gray-700 bg-gray-100 rounded-full dark:text-gray-100 dark:bg-gray-700">
                {{ roles[roleId - 1] }}
            </span>
        </div>
    </aside>
    <div v-show="isSidebarOpen" class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center" style="display: none;"></div>
    <aside v-show="isSidebarOpen" ref="sidebar" class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-white dark:bg-gray-800 md:hidden" style="display: none;">
        <div class="py-4 text-gray-500 dark:text-gray-400">
            <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#">
                5MG
            </a>
            <ul class="mt-6" @click="closeSidebar()">
                <li v-if="roleId == 1" class="relative px-6 py-3 font-semibold">
                    <router-link :to="{ name: 'admin.home' }" exact-active-class="font-bold text-purple-700 dark:text-gray-100">
                        <a class="inline-flex items-center w-full text-sm  transition-colors duration-150 hover:text-purple-700 dark:hover:text-gray-200">
                            <svg
                                class="w-5 h-5"
                                aria-hidden="true"
                                fill="none"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                                ></path>
                            </svg>
                            <span class="ml-4">Dashboard</span>
                        </a>
                    </router-link>
                </li>
                <li v-if="roleId == 1" class="relative px-6 py-3 font-semibold">
                    <router-link :to="{ name: 'admin.specialities'}" exact-active-class="font-bold text-purple-700 dark:text-gray-100">
                        <a class="inline-flex items-center w-full text-sm  transition-colors duration-150 hover:text-purple-700 dark:hover:text-gray-200">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
                                />
                            </svg>
                            <span class="ml-4">Speciality</span>
                        </a>
                    </router-link>
                </li>

                <li v-if="roleId == 2" class="relative px-6 py-3 font-semibold">
                    <router-link :to="{ name: 'doctor.home' }" exact-active-class="font-bold text-purple-700 dark:text-gray-100">
                        <a class="inline-flex items-center w-full text-sm transition-colors duration-150 hover:text-purple-700 dark:hover:text-gray-200">
                            <svg
                                class="w-5 h-5"
                                aria-hidden="true"
                                fill="none"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                                ></path>
                            </svg>
                            <span class="ml-4">Dashboard</span>
                        </a>
                    </router-link>
                </li>
                <li v-if="roleId == 2" class="relative px-6 py-3 font-semibold">
                    <router-link :to="{ name: 'doctor.schedule' }" exact-active-class="font-bold text-purple-700 dark:text-gray-100">
                        <a class="inline-flex items-center w-full text-sm transition-colors duration-150 hover:text-purple-700 dark:hover:text-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="ml-4">Schedule</span>
                        </a>
                    </router-link>
                </li>

                <li v-if="roleId == 3" class="relative px-6 py-3 font-semibold">
                    <router-link :to="{ name: 'patient.home' }" exact-active-class="font-bold text-purple-700 dark:text-gray-100">
                        <a class="inline-flex items-center w-full text-sm transition-colors duration-150 hover:text-purple-700 dark:hover:text-gray-200">
                            <svg
                                class="w-5 h-5"
                                aria-hidden="true"
                                fill="none"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                                ></path>
                            </svg>
                            <span class="ml-4">Dashboard</span>
                        </a>
                    </router-link>
                </li>
                <li v-if="roleId == 3" class="relative px-6 py-3 font-semibold">
                    <router-link :to="{ name: 'patient.appointment.create' }" exact-active-class="font-bold text-purple-700 dark:text-gray-100">
                        <a class="inline-flex items-center w-full text-sm transition-colors duration-150 hover:text-purple-700 dark:hover:text-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="ml-4">Make an appointment</span>
                        </a>
                    </router-link>
                </li>
                <li v-if="roleId == 3" class="relative px-6 py-3 font-semibold">
                    <router-link :to="{ name: 'patient.ambulance' }" exact-active-class="font-bold text-purple-700 dark:text-gray-100">
                        <a class="inline-flex items-center w-full text-sm transition-colors duration-150 hover:text-purple-700 dark:hover:text-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                            </svg>
                            <span class="ml-4">Ambulance</span>
                        </a>
                    </router-link>
                </li>
                <li v-if="roleId == 3" class="relative px-6 py-3 font-semibold">
                    <router-link :to="{ name: 'patient.hospital' }" exact-active-class="font-bold text-purple-700 dark:text-gray-100">
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-purple-700 dark:hover:text-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            <span class="ml-4">Hospital</span>
                        </a>
                    </router-link>
                </li>
                <li v-if="roleId == 3" class="relative px-6 py-3 font-semibold">
                    <router-link :to="{ name: 'patient.blood' }" exact-active-class="font-bold text-purple-700 dark:text-gray-100">
                        <a class="inline-flex items-center w-full text-sm font-semibold  transition-colors duration-150 hover:text-purple-700 dark:hover:text-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                            </svg>
                            <span class="ml-4">Blood Donation</span>
                        </a>
                    </router-link>
                </li>
                <li v-if="roleId == 3" class="relative px-6 py-3 font-semibold">
                    <router-link :to="{ name: 'patient.medicine' }" exact-active-class="font-bold text-purple-700 dark:text-gray-100">
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-purple-700 dark:hover:text-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                            <span class="ml-4">Medicine</span>
                        </a>
                    </router-link>
                </li>
                <li v-if="roleId == 3" class="relative px-6 py-3 font-semibold">
                    <router-link :to="{ name: 'patient.covid' }" exact-active-class="font-bold text-purple-700 dark:text-gray-100">
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-purple-700 dark:hover:text-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span class="ml-4">Covid note</span>
                        </a>
                    </router-link>
                </li>
            </ul>
        </div>
        <div class="ml-6 text-sm dark:text-gray-50">
            <span class=" px-2 py-1 font-semibold leading-tight text-gray-700 bg-gray-100 rounded-full dark:text-gray-100 dark:bg-gray-700">
                {{ roles[roleId - 1] }}
            </span>
        </div>
    </aside>
</template>
<script setup>
import { ref, computed } from "vue";
import { useStore } from "vuex";
import { onClickOutside } from "@vueuse/core";

const roles = ["Administrator", "Doctor", "Patient"];
const store = useStore();
const roleId = computed(() => store.state.currentUser ? store.state.currentUser.role_id : 0);
const sidebar = ref(null);
const isSidebarOpen = computed(() => store.getters.getSidebarState);

onClickOutside(sidebar, (event) => {
	store.dispatch("closeSidebar");
});

function closeSidebar() {
    store.dispatch("closeSidebar");
}
</script>
