<template>
  <div class="px-4 py-4 flex flex-col">
    <h1 class="primary-headline">User Overview{{ currentUser ? ' - ' + currentUser.name : '' }}</h1>
    <div class="flex lg:flex-row flex-col">

        <div class="md:w-1/3 w-full mx-4">
            <div v-if="loading" class="loading">
            Loading...
            </div>
            <div v-if="error" class="error">
            {{ error }}
            </div>

            <div v-if="currentUser" class="content">
                <h3 class="text-xl pt-6 pb-4">Summary</h3>
                <dl>
                    <dt>Email</dt>
                    <dd>{{ currentUser.email }}</dd>
                    <dt>Point Total</dt>
                    <dd>{{ currentUser.point_total }}</dd>
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
                <t-button
                    @click="showActionForm=true"
                    classes="trigger-button"
                >
                    {{ currentUser.name }} did something!
                </t-button>

                <ul v-if="currentUser.actions.length > 0">
                    <li v-for="(action, index) in currentUser.actions" v-bind:key="'user-'+ currentUser.id + '-action-' + action.id + '-' + index">
                        <b>{{ action.pivot.human_date }}</b>: {{ action.name }} ({{ action.value }} points) x {{ action.pivot.multiplier }}
                    </li>
                </ul>

                <t-modal
                    ref="modal"
                    v-model="showActionForm"
                    @update-user="$refs.modal.hide()"
                    >
                    <template v-slot:header>
                        What did {{ currentUser.name }} do?
                    </template>
                    <UserAddActionForm @update-user="updateUser" :user="currentUser"></UserAddActionForm>
                </t-modal>
            </div>
        </div>
        <div class="md:w-1/3 w-full mx-4">
            <h3 class="text-xl pt-6 pb-2">Reward History</h3>

            <div v-if="loading" class="loading">
            Loading...
            </div>
            <div v-if="error" class="error">
            {{ error }}
            </div>
            <div v-if="currentUser" class="content">
                <t-button
                    @click="showRewardForm=true"
                    classes="trigger-button"
                >
                    {{ currentUser.name }} wants to cash in!
                </t-button>

                <ul class="mt-4" v-if="currentUser.rewards.length > 0">
                    <li v-for="(reward, index) in currentUser.rewards" v-bind:key="'user-'+ currentUser.id + '-reward-' + reward.id + '-' + index">
                        <b>{{ reward.pivot.human_date }}</b>: {{ reward.title }} ({{ reward.cost }} points) x {{ reward.pivot.multiplier }}
                    </li>
                </ul>
                <p v-else>No rewards claimed yet.</p>
                <t-modal
                    ref="modal"
                    v-model="showRewardForm"
                    @update-user="$refs.modal.hide()"
                    >
                    <template v-slot:header>
                        What does {{ currentUser.name }} want?
                    </template>
                    <UserAddRewardForm @update-user="updateUser" :user="currentUser"></UserAddRewardForm>
                </t-modal>
            </div>

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
            showActionForm: false,
            showRewardForm: false,
            error: null
        }
    },
    created () {
        // fetch the data when the view is created and the data is
        // already being observed
        this.fetchData()
    },
    name: 'UserSingle',
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
            this.$refs.modal.hide();
        },
        beforeEnter: function(el) {
            el.style.height = '0';
        },
        enter: function(el) {
            el.style.height = el.scrollHeight + 'px';
        },
        beforeLeave: function(el) {
            el.style.height = el.scrollHeight + 'px';
        },
        leave: function(el) {
            el.style.height = '0';
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
