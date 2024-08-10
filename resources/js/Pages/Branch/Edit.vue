<script setup lang="ts">
    import { Head, useForm } from '@inertiajs/vue3';
    import axios from 'axios';
    import { onBeforeMount, onMounted, ref } from 'vue';
    import Breadcrumbs from '@/Components/Breadcrumbs.vue';
    import InputError from '@/Components/InputError.vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { IBranch, ISection } from '@/types';

    const props = defineProps<{
        branch: IBranch;
        sections: ISection[];
    }>();

    const branches = ref<IBranch[]>([]);

    const form = useForm({
        title: props.branch.title,
        section_id: props.branch.section_id,
        parent_id: props.branch.parent_id,
    });
    const breadcrumbs = ref([
        { label: 'Forum', url: route('sections.index') },
        { label: `Update ${props.branch.title}` },
    ]);

    const getBranches = () => {
        form.parent_id = null;
        axios.get(`/sections/${form.section_id}/branches_except/${props.branch.id}`).then((res) => {
            branches.value = res.data;
        });
    };

    onMounted(() => {
        getBranches();
        // console.log(props.branch.parent_id);
        form.parent_id = props.branch.parent_id;
    });
</script>

<template>
    <Head title="Update Branch" />
    <authenticated-layout>
        <template #header>
            <Breadcrumbs :breadcrumbs="breadcrumbs" />
        </template>

        <!-- Page Heading -->
        <div class="mx-auto mt-4 flex max-w-2xl flex-col justify-center">
            <h1 class="text-center text-2xl font-bold text-gray-800">
                Updating a {{ props.branch.title }}
            </h1>

            <!-- Form of Creating a Branch -->
            <form
                class="space-y-4 rounded-lg bg-white p-6 shadow-md"
                @submit.prevent="form.patch(route('branches.update', props.branch.id))"
            >
                <div class="mb-4">
                    <input
                        class="w-full rounded-lg border border-gray-300 p-3 focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary"
                        v-model="form.title"
                        type="text"
                        placeholder="Title of Branch..."
                    />
                    <InputError class="0 mt-2" :message="form.errors.title" />
                </div>
                <div class="mb-4" v-if="props.sections.length > 0">
                    <select
                        class="w-full rounded-lg border border-gray-300 p-3 focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary"
                        v-model="form.section_id"
                        @change="getBranches"
                    >
                        <option value="null" disabled selected>Select Section</option>
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
                        class="w-full rounded-lg border border-gray-300 p-3 focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary"
                        v-model="form.parent_id"
                    >
                        <option :value="null" selected>Select Branch</option>
                        <option v-for="branch in branches" :key="branch.id" :value="branch.id">
                            {{ branch.title }}
                        </option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.parent_id" />
                </div>
                <div class="flex justify-end">
                    <button
                        class="rounded-lg bg-primary px-6 py-3 text-white shadow transition duration-150 ease-in-out hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2"
                        type="submit"
                    >
                        Save
                    </button>
                </div>
            </form>
        </div>
    </authenticated-layout>
</template>

<style scoped></style>
