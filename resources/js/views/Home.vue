
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
                        <t-button variant="secondary" class="trigger-button" @click="alert('functionality not implemented yet');" type="button">Edit</t-button>
                    </td>
                </tr>
            </template>
        </t-table>
        <FullCalendar :options="calendarOptions" />
    </div>
</template>
<script>
import { mapState } from 'vuex';
import store from '../store/';
import FullCalendar from '@fullcalendar/vue';
import dayGridPlugin from '@fullcalendar/daygrid';


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
            userActions: state => state.userAction.userActions,
            userRewards: state => state.userReward.userRewards,
        }),
    },
    components: {
        FullCalendar
    },
    data() {
        const userActs = this.$store.state.userAction.userActions.map(userAct => {
                        const timeWord = userAct.multiplier === 1 ? 'time' : 'times';
                        return {
                            title: userAct.user.name + ' did ' + userAct.action.name + ' ' + userAct.multiplier + ' ' + timeWord + '.',
                            date: userAct.created_at,
                            color: userAct.action.value < 0 ? 'red' : 'green'
                        }
                    });
        const userRewards = this.$store.state.userReward.userRewards.map(userRew => {
                        return {
                            title: userRew.user.name + ' claimed ' + userRew.multiplier + ' of ' + userRew.reward.title,
                            date: userRew.created_at,
                            color: 'gold'
                        }
                    });
        return {
            calendarOptions: {
                plugins: [dayGridPlugin],
                initialView: 'dayGridMonth',
                events: [...userActs,...userRewards]
            }
        }
    },
    methods: {
        'alert': function(message){
            this.$dialog.alert({
                title: 'Sorry',
                text: message,
                icon: 'warning',
                // variant: 'my-alert',
                // ...More props
            }).then((result) => {
                //
            })
        },
    }

}
</script>
<style>
  .primary-headline {
    @apply my-4 text-3xl;
  }
</style>
