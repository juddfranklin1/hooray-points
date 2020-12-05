<template>
    <t-modal
        ref="modal"
        @closed="onClose"
        @update-user="$refs.modal.hide()"
    >
        {{ action }}
        <template v-slot:header>
            <h2 class="text-xl">{{ currentAction ? currentAction.name : 'New Action' }}</h2>
        </template>
        <form action="new-action" class="my-4" @submit.prevent="onSubmit($event)" method="post">
            <div class="flex flex-col">
                <label class="text-lg pt-4" for="action_name">Name</label>
                <t-input
                    required
                    :value="currentAction ? currentAction.name : ''"
                    name="name" />
                <label class="text-lg pt-4" for="action_description">Description</label>
                <t-textarea
                    name="description"
                    :value="currentAction ? currentAction.description : ''"
                    id="action_description" />
                <label class="text-lg pt-4" for="action_value">Value</label>
                <t-input
                    required
                    type="number"
                    name="value"
                    :value="currentAction ? currentAction.value : 1"
                    id="action_value" />
                <label class="text-lg pt-4" for="action_user">Assigned User (if any)</label>
                <t-select
                    name="assignee_id"
                    :value="currentAction ? currentAction.assignee_id : null"
                    :options="[
                        {
                            name: 'unassigned',
                            id: null
                        },
                        ...users
                    ]"
                    value-attribute="id"
                    text-attribute="name"
                    id="action_user" />
                <button class="border-2 border-gray-200 py-2 px-4 my-4" type="submit">{{ currentAction ? 'Update' : 'Create' }}</button>
            </div>
        </form>
    </t-modal>
</template>

<script>
import Axios from 'axios';
import { mapState } from 'vuex';

export default {
    name: 'ActionForm',
    props: [
        'action'
    ],
    emits: [
        'action-submit'
    ],
    computed: {
        ...mapState({
            users: state => state.user.users,
            actions: state => state.action.actions,
        })
    },
    mounted(){
        this.$refs.modal.show();
    },
    methods: {
        onSubmit: function($e) {
            const data = {};
            data.name = $e.target.name.value;
            data.description = $e.target.description.value;
            data.value = $e.target.value.value;
            data.assignee_id = $e.target.assignee_id.value;
            if(!this.currentAction) {
                Axios.post('/api/actions', data)
                    .then(result => {
                        this.$store.commit('addAction', result.data);
                        $e.target.reset();
                        this.$emit('action-submit');
                        this.$refs.modal.hide();
                    }, error => console.log(error));
            } else {
                Axios.post('/api/actions/' + this.currentAction.id, data)
                    .then(response => {
                        this.$store.commit('updateAction', response.data);
                        this.$emit('action-submit');
                        this.$refs.modal.hide();
                    }, error => console.log(error));
            }
        },
        getAction: function() {
            return this.$store.getters.getActionById(Number.parseInt(this.$route.params.id))
        },
        // Force reroute back to main actions page from "edit-action" and "new-action" routes.
        // This ensures that the modal works seamlessly on the actions page, and is tied to the url
        onClose: function($e) {
            if(this.$route.name == 'new-action' | this.$route.name === 'edit-action'){
                this.$router.push('/actions');
            }
        }
    },
    data() {
        return {
            currentAction: this.getAction()
        }
    }
};

</script>
