<template>
    <v-dialog
        v-model="modal"
        @closed="onClose"
        @update-user="modal = false"
        >
        <template v-slot:activator="{ on, attrs }">
            <v-btn
                color="primary"
                dark
                v-bind="attrs"
                v-on="on"
            >
            New Reward
            </v-btn>
        </template>
        <v-card>
            <v-card-title>
                <h2 class="text-xl">{{ currentReward ? 'Edit ' + currentReward.title : 'New Reward' }}</h2>
            </v-card-title>
            <v-card-text>
                <v-container>
                    <v-row>
                        <form reward="new-reward" class="my-4" @submit.prevent="onSubmit($event)" method="post">
                            <div class="flex flex-col">
                                <label class="text-lg pt-4" for="reward_title">Title</label>
                                <v-text-field
                                    outlined
                                    required
                                    :value="currentReward ? currentReward.title : ''"
                                    name="title" />
                                <label class="text-lg pt-4" for="reward_description">Description</label>
                                <v-textarea
                                    outlined
                                    name="description"
                                    :value="currentReward ? currentReward.description : ''"
                                    id="reward_description" />
                                <label class="text-lg pt-4" for="reward_value">cost</label>
                                <v-text-field
                                    outlined
                                    required
                                    type="number"
                                    name="cost"
                                    :value="currentReward ? currentReward.cost : 1"
                                    id="reward_cost" />
                                <label class="text-lg pt-4" for="reward_user">Assigned User (if any)</label>
                                <v-select
                                    name="assignee_id"
                                    :value="currentReward ? currentReward.assignee_id : null"
                                    :options="[
                                        {
                                            name: 'unassigned',
                                            id: null
                                        },
                                        ...users
                                    ]"

                                    value-attribute="id"
                                    text-attribute="name"
                                    id="reward_user" />
                                <button class="border-2 border-gray-200 py-2 px-4 my-4" type="submit">{{ currentReward ? 'Update' : 'Create' }}</button>
                            </div>
                        </form>
                    </v-row>
                </v-container>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>

<script>
import Axios from 'axios';
import { mapState } from 'vuex';

export default {
    name: 'RewardForm',
    props: [
        'reward'
    ],
    emits: [
        'reward-submit'
    ],
    computed: {
        ...mapState({
            users: state => {
                return state.user.users.map(user => {
                    return {
                        text: user.name,
                        value: user.id
                    }
                })
            },
            rewards: state => state.reward.rewards,
        })
    },
    methods: {
        onSubmit: function($e) {
            const data = {};
            data.title = $e.target.title.value;
            data.description = $e.target.description.value;
            data.cost = $e.target.cost.value;
            data.assignee_id = $e.target.assignee_id.value;
            if(!this.currentReward) {
                Axios.post('/api/rewards', data)
                    .then(result => {
                        this.$store.commit('addReward', result.data);
                        $e.target.reset();
                        this.$emit('reward-submit');
                        this.modal = false;
                    }, error => console.log(error));
            } else {
                Axios.post('/api/rewards/' + this.currentReward.id, data)
                    .then(result => {
                        this.$store.commit('updateReward', result.data);
                        this.$emit('reward-submit');
                        this.modal = false;
                    }, error => console.log(error));
            }
        },
        getReward: function() {
            return this.$store.getters.getRewardById(Number.parseInt(this.$route.params.id))
        },
        // Force reroute back to main rewards page from "edit-reward" and "new-reward" routes.
        // This ensures that the modal works seamlessly on the rewards page, and is tied to the url
        onClose: function($e) {
            if(this.$route.name == 'new-reward' | this.$route.name === 'edit-reward'){
                this.$router.push('/rewards');
            }
        }
    },
    data() {
        return {
            modal: false,
            currentReward: this.getReward()
        }
    }
};

</script>
