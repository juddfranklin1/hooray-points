<template>
  <div class="my-4 py-3 relative">
    <h1 class="primary-headline">Login</h1>
    <form @submit.prevent="login" class="flex flex-col w-full lg:w-2xl border px-4 py-3">
        <div class="w-full mb-4 flex flex-col">
            <label for="email">
                Email Address
            </label>
            <input type="email" class="px-3 py-2 mr-3" id="email" name="email" v-model="email">
            <label for="passwordp">
                Password
            </label>
            <input type="password" id="password" class="px-3 py-2 mr-3" name="password" v-model="password">
        </div>
        <div class="w-full mb-4">
            <button class=" w-2xl trigger-button" type="submit">Login</button>
        </div>
    </form>
  </div>
</template>

<script>
export default {
  data () {
    return {
      email: '',
      password: ''
    }
  },

  methods: {
    login () {
      this.$store
        .dispatch('login', {
          email: this.email,
          password: this.password
        })
        .then(() => {
          this.$router.push({ name: 'users' })
        })
        .catch(err => {
          console.log(err)
        })
    }
  }
}
</script>
<style>

</style>
