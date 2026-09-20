<script setup lang="ts">
import { ref } from 'vue'

import DefaultLayout from '../layouts/DefaultLayout.vue'
import BaseInput from '../components/common/BaseInput.vue'
import BaseAlert from '../components/common/BaseAlert.vue'
import BaseButton from '../components/common/BaseButton.vue'

const username = ref('')
const password = ref('')
const errorMessage = ref('')
const loading = ref(false)

const handleLogin = () => {
  errorMessage.value = ''

  if (!username.value || !password.value) {
    errorMessage.value = 'Please enter your username and password.'
    return
  }

  console.log('Username:', username.value)
  console.log('Password:', password.value)
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