<script setup>
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="m-4">
        <nav v-if="!$page.props.auth.user" class="text-black flex flex-1 justify-between">

            <Link class="flex gap-2" href="/">
                <box-icon name='book-alt' ></box-icon>
                <p>nueman</p>
            </Link>

            <Link
                v-if="$page.props.auth.user"
                :href="route('dashboard')"
                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/60 focus:outline-none"
            >
                Dashboard
            </Link>

            <template v-else>
                <div>
                    <Link
                        :href="route('login')"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/60 focus:outline-none "
                    >
                        Log in
                    </Link>

                    <Link
                        v-if="!$page.props.auth.user"
                        :href="route('register')"
                        class="rounded-md  px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/60 focus:outline-none "
                    >
                        Register
                    </Link>
                </div>
            </template>
        </nav>
    </div>
</template>

<style scoped>

</style>
