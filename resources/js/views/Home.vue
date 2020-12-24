
<template>
    <div class="my-4 py-3 relative flex flex-col">
        <Heading :level="1" class-list="heading--primary">Welcome to Hooray!</Heading>
        <Heading :level="2" class-list="heading--primary">This is the place to keep track of what you've done and what you get for it.</Heading>

        <t-table
            :headers="[
                'Name',
                'Email',
                'Penalties Total',
                'Scores Total',
                'Rewards Cost Total',
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
                        <div class="flex justify-center align-items-center">
                            {{ props.row.penalties_total }}
                        </div>
                    </td>
                    <td :class="props.tdClass" class="text-green-600 font-bold">
                        <div class="flex justify-center align-items-center">
                            {{ props.row.scores_total }}
                        </div>
                    </td>
                    <td :class="props.tdClass" class="text-green-600 font-bold">
                        <div class="flex justify-center align-items-center">
                            {{ props.row.rewards_cost_total }}
                        </div>
                    </td>
                    <td :class="props.tdClass" class="text-gold-600 font-bold">
                        <div class="flex justify-center align-items-center">
                            {{ props.row.point_total }}
                        </div>
                    </td>
                    <td :class="props.tdClass + ' flex justify-end align-items-center'">
                        <t-button
                            variant="secondary"
                            v-if="isLoggedIn && $store.state.auth.user.user.id === props.row.id"
                            class="trigger-button"
                            @click="alert('functionality not implemented yet');"
                            type="button">
                            <IconEdit width="18" height="18" />
                        </t-button>
                        <t-button
                            variant="secondary"
                            class="trigger-button"
                            @click="filterEventsByUserId(props.row.id)"
                            type="button"
                            aria-label="See on Calendar">
                            <IconCalendar width="18" height="18" />
                        </t-button>
                    </td>
                </tr>
            </template>
        </t-table>
        <div class="my-4">
            <a href="#reset" @click="getEvents()">See All Events</a>
            <FullCalendar ref="fullCalendar" :options="calendarOptions" />
            <div id="tooltip" class="tooltip__container">
                <template v-if="tooltipVisible">
                    <Tooltip
                        :tooltip-entry="tooltipData"
                    >
                        <template v-slot:label>{{ tooltipData.label }}</template>
                        <template v-slot:title>{{ tooltipData.title }}</template>
                        <template v-slot:text>{{ tooltipData.text }}</template>
                    </Tooltip>
                </template>
            </div>

        </div>
    </div>
</template>
<script>
import store from '../store/';
import { mapState, mapGetters } from 'vuex';
import Heading from './components/Heading';
import Tooltip from './components/Tooltip';
import IconCalendar from './components/icons/Calendar';
import IconEdit from './components/icons/Edit';
import FullCalendar, { formatDate } from '@fullcalendar/vue';
import dayGridPlugin from '@fullcalendar/daygrid';
import { createPopper } from '@popperjs/core';// Popperjs v2

export default {
    name: 'Home',
    computed: {
        ...mapState({
            users: state => state.user.users.map((user) => {
                return {
                    id: user.id,
                    name: user.name,
                    email: user.email,
                    point_total: user.point_total,
                    penalties_total: user.penalties_total,
                    rewards_cost_total: user.rewards_cost_total,
                    scores_total: user.scores_total,
                }

            }),
            actions: state => state.action.actions,
            rewards: state => state.reward.rewards,
            userActions: state => state.userAction.userActions,
            userRewards: state => state.userReward.userRewards,
        }),
        ...mapGetters([
            'isLoggedIn'
        ])
    },
    components: {
        FullCalendar,
        Tooltip,
        Heading,
        IconCalendar,
        IconEdit,
    },
    data() {
        return {
            calendarOptions: {
                eventMouseEnter: this.handleEventMouseEnter,
                eventMouseLeave: this.handleEventMouseLeave,
                plugins: [dayGridPlugin],
                initialView: 'dayGridMonth',
                events: this.constructEvents(),
            },
            tooltipVisible: false,
            tooltipData: {
                title:'',
                text: '',
                textColor: '',
                label: '',
                backgroundColor: 'gray'
            },
            activeEvent: {},
            currentEvents: this.constructEvents()
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
            this.tooltipData.backgroundColor = this.activeEvent.backgroundColor;
            this.tooltipData.textColor = this.activeEvent.extendedProps.textColor;
            const eventDate = formatDate(this.activeEvent.start, {
                month: 'long',
                year: 'numeric',
                day: 'numeric',
            });
            this.tooltipData.label = eventDate
            this.tooltipData.title = this.activeEvent.extendedProps.eventType
            const tooltip = document.querySelector('#tooltip')
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
            this.tooltipVisible = false
        },
        'filterEventsByUserId': function(ids) {
            let events = this.constructEvents().filter(ev => {
                if(Array.isArray(ids)) {
                    return ids.includes(ev.extendedProps.userId)
                } else {
                    return ids === ev.extendedProps.userId
                }
            });
            this.calendarOptions.events = events
        },
        'resetEvents': function() {
            this.getEvents()
        },
        'getEvents': function(events) {
            this.currentEvents = this.calendarOptions.events = events ?? this.constructEvents()
        },
        'constructEvents': function() {
            const userActEvents = this.$store.state.userAction.userActions.map(userAct => {
                const timeWord = userAct.multiplier === 1 ? 'time' : 'times';
                return {
                    title: userAct.user.name + ' did ' + userAct.action.name + ' ' + userAct.multiplier + ' ' + timeWord + '.',
                    date: userAct.created_at,
                    color: userAct.action.value < 0 ? 'red' : 'green',
                    classNames: ['hooray-event', 'action'],
                    extendedProps: {
                        eventType: userAct.action.value < 0 ? 'Penalty: ' + userAct.action.value : 'Score: ' + userAct.action.value,
                        textColor: userAct.action.value < 0 ? 'white' : 'gray-900',
                        userId: userAct.user.id
                    }
                }
            });
            const userRewardEvents = this.$store.state.userReward.userRewards.map(userRew => {
                return {
                    title: userRew.user.name + ' claimed ' + userRew.multiplier + ' of ' + userRew.reward.title,
                    date: userRew.created_at,
                    color: 'gold',
                    classNames: ['hooray-event', 'reward'],
                    extendedProps: {
                        eventType: 'Reward',
                        textColor: 'gray-900',
                        userId: userRew.user.id
                    }
                }
            });
            const userGoalEvents = this.$store.state.userGoal.userGoals.map(userGl => {
                return {
                    title: userGl.user.name + ' aims to achieve ' + userGl.goal.name,
                    date: userGl.created_at,
                    color: 'blue',
                    classNames: ['hooray-event', 'goal'],
                    extendedProps: {
                        eventType: 'Goal',
                        textColor: 'white',
                        userId: userGl.user.id
                    }
                }
            })
            return [...userActEvents, ...userRewardEvents, ...userGoalEvents]
        }
    }

}
</script>
<style>
    #tooltip {
        width: 200px;
        z-index: 1000;
    }
</style>
