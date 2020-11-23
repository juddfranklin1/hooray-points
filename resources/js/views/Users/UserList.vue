<template>
  <div class="px-4 py-4">
    <h2 class="text-xl hover:bg-red-700 hover:text-white font-bold">Users</h2>
    <ul>
        <li v-for="user in users" v-bind:key="'user-' + user.id">
            <UserListItem :user="user" :actions="actions" :rewards="rewards"></UserListItem>
        </li>
    </ul>
  </div>
</template>
<script>
import UserListItem from './UserListItem.vue';

export default {
  name: 'UserList',
  props: {
      'users': Array,
      'actions': Array,
      'rewards': Array,
  },
  components: {
      UserListItem
  }
};
</script>
