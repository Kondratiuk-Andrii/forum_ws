<script setup lang="ts">
    defineProps<{
        message?: string;
    }>();
</script>

<template>
    <div v-show="message">
        <p class="text-danger ml-px text-sm font-semibold">
            {{ message }}
        </p>
    </div>
</template>
