<script setup lang="ts">
    import { Head } from '@inertiajs/vue3';
    import { Link } from '@inertiajs/vue3';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { ISection } from '@/types';

    const props = defineProps<{
        sections: ISection[];
    }>();
</script>

<template>
    <Head title="Forum" />
    <authenticated-layout>
        <template #header>Forum</template>

        <!-- Page Heading -->

        <div class="mt-4 flex items-center justify-start gap-8 text-lg">
            <div class="font-bold">Actions:</div>
            <Link
                class="rounded-lg border bg-gray-50 px-4 py-2 transition hover:scale-105 hover:bg-gray-100"
                :href="route('sections.create')"
            >
                Add Section
            </Link>
            <Link
                class="rounded-lg border bg-gray-50 px-4 py-2 transition hover:scale-105 hover:bg-gray-100"
                :href="route('branches.create')"
            >
                Add Branch
            </Link>
        </div>
        <!-- Page Body -->
        <div class="mt-8 space-y-4 px-4" v-if="props.sections">
            <div v-for="section in props.sections" :key="section.id">
                <div v-if="section.branches && section.branches.length > 0">
                    <h2 class="mb-4 text-2xl font-bold">{{ section.title }}</h2>
                </div>
                <div class="space-y-4">
                    <div v-for="branch in section.branches" :key="branch.id">
                        <Link
                            class="block rounded-xl bg-gray-50 px-6 py-4 text-xl shadow-md transition hover:-translate-y-2 hover:cursor-pointer hover:bg-gray-100 hover:shadow-lg"
                            :href="route('branches.show', branch.id)"
                        >
                            {{ branch.title }}
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </authenticated-layout>
</template>

<style scoped></style>
