<template>
  <button
    class="base-btn"
    :type="type"
    :disabled="loading"
    @click="$emit('click')"
  >
    {{ loading ? loadingText : text }}
    <slot></slot>
  </button>
</template>

<script setup lang="ts">
defineProps<{
  type?: 'button' | 'submit' | 'reset'
  text?: string
  loadingText?: string
  loading?: boolean
}>()

defineEmits(['click'])
</script>