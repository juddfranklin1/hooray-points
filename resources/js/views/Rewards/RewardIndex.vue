<template>
  <div class="my-4 py-3 relative">
    <Heading :level="1" class-list="heading--primary">Rewards</Heading>
    <router-view name="modal"></router-view>
    <router-view></router-view>
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
