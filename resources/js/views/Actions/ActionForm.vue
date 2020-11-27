<template>
    <t-modal
        ref="modal"
        @closed="onClose"
        @update-user="$refs.modal.hide()"
    >
        <template v-slot:header>
            What do you want to assign points to?
        </template>
        <form action="new-action" class="my-4" @submit.prevent="createAction($event)" method="post">
            <h2 class="text-3xl">Create a new action</h2>
            <div class="flex flex-col">
                <label class="text-lg pt-4" for="action_name">Name</label>
                <input required class="border-2 border-gray-200" type="text" name="name" id="action_name">
                <label class="text-lg pt-4" for="action_description">Description</label>
                <textarea class="border-2 border-gray-200" name="description" id="action_description"></textarea>
                <label class="text-lg pt-4" for="action_value">Value</label>
                <input required class="border-2 border-gray-200" type="number" name="value" id="action_value">
                <label class="text-lg pt-4" for="action_user">Assigned User (if any)</label>
                <select name="user" class="border-2 border-gray-200" id="action_user">
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
import { mapState, mapActions } from 'vuex';

export default {
    name: 'ActionForm',
    computed: {
        ...mapState({
            users: state => state.user.users,
        }),
    },
    mounted(){
        this.$refs.modal.show();
    },
    methods: {
        createAction: function($e) {
            const data = {};
            data.name = $e.target.name.value;
            data.description = $e.target.description.value;
            data.value = $e.target.value.value;
            data.user = $e.target.user.value;
            console.log('event');
            console.log($e.target);
            Axios.post('/api/action', data)
                .then(result => {
                    this.$store.commit('addAction', response.data);
                    $e.target.reset();
                }, error => console.log(error));
        },
        onClose: function($e) {// Force reroute back to main actions page from "new-action" route. This ensures that the modal works seamlessly on the actions page, and is tied to the url
            if(this.$route.name == 'new-action'){
                this.$router.push('actions');
            }
        }
    }
};

</script>
