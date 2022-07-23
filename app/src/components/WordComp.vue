<template>
  <span @mouseover="detailsShow" @mouseout="detailsHide">{{chunk.data}}</span>
  <n-popover :show="showPopover" :x="x" :y="y" trigger="manual">
    Cool!
  </n-popover>
</template>
<script>
import { NPopover } from 'naive-ui'
import { ref } from 'vue'
export default {
    props:['chunk'],
    components:{
        NPopover
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
    data(){
        return {
        }
    },
    mounted(){
        //
    }
}
</script>