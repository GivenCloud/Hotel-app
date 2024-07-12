<template>
  <div>
    <form @submit.prevent="login" class="flex flex-col space-y-4">
      <input type="email" v-model="email" placeholder="Email" class="p-2 border rounded" required />
      <input type="password" v-model="password" placeholder="Password" class="p-2 border rounded" required />
      <button type="submit" class="py-2 px-4 bg-blue-500 text-white rounded">Login</button>
    </form>
    <p v-if="errorMessage" class="text-red-500 mt-2">{{ errorMessage }}</p>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      email: '',
      password: '',
      errorMessage: ''
    };
  },
  methods: {
    async login() {
      try {
        const response = await axios.post('/login', {
          email: this.email,
          password: this.password
        });
        alert(response.data.message);
      } catch (error) {
        if (error.response && error.response.data.errors) {
          this.errorMessage = error.response.data.errors.email[0];
        }
      }
    }
  }
};
</script>
