<template>
  <div class="px-4 py-4 flex flex-col">
    <Heading :level="1" class-list="heading--primary">
        {{ user && currentUser && user.user.id === currentUser.id ?
            "My Profile" :
            currentUser ?
                currentUser.name + ' Overview' :
                '' }}
    </Heading>

    <div class="flex lg:flex-row flex-col flex-wrap">
        <div v-if="loading" class="w-full font-extrabold text-blue-600 loading">
        Loading...
        </div>
        <div v-else class="w-full">
            <div v-if="error" class="error">
            {{ error }}
            </div>

            <div v-if="currentUser" class="content border-gray-400 border border-solid p-3">
                <h3 class="text-xl pb-4 font-extrabold text-blue-600">Summary</h3>
                <dl class="flex flex-wrap">
                    <dt class="pr-2 font-bold">Email</dt>
                    <dd class="pr-2">{{ currentUser.email }}</dd>
                    <dt class="pr-2 font-bold">Point Total</dt>
                    <dd class="pr-2">{{ currentUser.point_total }}</dd>
                </dl>
            </div>
        </div>

        <div class="md:w-1/3 w-full px-4">
            <h3 class="text-xl pt-6 pb-4">Goals</h3>
            <div v-if="currentUser" class="content">
                <ul v-if="currentUser.goals && currentUser.goals.length > 0">
                    <li v-for="(goal, index) in currentUser.goals" v-bind:key="'user-'+ currentUser.id + '-goal-' + goal.id + '-' + index">
                        <p v-bind:class="goal.completed_at ? 'bg-green-300' : ''">
                            <b>{{ goal.name }}</b>: {{ goal.type }} - {{ goal.expected_completion_at }}
                            <span v-if="goal.length > 1">Team Goal</span>
                            {{ goal.point_total }}
                            {{ goal.description }}
                        </p>
                    </li>
                </ul>
                <p v-else>No goals set yet.</p>
            </div>
        </div>

        <div class="md:w-1/3 w-full px-4">
            <h3 class="text-xl pt-6 pb-4">Action History</h3>
            <div v-if="currentUser" class="content">
                <v-dialog
                    v-model="actionModal"
                    @update-user="actionModal = false"
                    >
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn
                            color="primary"
                            dark
                            v-bind="attrs"
                            v-on="on"
                        >
                        {{ user && user.user.id === currentUser.id ? 'I' : currentUser.name }} did something!
                        </v-btn>
                    </template>
                    <v-card>
                        <v-card-title>
                            <h2 class="text-xl">What did {{ currentUser.name }} do?</h2>
                        </v-card-title>
                        <v-card-text>
                            <v-container>
                                <v-row>
                                    <UserAddActionForm @update-user="updateUser" :user="currentUser"></UserAddActionForm>
                                </v-row>
                            </v-container>
                        </v-card-text>
                    </v-card>
                </v-dialog>


                <ul v-if="currentUser.actions.length > 0">
                    <li v-for="(action, index) in currentUser.actions" v-bind:key="'user-'+ currentUser.id + '-action-' + action.id + '-' + index">
                        <b>{{ action.pivot.human_date }}</b>: {{ action.name }} ({{ action.value }} points) x {{ action.pivot.multiplier }}
                    </li>
                </ul>
                <p v-else>No actions completed yet.</p>
            </div>
        </div>
        <div class="md:w-1/3 w-full px-4">
            <h3 class="text-xl pt-6 pb-2">Reward History</h3>
            <div v-if="currentUser" class="content">
                <v-dialog
                    v-model="rewardModal"
                    @update-user="rewardModal = false"
                    >
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn
                            color="primary"
                            dark
                            v-bind="attrs"
                            v-on="on"
                        >
                        {{ user && user.user.id === currentUser.id ? 'I want to cash in!' : currentUser.name + ' wants to cash in!' }}
                        </v-btn>
                    </template>
                    <v-card>
                        <v-card-title>
                            <h2 class="text-xl">What does {{ currentUser.name }} want?</h2>
                        </v-card-title>
                        <v-card-text>
                            <v-container>
                                <v-row>
                                    <UserAddRewardForm @update-user="updateUser" :user="currentUser"></UserAddRewardForm>
                                </v-row>
                            </v-container>
                        </v-card-text>
                    </v-card>
                </v-dialog>

                <ul class="mt-4" v-if="currentUser.rewards.length > 0">
                    <li v-for="(reward, index) in currentUser.rewards" v-bind:key="'user-'+ currentUser.id + '-reward-' + reward.id + '-' + index">
                        <b>{{ reward.pivot.human_date }}</b>: {{ reward.title }} ({{ reward.cost }} points) x {{ reward.pivot.multiplier }} - <a class="underline hover:no-underline font-bold text-blue-600" :href="'/api/user-rewards/' + reward.pivot.id + '/voucher'">get voucher</a>
                    </li>
                </ul>
                <p v-else>No rewards claimed yet.</p>
            </div>

        </div>
    </div>
  </div>
</template>
<script>

import { mapState } from 'vuex'
import store from '../../store/'
import Heading from '../components/Heading'
import UserListItem from './UserListItem'
import UserAddActionForm from './UserAddActionForm'
import UserAddRewardForm from './UserAddRewardForm'
import Axios from 'axios'

export default {
    data () {
        return {
            loading: false,
            currentUser: null,
            showActionForm: false,
            showRewardForm: false,
            error: null,
            rewardModal: false,
            actionModal: false,
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
            this.error = this.currentUser = null
            this.loading = true
            const fetchedId = this.$route.params.id
            Axios.get('/api/users/' + fetchedId)
                .then(
                    response => {
                        this.loading = false;
                        this.currentUser = response.data
                    },
                    err => {
                        this.loading = false;
                        this.error = err
                    }
                );
        },
        updateUser: function(newUser) {
            this.currentUser = newUser;
            this.rewardModal = this.actionModal = false;
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
        },
    },
    computed: {
        ...mapState({
            user: state => state.auth.user,
            users: state => state.user.users,
            actions: state => state.action.actions,
            rewards: state => state.reward.rewards,
        }),
    },
    components: {
        UserListItem,
        UserAddActionForm,
        UserAddRewardForm,
        Heading,
    }
};
</script>
