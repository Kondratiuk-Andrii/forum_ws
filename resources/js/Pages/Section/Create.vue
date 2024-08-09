<script setup lang="ts">
    import { Head, useForm } from '@inertiajs/vue3';
    import { ref } from 'vue';
    import Breadcrumbs from '@/Components/Breadcrumbs.vue';
    import InputError from '@/Components/InputError.vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

    const form = useForm({
        title: '',
    });
    const breadcrumbs = ref([
        { label: 'Forum', url: route('sections.index') },
        { label: 'Create Section' },
    ]);
</script>

<template>
    <Head title="Create Section" />
    <authenticated-layout>
        <template #header>
            <Breadcrumbs :breadcrumbs="breadcrumbs" />
        </template>

        <!-- Page Heading -->
        <div class="mx-auto mt-4 flex max-w-2xl flex-col justify-center">
            <h1 class="text-center text-2xl font-bold text-gray-800">Creating a Forum Section</h1>

            <!-- Form of Creating a Section -->
            <form
                class="space-y-4 rounded-lg bg-white p-6 shadow-md"
                @submit.prevent="form.post(route('sections.store'))"
            >
                <div>
                    <input
                        class="focus:border-primary focus:ring-primary w-full rounded-lg border border-gray-300 p-3 focus:outline-none focus:ring-1"
                        v-model="form.title"
                        type="text"
                        placeholder="Title of Section..."
                    />
                    <InputError class="0 mt-2" :message="form.errors.title" />
                </div>
                <div class="flex justify-end">
                    <button
                        class="bg-primary hover:bg-primary-hover focus:ring-primary rounded-lg px-6 py-3 text-white shadow transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2"
                        type="submit"
                    >
                        Create
                    </button>
                </div>
            </form>
        </div>
    </authenticated-layout>
</template>

<style scoped></style>
