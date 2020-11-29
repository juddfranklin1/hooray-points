<template>
    <li class="flex flex-col flex-wrap mb-4 py-4 px-2 justify-content-start" >
        <t-card>
            <template v-slot:header>
                <b class="text-green-700 mb-3 font-bold uppercase" v-if="action.value > 0">
                    Score
                </b>
                <b class="text-red-700 font-bold uppercase" v-else>
                    Penalty
                </b>
            </template>

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

            <template v-slot:footer>
                <div class="flex justify-between">
                <t-button type="button" @click="alert('functionality not implemented yet');">
                    Edit
                </t-button>
                <t-button type="button" @click="deleteAction(action)">
                    Delete
                </t-button>
                </div>
            </template>
        </t-card>
    </li>
</template>
<script>

export default {
    name: 'ActionListItem',
    props: {
        action: Object
    },
    methods: {
        'alert': function(message){
            this.$dialog.alert({
                title: 'Sorry',
                text: message,
                icon: 'warning',
                // variant: 'my-alert',
                // ...More props
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
