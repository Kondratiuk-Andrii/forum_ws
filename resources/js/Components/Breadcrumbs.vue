<script setup lang="ts">
    import { Link } from '@inertiajs/vue3';

    const props = defineProps<{
        breadcrumbs: { label: string; url?: string }[];
    }>();
</script>

<template>
    <div>
        <span v-for="(breadcrumb, index) in props.breadcrumbs" :key="index">
            <Link class="text-primary" v-if="breadcrumb.url" :href="breadcrumb.url">
                {{ breadcrumb.label }}
            </Link>
            <span v-else>{{ breadcrumb.label }}</span>
            <span v-if="index < props.breadcrumbs.length - 1">&nbsp; /&nbsp;</span>
        </span>
    </div>
</template>

<style scoped></style>
