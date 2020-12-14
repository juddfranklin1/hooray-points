import Heading from './Heading'
import { action } from '@storybook/addon-actions'

export default {
  title: 'Heading',
  component: Heading,
  // Our exports that end in "Data" are not stories.
  excludeStories: /.*Data$/,
}

const Template = (args, { argTypes }) => ({
    components: { Heading },
    props: Object.keys(argTypes),
    template: `<Heading v-bind="$props">
    <slot>Heading</slot>
    </Heading>`,
})

export const Heading1 = Template.bind({})
Heading1.args = {
    level: 1,
}

export const Heading2 = Template.bind({})
Heading2.args = {
    level: 2,
}

export const Heading3 = Template.bind({})
Heading3.args = {
    level: 3,
}

export const Heading4 = Template.bind({})
Heading4.args = {
    level: 4,
}

export const Heading5 = Template.bind({})
Heading5.args = {
    level: 5,
}

export const Heading6 = Template.bind({})
Heading6.args = {
    level: 6,
}
