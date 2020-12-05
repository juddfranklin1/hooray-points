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
        <template v-slot:label>A label</template>
        <template v-slot:title>A TITLE</template>
        <template v-slot:text>Lorem ipsum dolor sit amet.</template>
    </Tooltip>`,
  });

  export const Default = Template.bind({});
  Default.args = {
    tooltipEntry: {
      backgroundColor: 'gray',
      label: 'A label'
    },
  };

  export const ActionScore = Template.bind({});
  ActionScore.args = {
      tooltipEntry: {
          backgroundColor: 'green',
          label: 'A label'
      }
  }

  export const ActionPenalty = Template.bind({});
  ActionPenalty.args = {
      tooltipEntry: {
          backgroundColor: 'red',
          label: 'A label'
      }
  }

  export const Reward = Template.bind({});
  Reward.args = {
      tooltipEntry: {
          backgroundColor: 'gold',
          label: 'A label'
      }
  }

  export const Goal = Template.bind({});
  Goal.args = {
      tooltipEntry: {
          backgroundColor: 'blue',
          label: 'A label'
      }
  }
