<template>
    <form action="new-action" class="my-4" @submit.prevent="createAction($event)" method="post">
        <h2 class="text-3xl">Create a new action</h2>
        <div class="flex flex-col">
            <label class="text-lg pt-4" for="action_name">Name</label>
            <input class="border-2 border-gray-200" type="text" name="name" id="action_name">
            <label class="text-lg pt-4" for="action_description">Description</label>
            <textarea class="border-2 border-gray-200" name="description" id="action_description"></textarea>
            <label class="text-lg pt-4" for="action_value">Value</label>
            <input class="border-2 border-gray-200" type="number" name="value" id="action_value">
            <label class="text-lg pt-4" for="action_user">Assigned User (if any)</label>
            <select name="user" class="border-2 border-gray-200" id="action_user">
                <option value="">unassigned</option>
                <option v-for="user in users" :value="user.id" v-bind:key="'user-' + user.id">{{ user.name }}</option>
            </select>
            <button class="border-2 border-gray-200 py-2 px-4 my-4" type="submit">Create</button>
        </div>
    </form>
</template>

<script>
import Axios from 'axios';

export default {
    name: 'ActionForm',
    props: {
      'users': Array
    },
    methods: {
        createAction: function($e) {
            const data = {};
            data.name = $e.target.name.value;
            data.description = $e.target.description.value;
            data.value = $e.target.value.value;
            data.user = $e.target.user.value;
            Axios.post('/api/action', data)
                .then(result => console.log(result.data), error => console.log(error));
        }
    }
};

</script>
