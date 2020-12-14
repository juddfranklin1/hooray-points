<template>
  <div class="my-4 py-3 relative">
    <Heading :level="1" class-list="heading--primary">Users</Heading>

    <router-view></router-view>
  </div>
</template>
<script>
import Heading from '../components/Heading'

export default {
    name: 'UserIndex',
    components: {
        Heading
    }
}
</script>
