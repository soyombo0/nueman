<script setup>
import { usePage } from '@inertiajs/vue3'

const page = usePage()

const schools = computed(() => page.props.schools)
</script>

<template>
    <div>
        <p class="text-black">{{ schools }}</p>
    </div>
</template>

<style scoped>

</style>
