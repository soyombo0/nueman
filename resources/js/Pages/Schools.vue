<script setup>
import {Link, usePage} from '@inertiajs/vue3'
import {computed} from "vue";

const page = usePage()
const schools = computed(() => page.props.schools)
</script>

<template>
    <p class="text-center text-6xl font-bold">Schools</p>
    <p class="text-center text-black/60 text-3xl">Choose from available schools or your own</p>
    <div class="flex justify-center">
        <div class="flex flex-col columns-1 m-2" v-for="school in schools">
            <Link :href="`/professors?school_id=${school.id}`" class="text-black hover:text-black/60 font-medium">
                {{ school.name }}
            </Link>
        </div>
    </div>
</template>

<style scoped>

</style>
