<template>
  <span v-if="chunk.is_known" style="color:#666">{{chunk.data}}</span>
  <span v-else style="color:red">{{chunk.data}}</span>
</template>
<script>
export default {
    props:['chunk'],
}
</script>