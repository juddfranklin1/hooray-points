<template>
<div class="flex flex-col flex-wrap mb-4 py-4 px-2" v-bind:class="action.value < 0 ? 'bg-red-100' : 'bg-green-100'">
        <b class="text-green-700 font-bold uppercase" v-if="action.value > 0">
        Incentive
        </b>
        <b class="text-red-700 font-bold uppercase" v-else>
            Penalty
        </b>
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
    </div>
</template>
<script>
export default {
    name: 'ActionListItem',
    props: {
        action: Object
    }
}
</script>
