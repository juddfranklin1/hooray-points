<template>
  <div class="px-4 py-4">
    <h2 class="text-xl font-bold">Action Overview</h2>
    <div v-if="loading" class="loading">
      Loading...
    </div>
    <div v-if="action">
        <h2>Name: {{ action.name }}</h2>
        <p>{{ action.description }}</p>
    </div>
  </div>
</template>
<script>
import UserListItem from '../Users/UserListItem.vue';
import UserAddActionForm from '../Users/UserAddActionForm.vue';
import Axios from 'axios';

export default {
  data () {
    return {
      loading: false,
      action: null,
      error: null
    }
  },
  created () {
    // fetch the data when the view is created and the data is
    // already being observed
    this.fetchData()
  },
  name: 'ActionSingle',
  methods: {
    fetchData () {
      this.error = this.action = null
      this.loading = true
      const fetchedId = this.$route.params.id
      Axios.get('/api/actions/' + fetchedId)
        .then( response => {
            this.loading = false;
            this.action = response.data
        }, error => {
            this.loading = false;
            this.error = error
        });
    },
  }
};
</script>
