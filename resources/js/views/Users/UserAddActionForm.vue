<template>
    <form action="post" @submit.prevent="pickAction($event)" class="border-2 my-3 py-3 px-6 flex flex-col">
        <h3 class="text-2xl pb-4">Add an Action</h3>
        <label for="pick_an_action" class="mt-3 text-lg">What did {{ currentUser.name }} do?</label>
        <select class="px-4 mb-2 py-2 border-2" name="pick_an_action" id="pick_an_action">
            <option v-for="actionOpt in actions" v-bind:key="'action-option-' + actionOpt.id" :value="actionOpt.id">{{ actionOpt.name }}: {{ actionOpt.value }}pts</option>
        </select>
        <label for="action_count" class="mt-3 text-lg">How Many Times did {{ currentUser.name }} do it?</label>
        <input class="mb-2 border-2 py-2 px-4" type="number" name="multiplier" id="action_count" min="1" value="1">
        <button class="px-4 py-2 border-2 hover:bg-gray-200 hover:text-green-400 border-gray-200" type="submit">Add</button>
    </form>
</template>
<script>
import Axios from 'axios';

export default {
    name: 'UserAddActionForm',
    props: {
        user: Object,
        actions: Array
    },
    emits: [
        'update-user'
    ],
    methods: {
        pickAction($e) {
            const actionSelect = $e.target.querySelector('#pick_an_action');
            const multiplier = $e.target.querySelector('#action_count');
            const userId = this.currentUser.id;
            Axios.put('/api/user/' + userId + '/addAction/' + actionSelect.value, { multiplier: multiplier.value})
                .then(
                    response => {
                        this.currentUser = response.data;
                        this.$emit('update-user', this.currentUser);
                    },
                    error => console.log(error));
        }
    },
    data() {
        return {
            currentUser: this.user
        }
    }
}
</script>
