<template>
  <div class="my-4 py-3 relative">
    <Heading :level="1" class-list="heading--primary">Actions</Heading>
    <router-link
        :to="{ name: 'new-action' }"
        :users="users"
        v-slot="{ href, navigate, isActive }"
        >
        <a class="trigger-button" :active="isActive" :href="href" @click="navigate"
            >New Action</a>
    </router-link>
    <router-view></router-view>
    <router-view name="modal"></router-view>
  </div>
</template>
<script>
import { mapState } from 'vuex'
import Heading from '../components/Heading'

export default {
    name: 'ActionIndex',
    components: {
        Heading
    },
    computed: {
        ...mapState({
            users: state => state.user.users,
            actions: state => state.action.actions,
            rewards: state => state.reward.rewards,
        }),
    },
}
</script>
