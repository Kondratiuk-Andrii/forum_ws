<script setup lang="ts">
    import { Head } from '@inertiajs/vue3';
    import { Link } from '@inertiajs/vue3';
    import Swal from 'sweetalert2';
    import { watchEffect } from 'vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { IFlash, ISection } from '@/types';

    const props = defineProps<{
        sections: ISection[];
        flash: IFlash;
    }>();

    watchEffect(() => {
        if (props.flash.message) {
            Swal.fire({
                title: props.flash.message.title,
                icon: props.flash.message.icon,
                toast: true,
                timer: 2500,
                position: 'top',
                timerProgressBar: true,
                showConfirmButton: false,
            });
        }
    });
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
                    <h2 class="mb-4 flex items-center gap-2 text-2xl font-bold">
                        {{ section.title }}
                        <Link :href="route('sections.edit', section.id)">
                            <v-icon
                                class="h-6 text-secondary hover:scale-105 hover:cursor-pointer hover:text-secondary-hover"
                                name="md-edit"
                            />
                        </Link>
                        <Link
                            :href="route('sections.destroy', section.id)"
                            method="delete"
                            as="button"
                        >
                            <v-icon
                                class="h-6 text-danger hover:scale-105 hover:cursor-pointer hover:text-danger-hover"
                                name="md-delete"
                            />
                        </Link>
                    </h2>
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
