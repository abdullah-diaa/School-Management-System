<template>
  <div>
    <h1>Create User</h1>
    <form @submit.prevent="handleSubmit">
      <div class="form-group">
        <label for="user_name">Username:</label>
        <input type="text" id="user_name" v-model="formData.user_name" class="form-control" required>
        <div v-if="errors.user_name" class="invalid-feedback">{{ errors.user_name }}</div>
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" v-model="formData.email" class="form-control" required>
        <div v-if="errors.email" class="invalid-feedback">{{ errors.email }}</div>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" v-model="formData.password" class="form-control" required>
        <div v-if="errors.password" class="invalid-feedback">{{ errors.password }}</div>
      </div>
      <div class="form-group">
        <label for="date_of_birth">Date of Birth:</label>
        <input type="date" id="date_of_birth" v-model="formData.date_of_birth" class="form-control">
      </div>
      <div class="form-group">
        <label for="role">Role:</label>
        <select id="role" v-model="formData.role" class="form-control" required>
          <option value="Admin">Admin</option>
          <option value="Student">Student</option>
          <option value="Teacher">Teacher</option>
        </select>
      </div>
      <div class="form-group">
        <label for="profile_picture">Profile Picture:</label>
        <input type="file" id="profile_picture" @change="handleFileChange" class="form-control-file">
      </div>
      <button type="submit" class="btn btn-primary">Create User</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      formData: {
        user_name: '',
        email: '',
        password: '',
        date_of_birth: '',
        role: 'Student',
        profile_picture: null
      },
      errors: {}
    };
  },
  methods: {
    handleSubmit() {
      // Clear previous errors
      this.errors = {};

      // Send form data to backend
      axios.post('/api/users', this.formData)
        .then(response => {
          // Handle success
          console.log('User created successfully:', response.data);
          // Redirect to user listing page or show success message
        })
        .catch(error => {
          // Handle error
          if (error.response && error.response.status === 422) {
            // If validation error, display errors
            this.errors = error.response.data.errors;
          } else {
            console.error('Error creating user:', error);
            // Handle other types of errors (e.g., server error)
            // Show a generic error message to the user
          }
        });
    },
    handleFileChange(event) {
      // Handle file change for profile picture
      this.formData.profile_picture = event.target.files[0];
    }
  }
};
</script>

<style scoped>
.invalid-feedback {
  color: #dc3545;
}
</style>
