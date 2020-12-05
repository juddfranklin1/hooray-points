
<template>
    <div class="my-4 py-3 relative flex flex-col">
        <h1 class="primary-headline">Welcome to Hooray!</h1>
        <h2 class="my-4 text-xl">This is the place to keep track of what you've done and what you get for it.</h2>
        <t-table
            :headers="[
                'Name',
                'Email',
                'Penalties Total',
                'Scores Total',
                'Point Total',
                ''
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
                    <td :class="props.tdClass" class="text-red-600 font-bold">
                        {{ props.row.penalties_total }}
                    </td>
                    <td :class="props.tdClass" class="text-green-600 font-bold">
                        {{ props.row.scores_total }}
                    </td>
                    <td :class="props.tdClass" class="text-gold-600 font-bold">
                        {{ props.row.point_total }}
                    </td>
                    <td :class="props.tdClass">
                        <t-button variant="secondary" class="trigger-button" @click="alert('functionality not implemented yet');" type="button">Edit</t-button>
                        <t-button variant="secondary" class="trigger-button" @click="alert('functionality not implemented yet');" type="button">See on Calendar</t-button>
                    </td>
                </tr>
            </template>
        </t-table>
        <div class="my-4">
            <FullCalendar :options="calendarOptions" />
            <div id="tooltip" class="tooltip__container">
                <template v-if="tooltipVisible">
                    <Tooltip
                        :tooltipEvent="activeEvent"
                    >
                        <template v-slot:title>{{ tooltipData.title }}</template>
                        <template v-slot:text>{{ tooltipData.text }}</template>
                    </Tooltip>
                </template>
            </div>

        </div>
    </div>
</template>
<script>
import { mapState } from 'vuex';
import store from '../store/';
import Tooltip from './components/Tooltip';
import FullCalendar, { formatDate } from '@fullcalendar/vue';
import dayGridPlugin from '@fullcalendar/daygrid';
import { createPopper } from '@popperjs/core';// Popperjs v2

export default {
    name: 'Home',
    computed: {
        ...mapState({
            users: state => state.user.users.map((user) => {
                console.log(user);
                return {
                    id: user.id,
                    name: user.name,
                    email: user.email,
                    point_total: user.point_total,
                    penalties_total: user.penalties_total,
                    scores_total: user.scores_total,
                }

            }),
            actions: state => state.action.actions,
            rewards: state => state.reward.rewards,
            userActions: state => state.userAction.userActions,
            userRewards: state => state.userReward.userRewards,
        }),
    },
    components: {
        FullCalendar,
        Tooltip
    },
    data() {
        const userActs = this.$store.state.userAction.userActions.map(userAct => {
            const timeWord = userAct.multiplier === 1 ? 'time' : 'times';
            return {
                title: userAct.user.name + ' did ' + userAct.action.name + ' ' + userAct.multiplier + ' ' + timeWord + '.',
                date: userAct.created_at,
                color: userAct.action.value < 0 ? 'red' : 'green',
                classNames: ['hooray-event', 'action'],
            }
        });
        const userRewards = this.$store.state.userReward.userRewards.map(userRew => {
            return {
                title: userRew.user.name + ' claimed ' + userRew.multiplier + ' of ' + userRew.reward.title,
                date: userRew.created_at,
                color: 'gold',
                classNames: ['hooray-event', 'reward'],
            }
        });
        const userGoals = this.$store.state.userGoal.userGoals.map(userGl => {
            return {
                title: userGl.user.name + ' aims to achieve ' + userGl.goal.name,
                date: userGl.created_at,
                color: 'blue',
                classNames: ['hooray-event', 'goal']
            }
        });
        return {
            calendarOptions: {
                eventMouseEnter: this.handleEventMouseEnter,
                eventMouseLeave: this.handleEventMouseLeave,
                plugins: [dayGridPlugin],
                initialView: 'dayGridMonth',
                events: [...userActs, ...userRewards, ...userGoals]
            },
            tooltipVisible: false,
            tooltipData: {
                title:'',
                text: ''
            },
            activeEvent: {},
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
        'handleEventMouseEnter': function(arg) {
            this.tooltipVisible = true;
            this.activeEvent = arg.event.toPlainObject();
            this.tooltipData.text = this.activeEvent.title;
            const eventDate = formatDate(this.activeEvent.start, {
                month: 'long',
                year: 'numeric',
                day: 'numeric',
            });
            this.tooltipData.title = eventDate;
            const tooltip = document.querySelector('#tooltip');
            createPopper(arg.el, tooltip, {
                placement: "right",
                modifiers: [
                    {
                    name: 'offset',
                    options: {
                        offset: [-20,10],
                    },
                    },
                ],
            });
        },
        'handleEventMouseLeave': function(arg) {
            this.tooltipVisible = false;
        }
    }

}
</script>
<style>
    #tooltip {
        width: 200px;
        z-index: 1000;
    }
    .primary-headline {
        @apply my-4 text-3xl;
    }
</style>
