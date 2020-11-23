<template>
  <div class="px-4 my-4 py-3 relative">
    <h2 class="pb-4 text-xl font-bold">Actions</h2>
    <div class="py-2 px-4 border-2 border-gray-400 absolute top-0 right-0">
        <router-link
            to="/new-action"
            v-slot="{ href, route, navigate, isActive, isExactActive }"
            >
            <a class="text-blue-400" :active="isActive" :href="href" @click="navigate"
                >New Action</a>
            </router-link>
    </div>
    <ul>
        <li v-for="action in actions" v-bind:key="'action-' + action.id">
            <ActionListItem :action="action"></ActionListItem>
        </li>
    </ul>
    <div class="mt-6 mb-4">
        <router-link
            to="/new-action"
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
  props: {
      'actions': Array
  },
  components: {
      ActionListItem
  }
};
</script>
