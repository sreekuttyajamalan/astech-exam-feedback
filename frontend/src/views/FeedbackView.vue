<script setup lang="ts">
import { ref } from 'vue'
import BaseButton from '../components/common/BaseButton.vue'

// Static student/exam data
const studentName = ref('Paul Nolan')
const username = ref('yev')
const examName = ref('M1 CAT B2 Physics')
const examDate = ref('26/07/2024')

// Form state
const questionNumber = ref<number>(1)
const selectedProblems = ref<string[]>([])
const specificFeedback = ref('')

// Problem options
const problemOptions = [
  { value: 'not_covered', label: 'Not covered in notes' },
  { value: 'unclear', label: 'Question / answers unclear' },
  { value: 'multiple_correct', label: 'More than one correct answer' },
  { value: 'no_correct', label: 'No correct answer' },
  { value: 'difficult', label: 'Question difficult to understand' },
  { value: 'missing_info', label: 'Missing information' }
]

const submitFeedback = () => {
  console.log('Submitting:', {
    questionNumber: questionNumber.value,
    problems: selectedProblems.value,
    feedback: specificFeedback.value
  })
  alert('Feedback submitted! (Static demo)')
}
</script>

<template>
  <div class="page-container">
    <div class="feedback-card">

      <!-- Header -->
      <header class="feedback-header">
        <h1>Exam Question Feedback</h1>
        <p class="subtitle">Please review your exam details and provide your feedback below.</p>
      </header>

      <!-- Student & Exam Info Card -->
      <div class="student-exam-card">
        <div class="info-item">
          <span class="info-label">Student Name</span>
          <span class="info-value">{{ studentName }}</span>
        </div>
        <div class="info-item">
          <span class="info-label">Username</span>
          <span class="info-value">{{ username }}</span>
        </div>
        <div class="info-item">
          <span class="info-label">Exam</span>
          <span class="info-value">{{ examName }}</span>
        </div>
        <div class="info-item">
          <span class="info-label">Date</span>
          <span class="info-value">{{ examDate }}</span>
        </div>
      </div>

      <hr class="divider" />

      <!-- Question Number -->
      <div class="form-section">
        <label class="form-label">Question Number</label>
        <input 
          type="number" 
          v-model.number="questionNumber" 
          class="form-input question-input"
          min="1"
          placeholder="Enter question number"
        />
      </div>

      <!-- Problems Section -->
      <div class="form-section">
        <label class="form-label">Problems Encountered</label>
        <div class="checkbox-group">
          <label 
            v-for="option in problemOptions" 
            :key="option.value" 
            class="checkbox-item"
          >
            <input 
              type="checkbox" 
              :value="option.value" 
              v-model="selectedProblems" 
            />
            <span>{{ option.label }}</span>
          </label>
        </div>
      </div>

      <!-- Specific Feedback -->
      <div class="form-section">
        <label class="form-label">Specific Feedback</label>
        <textarea 
          v-model="specificFeedback" 
          class="form-textarea"
          placeholder="Write your specific feedback here..."
          rows="6"
        ></textarea>
      </div>

      <!-- Submit Button -->
      <div class="form-actions">
        <BaseButton type="button" @click="submitFeedback">
          Submit Feedback
        </BaseButton>
      </div>

    </div>
  </div>
</template>