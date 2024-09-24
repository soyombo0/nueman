<script setup>
import {useForm, usePage} from "@inertiajs/vue3";
import {computed} from "vue";

const page = usePage()
const school = computed(() => page.props.school)
const professor = computed(() => page.props.professor)
const comments = computed(() => page.props.comments)
const form = useForm({
    name: null,
    department: null,
    school_id: 1
});

function submit() {
    form.post('/professors');
}
</script>

<template>
    <div class="flex justify-center">
        <div class="flex flex-col mt-32 justify-center">
            <p class="font-bold text-3xl">Add professor that you want to rate</p>
            <form class="flex flex-col m-12 gap-4" @submit.prevent="submit">
                <input v-model="form.name" name="name" type="text" class="rounded-3xl" placeholder="professor's name">
                <input v-model="form.department" name="department" type="text" class="rounded-3xl" placeholder="professor's department">
                <button class="border bg-black text-white rounded-2xl py-2 hover:text-white/70">Add professor</button>
            </form>
        </div>
    </div>
</template>

<style scoped>

</style>
