<template>
  <div class="my-4 py-3 relative">
    <Heading :level="1" class-list="heading--primary">Rewards</Heading>

    <router-link
        :to="{ name: 'new-reward' }"
        :users="users"
        v-slot="{ href, navigate, isActive }"
        >
        <a class="trigger-button" :active="isActive" :href="href" @click="navigate"
            >New Reward</a>
    </router-link>
    <router-view></router-view>
    <router-view name="modal"></router-view>
  </div>
</template>
<script>
import Heading from '../components/Heading'
import RewardForm from './RewardForm';
import { mapState } from 'vuex';

export default {
    name: 'RewardList',
    computed: {
        ...mapState({
            users: state => state.user.users,
        }),
    },
    components: {
        RewardForm,
        Heading
    }
};
</script>

<style>
.trigger-button {
    @apply p-3 text-blue-400 hover:text-blue-700 hover:border-gray-700;
}
</style>
