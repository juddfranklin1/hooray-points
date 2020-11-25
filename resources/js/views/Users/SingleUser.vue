<template>
  <div class="px-4 py-4 flex">
      <div class="md:w-1/3 w-full">
        <h2 class="text-xl hover:bg-red-700 hover:text-white font-bold">User Overview</h2>
        <div v-if="loading" class="loading">
        Loading...
        </div>
        <div v-if="error" class="error">
        {{ error }}
        </div>

        <div v-if="currentUser" class="content">
            <h2>{{ currentUser.name }}</h2>
            <dl class="flex flex-wrap">
                <dt class="pr-4 w-1/2">Email</dt>
                <dd class="w-1/2">{{ currentUser.email }}</dd>
                <dt class="pr-4 w-1/2">Point Total</dt>
                <dd class="w-1/2">{{ currentUser.point_total }}</dd>
            </dl>
        </div>
    </div>

    <div class="md:w-1/3 w-full mx-4">
      <h3 class="text-xl pt-6 pb-4">Action History</h3>
        <div v-if="loading" class="loading">
        Loading...
        </div>
        <div v-if="error" class="error">
        {{ error }}
        </div>
        <div v-if="currentUser" class="content">

            <ul v-if="currentUser.actions.length > 0">
                <li v-for="(action, index) in currentUser.actions" v-bind:key="'user-'+ currentUser.id + '-action-' + action.id + '-' + index">
                    <b>{{ action.pivot.human_date }}</b>: {{ action.name }} ({{ action.value }} points) x {{ action.pivot.multiplier }}
                </li>
            </ul>

          <UserAddActionForm @update-user="updateUser" :user="currentUser"></UserAddActionForm>
        </div>
    </div>
    <div class="md:w-1/3 w-full mx-4">
        <h3 class="text-xl pt-6 pb-4">Reward History</h3>

        <div v-if="loading" class="loading">
        Loading...
        </div>
        <div v-if="error" class="error">
        {{ error }}
        </div>
        <div v-if="currentUser" class="content">

            <ul v-if="currentUser.rewards.length > 0">
                <li v-for="(reward, index) in currentUser.rewards" v-bind:key="'user-'+ currentUser.id + '-reward-' + reward.id + '-' + index">
                    <b>{{ reward.pivot.human_date }}</b>: {{ reward.title }} ({{ reward.cost }} points) x {{ reward.pivot.multiplier }}
                </li>
            </ul>
            <p v-else>No rewards claimed yet.</p>
            <UserAddRewardForm @update-user="updateUser" :user="currentUser"></UserAddRewardForm>
        </div>

    </div>
  </div>
</template>
<script>

import { mapState } from 'vuex';
import store from '../../store/';
import UserListItem from './UserListItem.vue';
import UserAddActionForm from './UserAddActionForm.vue';
import UserAddRewardForm from './UserAddRewardForm.vue';
import Axios from 'axios';

export default {
  data () {
    return {
      loading: false,
      currentUser: null,
      error: null
    }
  },
  created () {
    // fetch the data when the view is created and the data is
    // already being observed
    this.fetchData()
  },
  name: 'SingleUser',
  methods: {
    fetchData () {
      this.error = this.user = null
      this.loading = true
      const fetchedId = this.$route.params.id
      // replace `getPost` with your data fetching util / API wrapper
      Axios.get('/api/user/' + fetchedId)
        .then( response => {
            this.loading = false;
            this.currentUser = response.data
        }, error => {
            this.loading = false;
            this.error = error
        });
    },
    updateUser: function(newUser) {
        this.currentUser = newUser;
    }
  },
    computed: {
        ...mapState({
            users: state => state.user.users,
            actions: state => state.action.actions,
            rewards: state => state.reward.rewards,
        }),
    },
    components: {
        UserListItem,
        UserAddActionForm,
        UserAddRewardForm,
  }
};
</script>
