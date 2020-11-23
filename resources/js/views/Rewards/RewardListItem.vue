<template>
    <div>
        <dt>
            <b>{{ reward.title }}</b>
        </dt>
        <dd>{{ reward.cost }} points</dd>
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
