<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    prompt: Object,
});

const queryText = ref(''); // To store the user-entered query text
const testResult = ref(null); // To store the test result

const testQuery = async () => {
    // Perform an HTTP POST request to the Laravel route for testing queries
    try {
        const response = await axios.post(`/prompt/${props.prompt.id}/execute`, {
            query: queryText.value,
        });

        testResult.value = response.data; // Store the test result
    } catch (error) {
        console.error('Error testing query:', error);
    }
};
</script>

<template>
    <Head title="Prompt" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Perform</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-xl font-semibold mb-4">{{ prompt.prompt }}</h3>

                        <label for="input-label-with-helper-text" class="block text-sm font-medium mb-2 text-gray-600">Write Your Query</label>
                        <textarea v-model="queryText" class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400" rows="3" placeholder="This is a textarea placeholder"></textarea>
                        <p class="text-sm text-gray-500 mt-2" id="hs-input-helper-text">Here's a Clover for good luck 🍀</p>

                        <div class="inline-flex rounded-md shadow-sm mt-5">
                            <button @click="testQuery" type="button" class="py-3 px-4 inline-flex justify-center items-center gap-2 -ml-px first:rounded-l-lg first:ml-0 last:rounded-r-lg border font-medium bg-white text-gray-700 align-middle hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-2 focus:ring-blue-600 transition-all text-sm dark:bg-gray-800 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400">
                                Test 🚀
                            </button>
                            <button type="button" class="py-3 px-4 inline-flex justify-center items-center gap-2 -ml-px first:rounded-l-lg first:ml-0 last:rounded-r-lg border font-medium bg-white text-gray-700 align-middle hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-2 focus:ring-blue-600 transition-all text-sm dark:bg-gray-800 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400">
                                Save 📂
                            </button>
                        </div>

                        <!-- Display test result -->
                        <div v-if="testResult !== null" class="mt-5">
                            <h4 class="text-lg font-semibold mb-2">Test Result</h4>
                            <pre class="text-sm text-gray-600">{{ testResult }}</pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
