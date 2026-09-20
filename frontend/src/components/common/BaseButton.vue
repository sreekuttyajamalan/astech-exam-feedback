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
defineProps({
  type: { type: String, default: 'button' },
  text: { type: String, default: '' },
  loadingText: { type: String, default: 'Loading...' },
  loading: { type: Boolean, default: false }
})
defineEmits(['click'])
</script>