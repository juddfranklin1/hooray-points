<template>
  <div class="my-4 py-3 relative">
    <h1 class="primary-headline">Actions</h1>
    <router-link
        to="actions/new"
        :users="users"
        v-slot="{ href, navigate, isActive }"
        >
        <a class="trigger-button" :active="isActive" :href="href" @click="navigate"
            >New Action</a>
    </router-link>
    <router-view></router-view>
    <ul class="max-w-4xl">
        <ActionListItem v-for="action in actions" v-bind:key="'action-' + action.id" :action="action" :users="users"></ActionListItem>
    </ul>
    <div class="mt-6 mb-4">
        <router-link
            to="actions/new"
            :users="users"
            v-slot="{ href, navigate, isActive }"
            >
            <a class="trigger-button" :active="isActive" :href="href" @click="navigate"
                >New Action</a>
            </router-link>
    </div>
  </div>
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
