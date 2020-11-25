<template>
    <div class="flex flex-col flex-wrap mb-4">
        <dt class="pr-3">
            <b class="text-xl">{{ reward.title }}</b>
        </dt>
        <dd>worth {{ reward.cost }} points</dd>
        <span v-if="reward.assignee">
            This is a special reward to be earned by {{ reward.assignee.name }}
        </span>
        <p class="w-full"><b class="font-bold">Description: </b>{{ reward.description }}</p>
    </div>
</template>
<script>
export default {
    name: 'RewardListItem',
    props: {
        reward: Object
    }
}
</script>
