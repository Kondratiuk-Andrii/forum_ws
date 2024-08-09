<script setup lang="ts">
    import { Head } from '@inertiajs/vue3';
    import { ref } from 'vue';
    import Breadcrumbs from '@/Components/Breadcrumbs.vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { IBranch, ISection } from '@/types';

    const props = defineProps<{
        branch: IBranch;
    }>();

    const breadcrumbs = ref([
        { label: 'Forum', url: route('sections.index') },
        { label: `${props.branch.title}` },
    ]);
</script>

<template>
    <Head :title="props.branch.title" />
    <authenticated-layout>
        <template #header>
            <Breadcrumbs :breadcrumbs="breadcrumbs" />
        </template>

        <!-- Page Heading -->

        <!-- <div class="mt-4 flex items-center justify-start gap-8 text-lg">
            <div class="font-bold">Actions:</div>
            <Link
                class="rounded-lg border bg-gray-50 px-4 py-2 transition hover:scale-105 hover:bg-gray-100"
                :href="route('sections.create')"
            >
                Create Section
            </Link>
            <Link
                class="rounded-lg border bg-gray-50 px-4 py-2 transition hover:scale-105 hover:bg-gray-100"
                :href="route('branches.create')"
            >
                Create Branch
            </Link>
        </div> -->
        <!-- Page Body -->
        <div class="mt-8 space-y-4 px-4"></div>
    </authenticated-layout>
</template>

<style scoped></style>
