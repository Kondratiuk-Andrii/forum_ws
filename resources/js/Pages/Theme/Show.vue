<script setup lang="ts">
    import { Head } from '@inertiajs/vue3';
    import { Link } from '@inertiajs/vue3';
    import Swal from 'sweetalert2';
    import { ref, watchEffect } from 'vue';
    import Breadcrumbs from '@/Components/Breadcrumbs.vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { IFlash, ITheme } from '@/types';

    const props = defineProps<{
        theme: ITheme;
        flash: IFlash;
    }>();

    const breadcrumbs = ref(
        props.theme.branch.parent_id
            ? [
                  { label: 'Forum', url: route('sections.index') },
                  { label: `${props.theme.branch.section_title}`, url: route('sections.index') },
                  {
                      label: `${props.theme.branch.parent_title}`,
                      url: route('branches.show', props.theme.branch.parent_id),
                  },
                  {
                      label: `${props.theme.branch.title}`,
                      url: route('branches.show', props.theme.branch.id),
                  },
                  { label: `${props.theme.title}` },
              ]
            : [
                  { label: 'Forum', url: route('sections.index') },
                  { label: `${props.theme.branch.section_title}`, url: route('sections.index') },
                  {
                      label: `${props.theme.branch.title}`,
                      url: route('branches.show', props.theme.branch.id),
                  },
                  { label: `${props.theme.title}` },
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
    <Head :title="props.theme.title" />
    <authenticated-layout>
        <template #header>
            <Breadcrumbs :breadcrumbs="breadcrumbs" />
        </template>

        <!-- Page Heading -->

        <div class="mt-4 flex items-center justify-between gap-8 px-4 text-lg">
            <h2 class="mb-4 flex items-center gap-2 text-2xl font-bold">
                {{ props.theme.title }}
                <Link :href="route('themes.edit', theme.id)">
                    <v-icon
                        class="h-6 text-secondary hover:scale-105 hover:cursor-pointer hover:text-secondary-hover"
                        name="md-edit"
                    />
                </Link>
                <Link :href="route('themes.destroy', theme.id)" method="delete" as="button">
                    <v-icon
                        class="h-6 text-danger hover:scale-105 hover:cursor-pointer hover:text-danger-hover"
                        name="md-delete"
                    />
                </Link>
            </h2>
        </div>
    </authenticated-layout>
</template>

<style scoped></style>
