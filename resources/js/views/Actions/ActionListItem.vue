<template>
    <li class="flex flex-col flex-wrap mb-4 py-4 px-2 justify-content-start" >
        <v-card>
            <v-card-title>
                Action
            </v-card-title>
            <v-card-subtitle>
                <b class="text-green-700 mb-3 font-bold uppercase" v-if="action.value > 0">
                    Score
                </b>
                <b class="text-red-700 font-bold uppercase" v-else>
                    Penalty
                </b>
            </v-card-subtitle>

            <v-card-text>
                <dt class="pr-3">
                    <b class="text-xl">{{ action.name }}</b>
                </dt>
                <dd>worth {{ action.value }} points</dd>
                <span v-if="action.assignee">
                    <template v-if="action.value > 0">
                    This is something that {{ action.assignee.name }} should try to do.
                    </template>
                    <template v-else>
                        This is something that {{ action.assignee.name }} should try not to do.
                    </template>
                </span>
                <p class="w-full"><b class="font-bold">Description: </b>{{ action.description }}</p>
            </v-card-text>

            <v-card-actions>
                <div class="flex justify-between">
                    <router-link
                        :to="{ name: 'edit-action', params: { id: action.id }}"
                        :users="users"
                        :action="action"
                        v-slot="{ href, navigate, isActive }"
                        >
                        <a class="btn btn-primary trigger-button" :active="isActive" :href="href" @click="navigate"
                            >Edit</a>
                    </router-link>
                    <v-btn
                        color="error"
                        type="button"
                        @click="deleteAction(action)">
                        Delete
                    </v-btn>
                </div>
            </v-card-actions>
        </v-card>
    </li>
</template>
<script>

export default {
    name: 'ActionListItem',
    props: {
        action: Object,
        users: Array
    },
    methods: {
        'alert': function(message){
            this.$dialog.alert({
                title: 'Sorry',
                text: message,
                icon: 'warning',
            }).then((result) => {
            console.log(result)
            })
        },
        'deleteAction': function(action){
            this.$store.dispatch('deleteAction', { action });
        }
    },
}
</script>
