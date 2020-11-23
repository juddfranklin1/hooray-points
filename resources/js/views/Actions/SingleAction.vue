<template>
  <div class="px-4 py-4">
    <h2 class="text-xl hover:bg-red-700 hover:text-white font-bold">User Overview</h2>
    <div v-if="loading" class="loading">
      Loading...
    </div>

    <div v-if="error" class="error">
      {{ error }}
    </div>

    <div v-if="user" class="content">
      <h2>{{ user.name }}</h2>
      <dl class="flex flex-wrap">
          <dt class="pr-4 w-1/2">Email</dt>
          <dd class="w-1/2">{{ user.email }}</dd>
          <dt class="pr-4 w-1/2">Point Total</dt>
          <dd class="w-1/2">{{ user.point_total }}</dd>
      </dl>

      <h3 class="text-xl pt-6 pb-4">Action History</h3>

      <ul v-if="user.actions.length > 0">
        <li v-for="(action, index) in user.actions" v-bind:key="'user-'+ user.id + '-action-' + action.id + '-' + index">
            <b>{{ action.pivot.human_date }}</b>: {{ action.name }} ({{ action.value }} points)
        </li>
      </ul>

      <UserAddActionForm :user="user" :actions="this.$attrs.actions"></UserAddActionForm>

      <h3 class="text-xl pt-6 pb-4">Reward History</h3>

      <ul v-if="user.rewards.length > 0">
        <li v-for="(reward, index) in user.rewards" v-bind:key="'user-'+ user.id + '-reward-' + reward.id + '-' + index">
            <b>{{ reward.pivot.human_date }}</b>: {{ reward.name }} ({{ reward.cost }} points)
        </li>
      </ul>
      <p v-else>No rewards claimed yet.</p>

    </div>
  </div>
</template>
<script>
import UserListItem from '../Users/UserListItem.vue';
import UserAddActionForm from '../Users/UserAddActionForm.vue';
import Axios from 'axios';

export default {
  data () {
    return {
      loading: false,
      user: null,
      error: null
    }
  },
  created () {
    // fetch the data when the view is created and the data is
    // already being observed
    this.fetchData()
  },
  name: 'SingleAction',
  methods: {
    fetchData () {
      this.error = this.user = null
      this.loading = true
      const fetchedId = this.$route.params.id
      // replace `getPost` with your data fetching util / API wrapper
      Axios.get('/api/user/' + fetchedId)
        .then( response => {
            this.loading = false;
            this.user = response.data
        }, error => {
            this.loading = false;
            this.error = error
        });
    },
    updateUser: function(newUser) {
        this.currentUser = newUser;
    }
  },
  components: {
      UserListItem,
      UserAddActionForm
  }
};
</script>
