import Tooltip from './Tooltip';
import { action } from '@storybook/addon-actions';

export default {
  title: 'Tooltip',
  component: Tooltip,
  // Our exports that end in "Data" are not stories.
  excludeStories: /.*Data$/,
};

  const Template = (args, { argTypes }) => ({
    components: { Tooltip },
    props: Object.keys(argTypes),
    template: `<Tooltip v-bind="$props">
        <template v-slot:title>A TITLE</template>
        <template v-slot:text>Lorem ipsum dolor sit amet.</template>
    </Tooltip>`,
  });

  export const Default = Template.bind({});
  Default.args = {
    tooltipEntry: {
      backgroundColor: 'gray',
    },
  };

  export const Action = Template.bind({});
  Action.args = {
      tooltipEntry: {
          backgroundColor: 'green',
      }
  }

  export const ActionPenalty = Template.bind({});
  ActionPenalty.args = {
      tooltipEntry: {
          backgroundColor: 'red',
      }
  }

  export const Reward = Template.bind({});
  Reward.args = {
      tooltipEntry: {
          backgroundColor: 'gold',
      }
  }

  export const Goal = Template.bind({});
  Goal.args = {
      tooltipEntry: {
          backgroundColor: 'blue',
      }
  }
