<template>
    <li class="flex flex-col flex-wrap mb-4 py-4 px-2 justify-content-start" >
        <v-card>
            <v-card-title>
                <b class="text-green-700 mb-3 font-bold uppercase" v-if="reward.cost > 0">
                    Reward{{ reward.assignee ? ' assigned to ' + reward.assignee.name : ''}}
                </b>
            </v-card-title>
            <v-card-subtitle>
                <h4>{{ reward.title }}</h4>
            </v-card-subtitle>
            <v-card-text>
                <p>Costs {{ reward.cost }} points</p>
                <span v-if="reward.assignee">
                    <template v-if="reward.cost > 0">
                        This is a special reward to be earned by {{ reward.assignee.name }}
                    </template>
                    <template v-else>
                        This is something that {{ reward.assignee.name }} should try not to do.
                    </template>
                </span>
                <p class="w-full"><b class="font-bold">Description: </b>{{ reward.description }}</p>
            </v-card-text>

            <v-card-actions>
                <div class="flex justify-between">
                <router-link
                    :to="{ name: 'edit-reward', params: { id: reward.id }}"
                    v-slot="{ href, navigate, isActive }"
                    >
                    <a class="trigger-button" :active="isActive" :href="href" @click="navigate"
                        >Edit</a>
                </router-link>
                <v-btn
                    color="error"
                    type="button"
                    @click="deleteReward(reward)">
                    Delete
                </v-btn>
                </div>
            </v-card-actions>
        </v-card>
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
