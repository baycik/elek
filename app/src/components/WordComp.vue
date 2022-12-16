<template>
  <span v-if="chunk?.is_word" @click="$emit('wordClick',chunk.data)">
    <span v-if="chunk?.is_known" style="color:#666">{{chunk.data}}</span>
    <span v-else style="color:red">{{chunk.data}}</span>
  </span>
  <span v-else>{{chunk.data}}</span>
</template>
<script>
export default {
    props:['chunk']
}
</script>