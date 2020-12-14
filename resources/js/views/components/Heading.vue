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

<style>
    .heading--standard {
        @apply font-bold;
    }
    .heading--one {
        @apply heading--standard my-4 text-3xl;
    }
    .heading--two {
        @apply heading--standard my-3 text-2xl;
    }
    .heading--three {
        @apply heading--standard my-2 text-xl;
    }
    .heading--four {
        @apply heading--standard text-lg;
    }
    .heading--five {
        @apply heading--standard text-base;
    }
    .heading--six {
        @apply heading--standard text-sm;
    }
</style>
