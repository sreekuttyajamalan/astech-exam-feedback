<script setup lang="ts">
const feedback = defineModel<string>({ default: '' })
</script>

<template>
  <div class="feedback-textarea">
    <label for="feedback">
      Feedback
    </label>

    <textarea
      id="feedback"
      v-model="feedback"
      rows="6"
      placeholder="Enter your feedback"
    ></textarea>
  </div>
</template>