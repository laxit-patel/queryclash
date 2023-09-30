<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';


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
                    <td class="px-6 py-4 whitespace-nowrap"><button class="btn">query</button></td>
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
