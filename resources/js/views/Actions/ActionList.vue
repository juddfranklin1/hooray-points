<template>
    <ul class="max-w-4xl">
        <ActionListItem v-for="action in actions" v-bind:key="'action-' + action.id" :action="action" :users="users"></ActionListItem>
    </ul>
</template>
<script>
import ActionListItem from './ActionListItem.vue';
import { mapState } from 'vuex';

export default {
    name: 'ActionList',
    computed: {
        ...mapState({
            users: state => state.user.users,
            actions: state => state.action.actions,
            rewards: state => state.reward.rewards,
        }),
    },
    components: {
        ActionListItem
    }
};
</script>
