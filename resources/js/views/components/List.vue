<template>
    <div class="list">
        <h2>{{ ListTitle }}</h2>
        <ul>
            <ListItem v-for="(listItem, index) in ListEntries" v-bind:key="index">
                <slot name="content">{{ listItem.content }}</slot>
            </ListItem>
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
