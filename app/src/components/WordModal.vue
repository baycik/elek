<template>
  <sui-modal v-model="is_revealed">
    <sui-modal-header>Soz tuzenluvi</sui-modal-header>
    <sui-modal-content>
      <sui-modal-description>
        <sui-header  lang="tr" style="text-transform: uppercase;" :color="in_lugatciq?'green':'red'">{{word}}</sui-header>
        <sui-table celled>
            <sui-table-row>
                <sui-table-cell>Elekteki sayi</sui-table-cell><sui-table-cell>{{wordMeta?.word_count}}</sui-table-cell>
            </sui-table-row>
            <sui-table-row>
                <sui-table-cell>Elekteki yeri</sui-table-cell><sui-table-cell>{{wordMeta?.word_rank}}/{{wordMeta?.global_word_count}} ({{wordMeta?.global_rank}})</sui-table-cell>
            </sui-table-row>
            <sui-table-row>
                <sui-table-cell>Lugatciqta</sui-table-cell>
                <sui-table-cell  :color="in_lugatciq?'green':'red'">
                    <span v-if="in_lugatciq">BAR</span>
                    <span v-else>YOQ</span>
                </sui-table-cell>
            </sui-table-row>
            <sui-table-row>
                <sui-table-cell>Rastkelgeni cumleler</sui-table-cell>
                <sui-table-cell>
                    <p v-for="sentence in wordMeta?.sentence_list" :key="sentence.sentence_id">
                        {{sentence.sentence_data}}
                    </p>
                </sui-table-cell>
            </sui-table-row>
        </sui-table>
      </sui-modal-description>
    </sui-modal-content>
    <sui-modal-actions>
      <sui-button positive @click="is_revealed = false">Qapat</sui-button>
    </sui-modal-actions>
  </sui-modal>
</template>
<script>
export default {
    data(){
        return {
            word:null,
            wordMeta:{},
            is_revealed:false
        }
    },
    computed:{
        in_lugatciq(){
            return !!this.wordMeta?.lugat_wordform_id
        }
    },
    methods:{
        show(word){
            this.word=word
            this.is_revealed=!!word
            this.itemMetaGet(word)
        },
        async itemMetaGet(word){
            this.wordMeta=await this.$post('Word/itemMetaGet',{word})
        }
    }
}
</script>