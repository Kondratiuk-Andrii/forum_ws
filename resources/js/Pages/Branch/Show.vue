<script setup lang="ts">
    import { Head } from '@inertiajs/vue3';
    import { Link } from '@inertiajs/vue3';
    import Swal from 'sweetalert2';
    import { ref, watchEffect } from 'vue';
    import Breadcrumbs from '@/Components/Breadcrumbs.vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { IBranch, IFlash } from '@/types';

    const props = defineProps<{
        branch: IBranch;
        flash: IFlash;
    }>();

    const breadcrumbs = ref(
        props.branch.parent_id
            ? [
                  { label: 'Forum', url: route('sections.index') },
                  { label: `${props.branch.section_title}` },
                  {
                      label: `${props.branch.parent_title}`,
                      url: route('branches.show', props.branch.parent_id),
                  },
                  { label: `${props.branch.title}` },
              ]
            : [
                  { label: 'Forum', url: route('sections.index') },
                  { label: `${props.branch.section_title}` },
                  { label: `${props.branch.title}` },
              ]
    );

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
    <Head :title="props.branch.title" />
    <authenticated-layout>
        <template #header>
            <Breadcrumbs :breadcrumbs="breadcrumbs" />
        </template>

        <!-- Page Heading -->

        <div class="mt-4 flex items-center justify-start gap-8 text-lg">
            <h2 class="mb-4 flex items-center gap-2 text-2xl font-bold">
                {{ props.branch.title }}
                <Link :href="route('branches.edit', branch.id)">
                    <v-icon
                        class="h-6 text-secondary hover:scale-105 hover:cursor-pointer hover:text-secondary-hover"
                        name="md-edit"
                    />
                </Link>
                <Link :href="route('branches.destroy', branch.id)" method="delete" as="button">
                    <v-icon
                        class="h-6 text-danger hover:scale-105 hover:cursor-pointer hover:text-danger-hover"
                        name="md-delete"
                    />
                </Link>
            </h2>
        </div>
        <!-- Page Body -->
        <div
            class="mt-8 space-y-4 px-4"
            v-if="props.branch.children && props.branch.children?.length > 0"
        >
            <div class="space-y-4">
                <div v-for="child in props.branch.children" :key="child.id">
                    <Link
                        class="block rounded-xl bg-gray-50 px-6 py-4 text-xl shadow-md transition hover:-translate-y-2 hover:cursor-pointer hover:bg-gray-100 hover:shadow-lg"
                        :href="route('branches.show', child.id)"
                    >
                        {{ child.title }}
                    </Link>
                </div>
            </div>
        </div>
    </authenticated-layout>
</template>

<style scoped></style>
