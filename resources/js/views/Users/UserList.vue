<template>
  <div class="my-4 py-3 relative">
    <div>
        <ul>
            <li v-for="user in users" v-bind:key="'user-' + user.id">
                <UserListItem :user="user"></UserListItem>
            </li>
        </ul>
    </div>
    </div>
</template>
<script>
import { mapState } from 'vuex';
import store from '../../store/';
import UserListItem from './UserListItem.vue';

export default {
    name: 'UserList',
    computed: {
        ...mapState({
            users: state => state.user.users,
            actions: state => state.action.actions,
            rewards: state => state.reward.rewards,
        }),
    },
    components: {
        UserListItem
    }
};
</script>
