<template>
    <div class="tooltip">
        <div class="tooltip__wrapper flex flex-wrap">
            <div class="w-full text-center">
                <div ref="tooltipRef" v-bind:class="'bg-' + tooltipEvent.backgroundColor + '-600'" class="bg-gray-600 block border-0 mb-3 block z-50 font-normal leading-normal text-sm max-w-xs text-left no-underline break-words rounded-lg">
                    <div>
                        <div v-bind:class="'bg-' + tooltipEvent.backgroundColor + '-600'" class="text-white opacity-75 font-semibold p-3 mb-0 border-b border-solid border-gray-200 uppercase rounded-t-lg">
                            <slot name="title"></slot>
                    </div>
                        <div class="text-white p-3">
                            <slot name="text"></slot>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
  name: "tooltip",
  props: {
      tooltipEvent: {
          type: Object,
          default: {}
      }
  },
}
</script>
<style>
    .tooltip {
        position: relative;
    }
    .tooltip__wrapper {
        position:absolute;
        z-index: 10000;
    }
</style>
