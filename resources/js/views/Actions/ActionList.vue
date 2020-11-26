<template>
  <div class="my-4 py-3 relative">
    <h1 class="primary-headline">Actions</h1>
    <div class="py-2 px-4 border-2 border-gray-400 absolute top-0 right-0">
        <router-link
            to="/new-action"
            :user="users"
            v-slot="{ href, route, navigate, isActive, isExactActive }"
            >
            <a class="text-blue-400" :active="isActive" :href="href" @click="navigate"
                >New Action</a>
            </router-link>
    </div>
    <ul class="max-w-4xl">
        <ActionListItem v-for="action in actions" v-bind:key="'action-' + action.id" :action="action"></ActionListItem>
    </ul>
    <div class="mt-6 mb-4">
        <router-link
            to="/new-action"
            :users="users"
            v-slot="{ href, route, navigate, isActive, isExactActive }"
            >
            <a class="border-2 border-gray-400 py-2 px-4 text-blue-400" :active="isActive" :href="href" @click="navigate"
                >New Action</a>
            </router-link>
    </div>
  </div>
</template>
<script>
import ActionListItem from './ActionListItem.vue';
import { mapState, mapActions } from 'vuex';

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
