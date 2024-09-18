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
    professor: professor
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
                <p class="text-lg text-gray-600">Grade: {{ professor.grade }}</p>
            </div>

            <!-- Review Form Section -->
            <div class="space-y-4 bg-gray-50 p-6 rounded-lg shadow-inner">
                <h2 class="text-2xl font-semibold text-gray-700">Leave a Review</h2>

                <!-- Rating Section -->
                <div class="flex flex-col space-y-2">
                    <label for="rating" class="text-xl text-gray-600">Rating</label>
                    <input
                        v-model="form.rating"
                        type="range"
                        class="w-full h-2 bg-gray-300 rounded-lg appearance-none cursor-pointer focus:outline-none"
                        min="1"
                        max="5"
                        value="1"
                        step="1"
                    />
                    <!-- Custom Labels for Range -->
                    <ul class="flex justify-between w-full px-2 text-gray-500">
                        <li class="flex justify-center relative"><span class="absolute">1</span></li>
                        <li class="flex justify-center relative"><span class="absolute">2</span></li>
                        <li class="flex justify-center relative"><span class="absolute">3</span></li>
                        <li class="flex justify-center relative"><span class="absolute">4</span></li>
                        <li class="flex justify-center relative"><span class="absolute">5</span></li>
                    </ul>
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
                <p class="text-lg font-semibold">Rating: <span class="text-indigo-600">{{ comment.rating }}</span></p>
                <p class="text-gray-700">Comment: {{ comment.text }}</p>
            </div>
        </div>
    </div>

</template>

<style scoped>

</style>
