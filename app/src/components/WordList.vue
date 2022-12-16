<template>
    <div>
    <sui-segment color="green">
        <sui-header ref="ttt">Soz Listesi</sui-header>
        <sui-input icon="search" placeholder="Search..." v-model="query"/>
        <div style="display:grid;grid-template-columns:repeat(auto-fit, 200px);gap:10px;margin-top:20px">
            <div v-for="word in wordList" :key="word.word_id">
                <sui-label :color="word?.is_known==1?'green':'red'"  @click="itemReveal(word?.word_data)">{{word?.word_data}}</sui-label>
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
            console.log(word_data)
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