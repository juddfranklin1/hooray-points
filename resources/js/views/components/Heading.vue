<script>
export default {
    name: 'Heading',
    props: {
        level: {
            type: Number,
            default: 1,
        },
        classList: {
            type: String,
            default: 'heading',
        },
    },
    render: function(h) {
        let levelClass = ''
        switch (this.level) {
            case 1:
                levelClass = 'one'
                break
            case 2:
                levelClass = 'two'
                break
            case 3:
                levelClass = 'three'
                break
            case 4:
                levelClass = 'four'
                break
            case 5:
                levelClass = 'five'
                break
            case 6:
                levelClass = 'six'
                break
            default:
                levelClass = 'standard'
        }
        return h(
            'h' + this.level,
            {
                class: this.classList + ' heading--' + levelClass
            },
            this.$slots.default
        )
    }
}
</script>
