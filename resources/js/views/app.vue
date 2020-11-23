<template>
  <div class="px-4 py-4 w-full">
    <p>
        <router-link :to="{ name: 'users' }"><span class="hover:no-underline underline text-blue-400">Users</span></router-link> |
        <router-link :users="users" :to="{ name: 'actions' }"><span class="hover:no-underline underline text-blue-400">Actions</span></router-link> |
        <router-link :users="users" :to="{ name: 'rewards' }"><span class="hover:no-underline underline text-blue-400">Rewards</span></router-link>
    </p>
    <router-view :rewards="rewards" :actions="actions" :users="users"></router-view>
  </div>
</template>
<script>
const default_layout = "default";

export default {
  props: {
      'users': Array,
      'actions': Array,
      'rewards': Array,
  }
};
</script>
