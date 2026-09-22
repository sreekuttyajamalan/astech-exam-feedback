<script setup lang="ts">
const problems = [
  'Question unclear',
  'Incorrect question',
  'Missing information',
  'Question difficult to understand'
]

const selectedProblems = defineModel<string[]>('modelValue', {
  default: () => [],
})
</script>

<template>
  <div class="problem-selector">
    <h2>Problems</h2>

    <label
      v-for="problem in problems"
      :key="problem"
      class="problem-option"
    >
      <input
        v-model="selectedProblems"
        type="checkbox"
        :value="problem"
      />

      <span>{{ problem }}</span>
    </label>
  </div>
</template>