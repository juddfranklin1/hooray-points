<template>
    <t-modal
        ref="modal"
        @closed="onClose"
        @update-user="$refs.modal.hide()"
    >
        <template v-slot:header>
            What reward do you want to set up?
        </template>
        <form action="new-reward" class="my-4" @submit.prevent="createReward($event)" method="post">
            <h2 class="text-3xl">Create a new reward</h2>
            <div class="flex flex-col">
                <label class="text-lg pt-4" for="reward_title">Title</label>
                <input required class="border-2 border-gray-200" type="text" name="title" id="reward_title">
                <label class="text-lg pt-4" for="reward_description">Description</label>
                <textarea class="border-2 border-gray-200" name="description" id="reward_description"></textarea>
                <label class="text-lg pt-4" for="reward_cost">Cost</label>
                <input required class="border-2 border-gray-200" type="number" name="cost" id="reward_cost">
                <label class="text-lg pt-4" for="reward_user">Assigned User (if any)</label>
                <select name="assignee_id" class="border-2 border-gray-200" id="reward_user">
                    <option value="">unassigned</option>
                    <option v-for="user in users" :value="user.id" v-bind:key="'user-' + user.id">{{ user.name }}</option>
                </select>
                <button class="border-2 border-gray-200 py-2 px-4 my-4" type="submit">Create</button>
            </div>
        </form>
    </t-modal>
</template>

<script>
import Axios from 'axios';

export default {
    name: 'RewardForm',
    props: {
      'users': Array
    },
    mounted(){
        this.$refs.modal.show();
    },
    methods: {
        createReward: function($e) {
            const data = {};
            data.title = $e.target.title.value;
            data.assignee_id = $e.target.assignee_id.value;
            data.description = $e.target.description.value;
            data.cost = $e.target.cost.value;
            Axios.post('/api/reward', data)
                .then(response => {
                    this.$store.commit('addReward', response.data);
                    $e.target.reset();
                }, error => console.log(error));
        },
        onClose: function($e) {// Force reroute back to main actions page from "new-action" route. This ensures that the modal works seamlessly on the actions page, and is tied to the url
            if(this.$route.name == 'new-reward'){
                this.$router.push('rewards');
            }
        }
    }
};

</script>
