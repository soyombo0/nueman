<script setup>
import {Link, usePage} from '@inertiajs/vue3'
import {computed} from "vue";
import Search from "@/Pages/Search.vue";

const page = usePage()
const professors = computed(() => page.props.professors)
</script>

<template >
    <div v-if="professors[0]" class="text-center">
        <p class="text-center text-6xl font-bold">Профессорууд</p>
        <Search></Search>
        <div class="flex mt-12 justify-center">
            <table class="text-xl">
                <tr class="">
                    <th>Профессох</th>
                    <th>Тэнхим</th>
                </tr>
                <tr v-for="professor in professors" class="text-center">
                    <td>
                        <Link :href="`/professor/${professor.id}`" class="text-black font-medium hover:text-black/60">
                            {{ professor.name }}
                        </Link>
                    </td>
                    <td>
                        {{ professor.department }}
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div v-else class="text-center mt-32">
        <p class="text-center text-6xl font-bold ">No professor was found</p>
        <Search></Search>
    </div>
</template>

<style scoped>

</style>
