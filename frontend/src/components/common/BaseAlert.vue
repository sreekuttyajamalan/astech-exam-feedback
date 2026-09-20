<template>
  <div class="base-alert" :class="`alert-${type}`">
    {{ message }}
  </div>
</template>

<script setup lang="ts">
defineProps({
  type: { type: String, default: 'info' }, // 'info' | 'error' | 'success'
  message: { type: String, required: true }
})
</script>