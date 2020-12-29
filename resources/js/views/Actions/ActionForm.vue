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
            New Action
            </v-btn>
        </template>
        <v-card>
            <v-card-title>
                {{ $route.name === 'edit-action' ? 'Edit Action' : 'New Action' }}
            </v-card-title>
            <v-card-text>
                <v-container>
                    <v-row>
                        <form action="new-action" class="my-4" @submit.prevent="onSubmit($event)" method="post">
                            <div class="flex flex-col">
                                <label class="text-lg pt-4" for="action_name">Name</label>
                                <v-text-field
                                    outlined
                                    required
                                    :value="currentAction ? currentAction.name : ''"
                                    name="name" />
                                <label class="text-lg pt-4" for="action_description">Description</label>
                                <v-textarea
                                    outlined
                                    name="description"
                                    :value="currentAction ? currentAction.description : ''"
                                    id="action_description" />
                                <label class="text-lg pt-4" for="action_value">Value</label>
                                <v-text-field
                                    outlined
                                    required
                                    type="number"
                                    name="value"
                                    :value="currentAction ? currentAction.value : 1"
                                    id="action_value" />
                                <label class="text-lg pt-4" for="action_user">Assigned User (if any)</label>
                                <v-select
                                    outlined
                                    name="assignee_id"
                                    :value="currentAction ? currentAction.assignee_id : null"
                                    :items="[
                                        {
                                            text: 'unassigned',
                                            value: ''
                                        },
                                        ...users
                                    ]"
                                    value-attribute="id"
                                    text-attribute="name"
                                    id="action_user" />
                                <v-btn
                                    color="primary"
                                    dark
                                    class="border-2 border-gray-200 py-2 px-4 my-4"
                                    type="submit">
                                    {{ currentAction ? 'Update' : 'Create' }}
                                </v-btn>
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
    name: 'ActionForm',
    props: [
        'action'
    ],
    emits: [
        'action-submit'
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
            actions: state => state.action.actions,
        })
    },
    mounted(){
        console.log(this.$route);
        if(this.$route.name == 'new-action' | this.$route.name === 'edit-action'){
            this.modal = true
        }
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
                        this.modal = false;
                    }, error => console.log(error));
            } else {
                Axios.post('/api/actions/' + this.currentAction.id, data)
                    .then(response => {
                        this.$store.commit('updateAction', response.data);
                        this.$emit('action-submit');
                        this.modal = false;
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
            currentAction: this.getAction(),
            modal: false
        }
    }
};

</script>
