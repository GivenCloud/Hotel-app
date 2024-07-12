<template>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
      <div class="relative w-full max-w-4xl bg-white rounded-lg shadow-md overflow-hidden">
        <div class="flex">
          <div class="w-1/2 p-8">
            <h2 class="text-2xl font-bold mb-4">Login</h2>
            <LoginView />
            <p class="mt-4 text-center">
              Don't have an account?
              <span @click="toggleForm" class="text-blue-500 cursor-pointer">Sign up here</span>
            </p>
          </div>
          <div class="w-1/2 p-8">
            <h2 class="text-2xl font-bold mb-4">Register</h2>
            <RegisterView />
            <p class="mt-4 text-center">
              Already have an account?
              <span @click="toggleForm" class="text-blue-500 cursor-pointer">Log in here</span>
            </p>
          </div>
        </div>
        <div :class="['absolute px-4 top-0 w-1/2 h-full bg-blue-500 text-white flex items-center justify-center transition-transform duration-500', { 'translate-x-full': isSignUp }]" style="z-index: 1;">
          <div class="text-center p-8">
            <h2 class="text-4xl font-bold mb-4">{{ isSignUp ? 'Welcome Back!' : 'Hello, Friend!' }}</h2>
            <p>{{ isSignUp ? 'To keep connected with us please login with your personal info' : 'Enter your personal details and start journey with us' }}</p>
          </div>
        </div>
      </div>
    </div>
</template>
  
<script>
  import LoginView from './LoginView.vue';
  import RegisterView from './RegisterView.vue';
  
  export default {
    components: {
      LoginView,
      RegisterView
    },
    data() {
      return {
        isSignUp: true
      };
    },
    methods: {
      toggleForm() {
        this.isSignUp = !this.isSignUp;
      }
    }
  };
</script>