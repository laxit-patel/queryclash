<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';


const props = defineProps({
    prompts: Object,
});
</script>

<template>

<Head title="Prompt" />

    <AuthenticatedLayout>
      <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Prompt</h2>
      </template>
  
      <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
              <h3 class="text-xl font-semibold mb-4">List Of Prompts</h3>
              
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prompt</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Level</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                    <!-- Add more table headers for additional columns if needed -->
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  <!-- Loop through your prompts data and create a table row for each prompt -->
                  <tr v-for="(prompt, index) in prompts.data" :key="prompt.id">
                    <td class="px-6 py-4 whitespace-nowrap">{{ prompt.id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ prompt.prompt }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ prompt.level }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ prompt.type }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <Link
                        type="button"
                        class="py-3 px-4 inline-flex justify-center items-center gap-2 rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm dark:bg-slate-900 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white dark:focus:ring-offset-gray-800"
                        :href="route('prompt.perform', { id: prompt.id })"
                        >
                        Query
                        <svg class="w-2.5 h-auto" width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M1 7C0.447715 7 -3.73832e-07 7.44771 -3.49691e-07 8C-3.2555e-07 8.55228 0.447715 9 1 9L13.0858 9L7.79289 14.2929C7.40237 14.6834 7.40237 15.3166 7.79289 15.7071C8.18342 16.0976 8.81658 16.0976 9.20711 15.7071L16.0303 8.88388C16.5185 8.39573 16.5185 7.60427 16.0303 7.11612L9.20711 0.292893C8.81658 -0.0976318 8.18342 -0.0976318 7.79289 0.292893C7.40237 0.683417 7.40237 1.31658 7.79289 1.70711L13.0858 7L1 7Z" fill="currentColor"/>
                        </svg>
                        </Link>
                    </td>
                    <!-- Add more table cells for additional columns if needed -->
                  </tr>
                </tbody>

              </table>
            </div>
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
  </template>
