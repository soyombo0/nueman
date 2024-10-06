<script setup>
import Search from "@/Pages/Search.vue";
import {computed, ref} from "vue";
import {usePage} from "@inertiajs/vue3";

const page = usePage()
let buttonClick = true;

</script>

<template>
<!--    <div v-if="message" class="absolute inset-0 flex items-center justify-center rounded-2xl border border-gray-400 bg-white text-3xl flex-col">-->
<!--        <p class="text-center">{{ message }}</p>-->
<!--        <button v-on:click="button" class="bg-black text-white p-2 px-12 rounded-3xl mt-32">Yes</button>-->
<!--    </div>-->
    <div class="text-black/50 text-center my-36">
        <p class="text-black font-bold text-6xl">Профессор, багшаа үнэлэцгээе</p>
        <p class="text-black font-bold text-3xl">Профессороо тэнхимээр нь олоорой</p>
        <Search></Search>
    </div>
</template>
