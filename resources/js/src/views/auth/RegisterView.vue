<template>
  <div>
    <form @submit.prevent="register" class="flex flex-col space-y-4">
      <input type="text" v-model="name" placeholder="Name" class="p-2 border rounded" required />
      <input type="email" v-model="email" placeholder="Email" class="p-2 border rounded" required />
      <input type="password" v-model="password" placeholder="Password" class="p-2 border rounded" required />
      <button type="submit" class="py-2 px-4 bg-blue-500 text-white rounded">Register</button>
    </form>
    <p v-if="errorMessage" class="text-red-500 mt-2">{{ errorMessage }}</p>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      name: '',
      email: '',
      password: '',
      errorMessage: ''
    };
  },
  methods: {
    async register() {
      try {
        const response = await axios.post('/register', {
          name: this.name,
          email: this.email,
          password: this.password,
        });
        alert(response.data.message);
      } catch (error) {
        if (error.response && error.response.data.errors) {
          this.errorMessage = Object.values(error.response.data.errors).flat().join(', ');
        }
      }
    }
  }
};
</script>
