<template>
<p>
    <b>{{ action.name }}</b> ({{ action.value }} points)
</p>
</template>
<script>
export default {
    name: 'ActionListItem',
    props: {
        action: Object
    }
}
</script>
