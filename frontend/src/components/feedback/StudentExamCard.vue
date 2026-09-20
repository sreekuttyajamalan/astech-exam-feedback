<script setup lang="ts">
defineProps<{
  studentName: string
  examName: string
}>()
</script>

<template>
  <div class="student-exam-card">
    <p>
      <strong>Student Name:</strong>
      {{ studentName }}
    </p>

    <p>
      <strong>Exam:</strong>
      {{ examName }}
    </p>
  </div>
</template>