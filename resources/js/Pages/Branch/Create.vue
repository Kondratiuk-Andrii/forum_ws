<script setup lang="ts">
    import { Head, useForm } from '@inertiajs/vue3';
    import axios from 'axios';
    import { ref } from 'vue';
    import Breadcrumbs from '@/Components/Breadcrumbs.vue';
    import InputError from '@/Components/InputError.vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

    const props = defineProps<{
        sections: { id: number; title: string }[];
    }>();

    const form = useForm({
        title: '',
        section_id: null,
        parent_id: null,
    });
    const breadcrumbs = ref([
        { label: 'Forum', url: route('sections.index') },
        { label: 'Create Branch' },
    ]);

    const branches = ref<{ id: number; title: string }[]>([]);

    const getBranches = () => {
        form.parent_id = null;
        axios.get(`/sections/${form.section_id}/branches`).then((res) => {
            branches.value = res.data;
        });
    };
</script>

<template>
    <Head title="Create Branch" />
    <authenticated-layout>
        <template #header>
            <Breadcrumbs :breadcrumbs="breadcrumbs" />
        </template>

        <!-- Page Heading -->
        <div class="mx-auto mt-4 flex max-w-2xl flex-col justify-center">
            <h1 class="text-center text-2xl font-bold text-gray-800">Creating a Branch</h1>

            <!-- Form of Creating a Section -->
            <form
                class="space-y-4 rounded-lg bg-white p-6 shadow-md"
                @submit.prevent="form.post(route('branches.store'))"
            >
                <div class="mb-4">
                    <input
                        class="focus:border-primary focus:ring-primary w-full rounded-lg border border-gray-300 p-3 focus:outline-none focus:ring-1"
                        v-model="form.title"
                        type="text"
                        placeholder="Title of Branch..."
                    />
                    <InputError class="mt-2" :message="form.errors.title" />
                </div>
                <div class="mb-4" v-if="props.sections.length > 0">
                    <select
                        class="focus:border-primary focus:ring-primary w-full rounded-lg border border-gray-300 p-3 focus:outline-none focus:ring-1"
                        v-model="form.section_id"
                        @change="getBranches"
                    >
                        <option value="null" disabled selected hidden>Select Section</option>
                        <option
                            v-for="section in props.sections"
                            :key="section.id"
                            :value="section.id"
                        >
                            {{ section.title }}
                        </option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.section_id" />
                </div>
                <div class="mb-4" v-if="branches.length > 0">
                    <select
                        class="focus:border-primary focus:ring-primary w-full rounded-lg border border-gray-300 p-3 focus:outline-none focus:ring-1"
                        v-model="form.parent_id"
                    >
                        <option value="null" disabled selected hidden>Select Branch</option>
                        <option v-for="branch in branches" :key="branch.id" :value="branch.id">
                            {{ branch.title }}
                        </option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.parent_id" />
                </div>
                <div class="flex justify-end">
                    <button
                        class="bg-primary hover:bg-primary-hover focus:ring-primary rounded-lg px-6 py-3 text-white shadow transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2"
                        type="submit"
                        :disabled="form.processing"
                    >
                        Create
                    </button>
                </div>
            </form>
        </div>
    </authenticated-layout>
</template>

<style scoped></style>
