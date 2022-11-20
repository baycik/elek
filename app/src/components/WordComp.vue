<template>
  <span @mouseover="detailsShow" @mouseout="detailsHide">{{chunk.data}}</span>
  <n-popover :show="showPopover" :x="x" :y="y" trigger="manual" style="width:200px">
    cool
    <n-progress
      type="line"
      :percentage="rank"
      :height="5"
      :border-radius="4"
    />
  </n-popover>
</template>
<script>
import { NPopover,NProgress } from 'naive-ui'
import { ref } from 'vue'
export default {
    props:['chunk'],
    components:{
        NPopover,
        NProgress
    },
    setup () {
        const xRef = ref(0)
        const yRef = ref(0)
        const showPopoverRef = ref(false)

        const detailsPlace = (e) => {
            if (showPopoverRef.value) {
                showPopoverRef.value = false
            } else {
                showPopoverRef.value = true
                xRef.value = e.clientX
                yRef.value = e.clientY
            }
        }
        let clock=null
        const detailsShow = (e) => {
            clearTimeout(clock)
            clock=setTimeout(function(){
                detailsPlace(e)
            },300)
        }
        const detailsHide = (e) => {
            clearTimeout(clock)
            showPopoverRef.value = false
        }
        return {
            x: xRef,
            y: yRef,
            showPopover: showPopoverRef,
            detailsShow,
            detailsHide
        }
    },
    computed:{
        rank(){
            return parseInt(this.chunk?.meta?.word_rank??0);
        }
    }
}
</script>