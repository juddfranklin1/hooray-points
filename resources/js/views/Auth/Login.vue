<template>
  <div class="my-4 py-3 relative">
    <Heading :level="1" class-list="heading--primary">Login</Heading>

    <p v-if="feedback.global" class="text-red-600 font-bold">{{ feedback.global }}</p>
    <form @submit.prevent="login" class="flex flex-col w-full lg:w-2xl border px-4 py-3">
        <div class="w-full mb-4 flex flex-col">
            <t-input-group
                label="Email Address"
                :feedback="feedback.email"
                :variant="feedback.email ? 'danger' : ''"
                >
                <t-input
                    @input="updateData('email', $event)"
                    required
                    :value="email"
                    :variant="feedback.email ? 'error' : 'normal'"
                    type="email"
                    name="email"
                />
            </t-input-group>
            <t-input-group
                label="Password"
                :feedback="feedback.password"
                :variant="feedback.password ? 'danger' : ''"
                >
                <t-input
                    required
                    @input="updateData('password', $event)"
                    :variant="feedback.password ? 'error' : 'normal'"
                    :value="password"
                    type="password"
                    name="password"
                />
            </t-input-group>
        </div>
        <div class="w-full mb-4">
            <button class=" w-2xl trigger-button" type="submit">Login</button>
        </div>
    </form>
  </div>
</template>

<script>

import debounce from 'lodash.debounce'
import Heading from '../components/Heading'

export default {
  data () {
    return {
      email: '',
      password: '',
      feedback: {
          password: '',
          email: '',
          global: ''
      }
    }
  },
  methods: {
    login () {
      if(this.validatePassword(this.password)){
          this.$store
            .dispatch('login', {
              email: this.email,
              password: this.password,
            })
            .then((details) => {
                this.$router.push({ name: 'user', params: { id: details.user.id } })
            })
            .catch(err => {
                if(typeof err.errors === 'object' && err.errors !== null) {
                    for (const [key, value] of Object.entries(err.errors)) {
                        this.feedback[key] = Array.isArray(value) ? value.join(' ') : value
                    }
                }
                this.feedback.global = Array.isArray(err.message) ? err.message.join(' ') : err.message
            })
      }
    },
    validatePassword(val) {
        this.password = val
        if(val.length < 8) {
            this.feedback.password = "Password must be at least 8 characters long"
            return false
        } else {
            this.feedback.password = ""
            return true
        }
    },
    updateData:_.debounce(function(field, val){
        console.log(field,val)
        if(field === 'password') {
            this.validatePassword(val)
        } else {
            this[field] = val
            this.feedback[field] = val.length > 0 ? '' : this.feedback[field]
        }
    }, 500),
  }
}
</script>
<style>

</style>
