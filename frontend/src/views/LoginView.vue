<script setup lang="ts">
import { ref } from 'vue'
import { useRouter } from 'vue-router'

import DefaultLayout from '../layouts/DefaultLayout.vue'
import BaseInput from '../components/common/BaseInput.vue'
import BaseAlert from '../components/common/BaseAlert.vue'
import BaseButton from '../components/common/BaseButton.vue'
import api from '../services/api'

const username = ref('')
const password = ref('')
const errorMessage = ref('')
const loading = ref(false)
const router = useRouter()

const handleLogin = async () => {
  console.log('1. handleLogin started')
  console.log('Username:', username.value)
  console.log('Password:', password.value)

  errorMessage.value = ''

  if (!username.value || !password.value) {
    errorMessage.value = 'Please enter your username and password.'
    return
  }

  loading.value = true

  try {
    console.log('2. About to call Axios')

    const response = await api.post('/login', {
  username: username.value,
  password: password.value,
})

    console.log('3. Axios request completed')
    console.log('4. Response status:', response.status)
    console.log('5. Response data:', response.data)

    // Save logged-in student information
    localStorage.setItem(
      'student',
      JSON.stringify(response.data.student)
    )

    router.push('/feedback')

  } catch (error: any) {
    console.log('6. Axios request failed')
    console.error('Error:', error)
    console.error('Response:', error.response)

    if (error.response?.status === 401) {
      errorMessage.value = 'Invalid username or password.'
    } else {
      errorMessage.value = 'Unable to login. Please try again.'
    }
  } finally {
    console.log('7. Login finished')
    loading.value = false
  }
}
</script>

<template>
  <DefaultLayout>

    <section class="login-page">

      <div class="login-card card">

        <h1>Student Login</h1>

        <form @submit.prevent="handleLogin">

          <BaseInput
            id="username"
            v-model="username"
            label="Username"
            placeholder="Enter username"
          />

          <BaseInput
            id="password"
            v-model="password"
            label="Password"
            type="password"
            placeholder="Enter password"
          />

          <BaseAlert
            v-if="errorMessage"
            type="error"
            :message="errorMessage"
          />

          <BaseButton
            type="submit"
            text="Login"
            loading-text="Logging in..."
            :loading="loading"
          />

        </form>

      </div>

    </section>

  </DefaultLayout>
</template>