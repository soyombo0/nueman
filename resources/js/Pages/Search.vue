<script setup>
import {Link, useForm} from "@inertiajs/vue3";

const form = useForm({
    name: null
});

function submit() {
    form.get('/professors')
}
</script>

<template>
    <form @submit.prevent="submit">
        <input v-model="form.name" name="professor" class="rounded-3xl border mt-6 mb-3 px-12 text-2xl" placeholder="Профессорын нэр">
    </form>
    <Link href="/professors/add" class="text-black/50 hover:text-black/70">Профессороо олсонгүй юу? Профессор нэмэх</Link>
</template>

<style scoped>

</style>
