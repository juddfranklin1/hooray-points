<template>
    <t-modal
        ref="modal"
        @closed="onClose"
        @update-user="$refs.modal.hide()"
    >
        <template v-slot:header>
            <h2 class="text-xl">{{ currentReward ? 'Edit ' + currentReward.title : 'New Reward' }}</h2>
        </template>
        <form reward="new-reward" class="my-4" @submit.prevent="onSubmit($event)" method="post">
            <div class="flex flex-col">
                <label class="text-lg pt-4" for="reward_title">Title</label>
                <t-input
                    required
                    :value="currentReward ? currentReward.title : ''"
                    name="title" />
                <label class="text-lg pt-4" for="reward_description">Description</label>
                <t-textarea
                    name="description"
                    :value="currentReward ? currentReward.description : ''"
                    id="reward_description" />
                <label class="text-lg pt-4" for="reward_value">cost</label>
                <t-input
                    required
                    type="number"
                    name="cost"
                    :value="currentReward ? currentReward.cost : 1"
                    id="reward_cost" />
                <label class="text-lg pt-4" for="reward_user">Assigned User (if any)</label>
                <t-select
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
    </t-modal>
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
            users: state => state.user.users,
            rewards: state => state.reward.rewards,
        })
    },
    mounted(){
        this.$refs.modal.show();
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
                        this.$refs.modal.hide();
                    }, error => console.log(error));
            } else {
                Axios.post('/api/rewards/' + this.currentReward.id, data)
                    .then(result => {
                        this.$store.commit('updateReward', result.data);
                        this.$emit('reward-submit');
                        this.$refs.modal.hide();
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
            currentReward: this.getReward()
        }
    }
};

</script>
