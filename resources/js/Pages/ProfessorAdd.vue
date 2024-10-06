<script setup>
import {useForm, usePage} from "@inertiajs/vue3";
import {computed} from "vue";

const props = defineProps({ status: Number })

const page = usePage()
const school = computed(() => page.props.school)
const professor = computed(() => page.props.professor)
const comments = computed(() => page.props.comments)
const errors = computed(() => page.props.errors)

const form = useForm({
    name: null,
    department: null,
    school_id: 1
});

function submit() {
    form.post('/professors');
}

const description = computed(() => {
    return {
        503: 'Sorry, we are doing some maintenance. Please check back soon.',
        500: 'Whoops, something went wrong on our servers.',
        404: 'Sorry, the page you are looking for could not be found.',
        403: 'Sorry, you are forbidden from accessing this page.',
    }[props.status]
})
</script>

<template>
    <div class="flex justify-center">
        <div class="flex flex-col mt-32 justify-center">
            <p class="font-bold text-3xl text-center">Профессор нэмэх</p>
            <form class="flex flex-col m-8 gap-4" @submit.prevent="submit">
                <input class="rounded-3xl p-3 text-xl" v-model="form.name" name="name" type="text" placeholder="Профессорын нэр">
                <input class="rounded-3xl p-3 text-xl" v-model="form.department" name="department" type="text"  placeholder="Профессорын тэнхим">
                <label v-if="errors" class="text-center text-red-500">{{ errors.department }}</label>
                <label v-if="errors" class="text-center text-red-500">{{ errors.name }}</label>
                <button class="border bg-black text-white rounded-2xl py-2 hover:text-white/70">Профессор нэмэх</button>
            </form>
        </div>
    </div>
</template>

<style scoped>

</style>
