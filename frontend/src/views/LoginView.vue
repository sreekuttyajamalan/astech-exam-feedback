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
  errorMessage.value = ''

  if (!username.value || !password.value) {
    errorMessage.value = 'Please enter your username and password.'
    return
  }

  loading.value = true

  try {
    const response = await api.post('/login', {
      username: username.value,
      password: password.value,
    })

    // Save authentication token
    localStorage.setItem(
      'token',
      response.data.token
    )

    // Save student information for display purposes
    localStorage.setItem(
      'student',
      JSON.stringify(response.data.student)
    )

    // Redirect after successful login
    router.push('/feedback')

  } catch (error: any) {
    if (error.response?.status === 401) {
      errorMessage.value = 'Invalid username or password.'
    } else if (error.response?.status === 422) {
      errorMessage.value = 'Please enter valid login details.'
    } else {
      errorMessage.value = 'Unable to login. Please try again.'
    }

  } finally {
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