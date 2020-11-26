<template>
<div :id="'user-card-' + currentUser.id" class="relative my-4 p-3 border-4 border-light-blue-500" v-bind:class="isExpanded ? 'expanded' : ''">
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
    <transition
        name="accordion"
        mode="out-in"
        v-on:before-enter="beforeEnter"
        v-on:enter="enter"
        v-on:before-leave="beforeLeave"
        v-on:leave="leave"
    >
        <div class="accordion" v-if="isExpanded">
            <ul v-if="currentUser.actions.length > 0">
                <li v-for="(action, index) in currentUser.actions" v-bind:key="'user-'+ currentUser.id + '-action-' + action.id + '-' + index">
                    <b>{{ action.pivot.human_date }}</b>: {{ action.name }} ({{ action.value }} points) x {{ action.pivot.multiplier }}
                </li>
            </ul>

            <t-button
                @click="showActionForm=true"
                classes="text-white bg-blue-600 hover:bg-blue-500 focus:border-blue-700 active:bg-blue-700 text-sm font-medium border border-transparent px-3 py-2 rounded-md"
            >
                {{ currentUser.name }} did something!
            </t-button>
            <t-modal
                ref="modal"
                v-model="showActionForm"
                @update-user="$refs.modal.hide()"
                >
                <template v-slot:header>
                    What did {{ currentUser.name }} Do?
                </template>
                <UserAddActionForm @update-user="updateUser" :user="currentUser"></UserAddActionForm>
            </t-modal>
        </div>
    </transition>
    <div class="absolute top-2 right-2 flex align-middle">
        <template v-if="isExpanded">Shrink</template>
        <template v-else>Expand</template>
        <t-toggle
            v-model="isExpanded"
        />
    </div>
</div>
</template>
<script>
import { mapState } from 'vuex';
import store from '../../store/';
import Axios from 'axios';
import UserAddActionForm from './UserAddActionForm.vue';

export default {
  components: { UserAddActionForm },
    name: 'UserListItem',
    props: {
        user: Object
    },
    data() {
        return {
            currentUser: this.user,
            expanded: false,
            showActionForm: false
        }
    },
    computed: {
        ...mapState({
            users: state => state.user.users,
            actions: state => state.action.actions,
            rewards: state => state.reward.rewards,
        }),
        isExpanded: {
            get() {
                if(window.location.hash.indexOf('user-card-') != -1) {
                    console.log(window.location.hash.substring(11));
                }
                return this.expanded;
            },
            set(val) {
                this.expanded = val;
            }
        },
    },
    methods: {
        updateUser: function(newUser) {
            this.currentUser = newUser;
            this.$refs.modal.hide();
        },
        beforeEnter: function(el) {
        el.style.height = '0';
        },
        enter: function(el) {
        el.style.height = el.scrollHeight + 'px';
        },
        beforeLeave: function(el) {
        el.style.height = el.scrollHeight + 'px';
        },
        leave: function(el) {
        el.style.height = '0';
        }
    }

}
</script>
<style scoped>
   .accordion {
       transition: height .2s ease-in-out;
       overflow: hidden;
   }
</style>
