<script setup lang="ts">
import { ref, computed, onMounted } from 'vue'
import BaseButton from '../components/common/BaseButton.vue'
import api from '../services/api'


// =====================================================
// LOGGED-IN STUDENT
// =====================================================

const student = ref<any>(null)

// =====================================================
// REGISTERED EXAMS
// =====================================================

const exams = ref<any[]>([])

// Selected exam
const selectedExamId = ref<number | null>(null)
// =====================================================
// FORMAT EXAM DATE
// =====================================================

const formatDate = (date: string | null | undefined): string => {
  if (!date) {
    return 'Date not available'
  }

  const parsedDate = new Date(date)

  if (isNaN(parsedDate.getTime())) {
    return 'Date not available'
  }

  return parsedDate.toLocaleDateString('en-GB', {
    day: '2-digit',
    month: '2-digit',
    year: 'numeric',
  })
}
// =====================================================
// PAGE STATE
// =====================================================

const loading = ref(false)
const errorMessage = ref('')

// =====================================================
// FORM STATE
// =====================================================

const questionNumber = ref<number>(1)

const selectedProblems = ref<string[]>([])

const specificFeedback = ref('')

// =====================================================
// PROBLEM OPTIONS
// =====================================================

const problemOptions = [
  {
    value: 'not_covered',
    label: 'Not covered in notes'
  },
  {
    value: 'unclear',
    label: 'Question / answers unclear'
  },
  {
    value: 'multiple_correct',
    label: 'More than one correct answer'
  },
  {
    value: 'no_correct',
    label: 'No correct answer'
  },
  {
    value: 'difficult',
    label: 'Question difficult to understand'
  },
  {
    value: 'missing_info',
    label: 'Missing information'
  }
]

// =====================================================
// SELECTED EXAM
// =====================================================

const selectedExam = computed(() => {
  return exams.value.find(
    exam => exam.id === selectedExamId.value
  ) || null
})

// =====================================================
// LOAD STUDENT + EXAMS
// =====================================================

onMounted(async () => {
  console.log('=================================')
  console.log('Feedback page mounted')
  console.log('=================================')

  // Get logged-in student from localStorage
  const storedStudent = localStorage.getItem('student')

  console.log('Stored student:', storedStudent)

  // If no student is stored
  if (!storedStudent) {
    errorMessage.value =
      'No logged-in student found. Please login again.'

    console.error('No logged-in student found')

    return
  }

  // Convert localStorage JSON back to object
  try {
    student.value = JSON.parse(storedStudent)

    console.log('Logged-in student:', student.value)
  } catch (error) {
    console.error('Failed to parse student data:', error)

    errorMessage.value =
      'Unable to read student information. Please login again.'

    return
  }

  // Make sure student ID exists
  if (!student.value?.id) {
    console.error('Student ID is missing:', student.value)

    errorMessage.value =
      'Student information is incomplete. Please login again.'

    return
  }

  // ===================================================
  // LOAD REGISTERED EXAMS
  // ===================================================

  loading.value = true
  errorMessage.value = ''

  try {
    console.log(
      'Loading exams for student ID:',
      student.value.id
    )

    const response = await api.get('/student/exam', {
      params: {
        student_id: student.value.id
      }
    })

    console.log('Student exams response:', response.data)

    // Store exams
    exams.value = response.data.exams || []

    console.log(
      'Registered exams:',
      exams.value
    )

    // Automatically select first exam if available
    if (exams.value.length > 0) {
      selectedExamId.value = exams.value[0].id

      console.log(
        'Automatically selected exam:',
        selectedExamId.value
      )
    }

  } catch (error: any) {
    console.error(
      'Failed to load student exams:',
      error
    )

    console.error(
      'API error response:',
      error.response
    )

    if (error.response?.status === 404) {
      errorMessage.value =
        'Student exams API endpoint was not found.'
    } else if (error.response?.status === 500) {
      errorMessage.value =
        'Server error while loading your exams.'
    } else {
      errorMessage.value =
        'Unable to load your registered exams.'
    }

  } finally {
    loading.value = false
  }
})

// =====================================================
// SUBMIT FEEDBACK
// =====================================================

