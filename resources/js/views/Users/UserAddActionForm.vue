<template>
    <form action="post" @submit.prevent="pickAction($event)" class="border-2 my-3 py-3 px-6 flex flex-col">
        <label for="pick_an_action" class="mt-3 text-lg">What did {{ currentUser.name }} do?</label>
        <v-select
            outlined
            name="pick_an_action"
            id="pick_an_action"
            value-attribute="id"
            text-attribute="name"
            v-model="chosenAction"
            :items="[
                ...actions
            ]" />
        <label for="action_count" class="mt-3 text-lg">How Many Times did {{ currentUser.name }} do it?</label>
        <v-text-field
            outlined
            type="number"
            name="multiplier"
            id="action_count"
            min="1"
            value="1" />
        <v-btn
            color="primary"
            type="submit">Add</v-btn>
    </form>
</template>
<script>

import { mapState } from 'vuex';
import store from '../../store/';
import Axios from 'axios';

export default {
    name: 'UserAddActionForm',
    props: {
        user: Object
    },
    emits: [
        'update-user'
    ],
    methods: {
        pickAction($e) {
            const multiplier = $e.target.querySelector('#action_count');
            const userId = this.currentUser.id;
            Axios.put('/api/users/' + userId + '/attachAction/' + this.chosenAction, {
                multiplier: multiplier.value
            })
                .then(
                    response => {
                        this.currentUser = response.data;
                        this.$store.commit('updateUser', this.currentUser);
                        this.$emit('update-user', this.currentUser);
                    },
                    err => console.error(err));
        }
    },
    computed: {
        ...mapState({
            users: state => state.user.users,
            actions: state => {
                return state.action.actions.map(action => {
                    return {
                        text: action.name + ': ' + action.value + 'pts',
                        value: action.id
                    }
                })
            },
            rewards: state => state.reward.rewards,
        })
    },
    data() {
        return {
            currentUser: this.user,
            chosenAction: null
        }
    }
}
</script>
