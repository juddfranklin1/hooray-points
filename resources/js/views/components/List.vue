<template>
    <div class="list">
        <h2>{{ ListTitle }}</h2>
        <ul>
            Conditionally load the proper ListItem Component, or pass data to a generic ListItem component
        </ul>
    </div>
</template>
<script>
import ListItem from './ListItem.vue';

export default {
    components: [
        'ListItem'
    ],
    name: "List",
    props: {
        listEntries: Array,
        listType: String,
        listTitle: String
    }
}
</script>