const submitFeedback = async () => {

  console.log('=================================')
  console.log('Submitting feedback')
  console.log('=================================')

  // Basic validation
  if (!selectedExamId.value) {
    alert('Please select an exam.')
    return
  }

  if (!questionNumber.value || questionNumber.value < 1) {
    alert('Please enter a valid question number.')
    return
  }

  if (
    selectedProblems.value.length === 0 &&
    !specificFeedback.value.trim()
  ) {
    alert(
      'Please select a problem or enter specific feedback.'
    )
    return
  }

  if (!student.value?.id) {
    alert('Student information is missing. Please login again.')
    return
  }

  // Get today's date
  const feedbackDate = new Date()
    .toISOString()
    .split('T')[0]

  const feedbackData = {
    student_id: student.value.id,
    exam_id: selectedExamId.value,
    question_number: questionNumber.value,
    problems: selectedProblems.value,
    specific_feedback: specificFeedback.value.trim(),
    feedback_date: feedbackDate,
  }

  console.log('Feedback data:', feedbackData)

  try {

    loading.value = true
    errorMessage.value = ''

    const response = await api.post(
      '/feedback',
      feedbackData
    )

    console.log(
      'Feedback API response:',
      response.data
    )

    alert('Feedback submitted successfully!')

    // Reset form
    questionNumber.value = 1
    selectedProblems.value = []
    specificFeedback.value = ''

  } catch (error: any) {

    console.error(
      'Failed to submit feedback:',
      error
    )

    console.error(
      'API response:',
      error.response?.data
    )

    if (error.response?.status === 422) {

      errorMessage.value =
        error.response?.data?.message ||
        'Please check the feedback details.'

    } else if (error.response?.status === 500) {

      errorMessage.value =
        'Server error. Feedback could not be saved.'

    } else {

      errorMessage.value =
        'Unable to submit feedback. Please try again.'

    }

  } finally {

    loading.value = false

  }
}
// =====================================================
// LOGOUT
// =====================================================

const logout = () => {
  console.log('Logging out student...')

  // Remove logged-in student data
  localStorage.removeItem('student')

  // Redirect to login page
  window.location.href = '/login'
}

</script>


<template>

  <div class="page-container">

    <div class="feedback-card">

      <!-- =================================================
           HEADER
      ================================================== -->

      <header class="feedback-header">

        <div class="header-top">
          <h1>
            Exam Question Feedback
          </h1>

          <BaseButton
            type="button"
            class="logout-button"
            @click="logout"
          >
            Logout
          </BaseButton>
        </div>

        <p class="subtitle">
          Please review your exam details and provide your
          feedback below.
        </p>

       </header>


      <!-- =================================================
           ERROR MESSAGE
      ================================================== -->

      <div
        v-if="errorMessage"
        class="error-message"
      >
        {{ errorMessage }}
      </div>


      <!-- =================================================
           LOADING
      ================================================== -->

      <div
        v-if="loading"
        class="loading-message"
      >
        Loading your exam details...
      </div>


      <!-- =================================================
           STUDENT & EXAM INFORMATION
      ================================================== -->

      <div
        v-if="student && !loading"
        class="student-exam-card"
      >

        <!-- Student Name -->

        <div class="info-item">

          <span class="info-label">
            Student Name
          </span>

          <span class="info-value">
            {{ student?.firstname }}
            {{ student?.lastname }}
          </span>

        </div>


        <!-- Username -->

        <div class="info-item">

          <span class="info-label">
            Username
          </span>

          <span class="info-value">
            {{ student?.username }}
          </span>

        </div>


        <!-- Exam -->

        <div class="info-item">

          <span class="info-label">
            Exam
          </span>

          <select
            v-model="selectedExamId"
            class="form-input"
          >

            <option
              :value="null"
              disabled
            >
              Select an exam
            </option>

            <option
              v-for="exam in exams"
              :key="exam.id"
              :value="exam.id"
            >
              {{ exam.name }}
            </option>

          </select>

        </div>


        <!-- Exam Date -->

        <div class="info-item">

          <span class="info-label">
            Date
          </span>

          <span class="info-value">

            <template v-if="selectedExam">

              {{ formatDate(selectedExam.exam_date) }}

            </template>

            <template v-else>
              Select an exam
            </template>

          </span>

        </div>

      </div>


      <!-- No exams -->

      <div
        v-if="
          !loading &&
          student &&
          exams.length === 0 &&
          !errorMessage
        "
        class="no-exams-message"
      >

        No registered exams were found for this student.

      </div>


      <!-- =================================================
           DIVIDER
      ================================================== -->

      <hr
        v-if="student && !loading"
        class="divider"
      />


      <!-- =================================================
           FEEDBACK FORM
      ================================================== -->

      <div
        v-if="student && !loading && exams.length > 0"
      >

        <!-- QUESTION NUMBER -->

        <div class="form-section">

          <label
            class="form-label"
            for="questionNumber"
          >
            Question Number
          </label>

          <input
            id="questionNumber"
            type="number"
            v-model.number="questionNumber"
            class="form-input question-input"
            min="1"
            placeholder="Enter question number"
          />

        </div>


        <!-- PROBLEMS -->

        <div class="form-section">

          <label class="form-label">
            Problems Encountered
          </label>

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

              <span>
                {{ option.label }}
              </span>

            </label>

          </div>

        </div>


        <!-- SPECIFIC FEEDBACK -->

        <div class="form-section">

          <label
            class="form-label"
            for="specificFeedback"
          >
            Specific Feedback
          </label>

          <textarea
            id="specificFeedback"
            v-model="specificFeedback"
            class="form-textarea"
            placeholder="Write your specific feedback here..."
            rows="6"
          ></textarea>

        </div>


        <!-- SUBMIT -->

        <div class="form-actions">

          <BaseButton
            type="button"
            @click="submitFeedback"
          >
            Submit Feedback
          </BaseButton>

        </div>

      </div>

    </div>

  </div>

</template>