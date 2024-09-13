<script setup>
import {useForm} from "@inertiajs/vue3";
import {Link} from "@inertiajs/vue3";
const form = useForm({
   professor: null
});

// form.get('/professor');

</script>

<template>
    <div class="text-black/50 text-center my-36">
        <p class="text-black font-bold text-7xl">Review your professor</p>
        <p class="text-black font-bold text-3xl">Find your professor by department</p>
        <form>
            <input v-model="form.professor" name="professor" class="rounded-3xl border mt-12 mb-3 px-12 text-2xl" placeholder="Professor name">
        </form>
        <Link href="/schools" class="hover:text-black/70">Didn't find your professor? Add one</Link>
    </div>
</template>
