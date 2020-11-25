<template>
<div class="my-4 p-3 border-4 border-light-blue-500">
    <h3>
        <router-link
            :to="{name: 'user', params: { id: currentUser.id }}"
            v-slot="{ href, route, navigate, isActive, isExactActive }"
            >
            <a class="text-blue-400" :active="isActive" :href="href" @click="navigate"
                >{{ currentUser.name }}</a>
            </router-link>
         has {{ currentUser.point_total }} points.
    </h3>
    <ul v-if="currentUser.actions.length > 0">
        <li v-for="(action, index) in currentUser.actions" v-bind:key="'user-'+ currentUser.id + '-action-' + action.id + '-' + index">
            <b>{{ action.pivot.human_date }}</b>: {{ action.name }} ({{ action.value }} points) x {{ action.pivot.multiplier }}
        </li>
    </ul>
    <UserAddActionForm @update-user="updateUser" :actions="actions" :user="currentUser"></UserAddActionForm>
</div>
</template>
<script>
import Axios from 'axios';
import UserAddActionForm from './UserAddActionForm.vue';

export default {
  components: { UserAddActionForm },
    name: 'UserListItem',
    props: {
        user: Object,
        actions: Array,
        rewards: Array
    },
    data() {
        return {
            currentUser: this.user
        }
    },
    methods: {
        updateUser: function(newUser) {
            this.currentUser = newUser;
        }
    }

}
</script>
