<script setup>
import {Link, useForm, usePage} from '@inertiajs/vue3'
import {computed, ref} from "vue";

const page = usePage()
const school = computed(() => page.props.school)
const professor = computed(() => page.props.professor)
const comments = computed(() => page.props.comments)
const form = useForm({
    text: null,
    rating: null,
    professor: professor,
    difficulty: null,
    again: 0,
});

function submit() {
    form.post('comments');
}
</script>

<template>
    <div class="max-w-4xl mx-auto p-8 bg-white shadow-lg rounded-lg">
        <form @submit.prevent="submit" class="space-y-6">
            <!-- Professor Details Section -->
            <div class="space-y-2">
                <h1 class="text-4xl font-bold text-gray-800">{{ professor.name }}</h1>
                <p class="text-lg text-gray-600">Department: {{ professor.department }}</p>
                <p class="text-lg text-gray-600">Grade: {{ professor.grade }} / 5</p>
                <p class="text-lg text-gray-600">Difficulty: {{ professor.difficulty }} / 5</p>
            </div>

            <!-- Review Form Section -->
            <div class="space-y-4 bg-gray-50 p-6 rounded-lg shadow-inner">
                <h2 class="text-2xl font-semibold text-gray-700">Leave a Review</h2>

                <div class="flex items-center mb-4">
                    <input v-model="form.again" id="default-checkbox" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="default-checkbox" class="ms-2 text-sm font-medium">Would take again</label>
                </div>
                <!-- Rating Section -->
                <div class="grid grid-cols-2">
                    <form class="max-w-sm">
                        <label for="countries" class="block mb-2 text-md font-medium">Grade</label>
                        <select v-model="form.rating" id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="5">5</option>
                            <option value="4">4</option>
                            <option value="3">3</option>
                            <option value="2">2</option>
                            <option value="1">1</option>
                        </select>
                    </form>

                    <form class="max-w-sm">
                        <label for="countries" class="block mb-2 text-md font-medium">Difficulty</label>
                        <select v-model="form.difficulty" id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="5">5</option>
                            <option value="4">4</option>
                            <option value="3">3</option>
                            <option value="2">2</option>
                            <option value="1">1</option>
                        </select>
                    </form>
                </div>
                <!-- Comment Section -->
                <div class="flex flex-col space-y-2">
                    <label for="comment" class="text-xl text-gray-600">Comment</label>
                    <textarea
                        id="comment"
                        v-model="form.text"
                        class="w-full p-3 h-32 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="Write your review here..."
                    ></textarea>
                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    class="border bg-black text-white rounded-2xl py-2 hover:text-white/70 w-full"
                >
                    Submit Review
                </button>
            </div>
        </form>

        <!-- Reviews Section -->
        <div class="mt-10">
            <h2 class="text-3xl font-semibold text-gray-800 mb-4">Reviews</h2>
            <div v-for="comment in comments" class="space-y-3 mb-4 p-4 bg-gray-50 rounded-lg shadow">
                <p class="text-lg font-semibold">Grade: <span class="text-indigo-600">{{ comment.rating }}</span></p>
                <p class="text-lg font-semibold">Difficulty: <span class="text-indigo-600">{{ comment.difficulty }}</span></p>
                <p v-if="comment.again" class="text-lg font-semibold">Would take again: <span  class="text-indigo-600">Yes</span></p>
                <p v-else class="text-lg font-semibold">Would take again: <span  class="text-indigo-600">No</span></p>
                <p class="text-gray-700">Comment: {{ comment.text }}</p>
            </div>
        </div>
    </div>

</template>

<style scoped>

</style>
