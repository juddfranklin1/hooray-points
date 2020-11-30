<template>
    <li class="flex flex-col flex-wrap mb-4 py-4 px-2 justify-content-start" >
        <t-card>
            <template v-slot:header>
                <b class="text-green-700 mb-3 font-bold uppercase" v-if="reward.cost > 0">
                    Reward{{ reward.assignee ? ' assigned to ' + reward.assignee.name : ''}}
                </b>
            </template>

            <dt class="pr-3">
                <b class="text-xl">{{ reward.title }}</b>
            </dt>
            <dd>Costs {{ reward.cost }} points</dd>
            <span v-if="reward.assignee">
                <template v-if="reward.cost > 0">
                    This is a special reward to be earned by {{ reward.assignee.name }}
                </template>
                <template v-else>
                    This is something that {{ reward.assignee.name }} should try not to do.
                </template>
            </span>
            <p class="w-full"><b class="font-bold">Description: </b>{{ reward.description }}</p>

            <template v-slot:footer>
                <div class="flex justify-between">
                <router-link
                    :to="{ name: 'edit-reward', params: { id: reward.id }}"
                    v-slot="{ href, navigate, isActive }"
                    >
                    <a class="trigger-button" :active="isActive" :href="href" @click="navigate"
                        >Edit</a>
                </router-link>
                <t-button type="button" variant="danger" @click="deleteReward(reward)">
                    Delete
                </t-button>
                </div>
            </template>
        </t-card>
    </li>
</template>
<script>
export default {
    name: 'RewardListItem',
    props: {
        reward: Object
    },
    methods: {
        'alert': function(message){
            window.alert(message);
        },
        'deleteReward': function(reward){
            this.$store.dispatch('deleteReward', { reward });
        }
    }
}
</script>
