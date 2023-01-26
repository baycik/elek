<template>
    <div>
    <sui-segment color="green">
        <sui-header ref="ttt">Soz Listesi</sui-header>
        <sui-input icon="search" placeholder="Search..." v-model="query"/>
        <div style="display:grid;grid-template-columns:repeat(auto-fit, 200px);gap:10px;margin-top:20px">
            <div v-for="word in wordListComp" :key="word.word_id">
                <sui-label :color="word?.color"  @click="itemReveal(word?.word_data)">
                    <s v-if="word.word_status=='typo'">{{word?.word_data}}</s>
                    <span v-else>{{word?.word_data}}</span>
                </sui-label>
            </div>
        </div>
    </sui-segment>
    <word-modal ref="wmodal"></word-modal>
    </div>
</template>
<script>
import WordModal from "@/components/WordModal.vue"
export default{
    components:{
        WordModal
    },
    data(){
        return {
            wordList:[],
            query:'',
        }
    },
    mounted(){
        this.listGet();
    },
    computed:{
        wordListComp(){
            for(let word of this.wordList){
                if(word.is_known==1){
                    word.color='green'
                } else
                if(word.word_status=='new'){
                    word.color='teal'
                } else
                if(word.word_status=='alternative'){
                    word.color='primary'
                } else
                if(word.word_status=='skip'){
                    word.color='yellow'
                } else
                if(word.word_status=='typo'){
                    word.color='orange'
                } else
                if(word.is_known!=1){
                    word.color='red'
                } else {
                    word.color='gray'
                }
            }
            return this.wordList
        }
    },
    methods:{
        itemFindMeta(word_data,word_list){
            for(const word of word_list){
                if(word_data==word.word_data){
                    return word
                }
            }
            return null
        },
        itemReveal(word_data){
            this.$refs.wmodal.show(word_data)
        },
        async listGet(){
            const request={
                query:this.query
            }
            try{
                this.wordList=await this.$post('Word/listGet',request)
            } catch{/** */}
        },
    },
    watch:{
        'query':function(){
            this.listGet();
        }
    }
}
</script>