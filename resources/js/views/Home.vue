<template>
    <div class="my-4 py-3 relative flex flex-col">
        <h1 class="primary-headline">Welcome to Hooray!</h1>
        <h2 class="my-4 text-xl">This is the place to keep track of what you've done and what you get for it.</h2>
        <t-table
            :headers="[
                'Name',
                'Email',
                'Point Total'
            ]"
            :data="users">
            <template slot="row" slot-scope="props">
                <tr :class="[props.trClass, props.rowIndex % 2 === 0 ? 'bg-gray-100' : '']">
                    <td :class="props.tdClass">
                        <router-link
                            :to="{name: 'user', params: { id: props.row.id }}"
                            v-slot="{ href, navigate, isActive, isExactActive }"
                            >
                            <a class="text-blue-400" :active="isActive" :href="href" @click="navigate"
                                >{{ props.row.name }}</a>
                        </router-link>
                    </td>
                    <td :class="props.tdClass">
                        <a :href="`mailto: ${props.row.email}`">{{ props.row.email }}</a>
                    </td>
                    <td :class="props.tdClass">
                        {{ props.row.point_total }}
                    </td>
                    <td :class="props.tdClass">
                        <t-button variant="secondary">Edit</t-button>
                    </td>
                </tr>
            </template>
        </t-table>
    </div>
</template>
<script>
import { mapState } from 'vuex';
import store from '../store/';

export default {
    name: 'Home',
    computed: {
        ...mapState({
            users: state => state.user.users.map((user) => {
                return {
                    id: user.id,
                    name: user.name,
                    email: user.email,
                    point_total: user.point_total
                }

            }),
            actions: state => state.action.actions,
            rewards: state => state.reward.rewards,
        }),
    },
}
</script>
<style>
  .primary-headline {
    @apply my-4 text-3xl;
  }
</style>
