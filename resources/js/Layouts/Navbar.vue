<script setup>
import { Head, Link } from '@inertiajs/vue3';
import DropdownLink from "@/Components/DropdownLink.vue";
import Dropdown from "@/Components/Dropdown.vue";
</script>

<template>
    <div class="m-4">
        <nav class="text-black flex flex-1 justify-between">
            <div class="flex gap-3">
                <Link class="flex gap-2" href="/">
                    <box-icon name='book-alt' ></box-icon>
                    <p>bichig</p>
                </Link>
                <p>|</p>
                <Link href="/professors" class="hover:text-black/60">professors</Link>
                <p>|</p>
                <Link href="/contacts" class="hover:text-black/60">contacts</Link>
                <!--                <Link href="/schools" class="hover:text-black/60">schools</Link>-->
            </div>
            <div v-if="$page.props.auth.user">
                <Dropdown align="right" width="48">
                    <template #trigger>
                    <span class="inline-flex rounded-md">
                        <button
                            type="button"
                            class="inline-flex items-center px-3 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                        >
                            {{ $page.props.auth.user.name }}

                            <svg
                                class="ms-2 -me-0.5 h-4 w-4"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </button>
                    </span>
                    </template>

                    <template #content>
                        <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                        <DropdownLink :href="route('logout')" method="post" as="button">
                            Log Out
                        </DropdownLink>
                    </template>
                </Dropdown>
            </div>

            <div v-else>

                <Link
                    :href="route('login')"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/60 focus:outline-none "
                >
                    log in
                </Link>

                <Link
                    v-if="!$page.props.auth.user"
                    :href="route('register')"
                    class="rounded-md  px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/60 focus:outline-none "
                >
                    register
                </Link>
            </div>
        </nav>
    </div>
</template>

<style scoped>

</style>
