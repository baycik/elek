<style>
    td span:hover{
        color:orange
    }

</style>

<template>
    <sui-segment ref="yy" color="green">
        <sui-header ref="ttt">{{textHeader.text_title}} Cumleleri</sui-header>
        <sui-input icon="search" placeholder="Search..." v-model="squery"/>
        <sui-table stackable>
            <tr v-for="sentence in compSentenceList" :key="sentence.sentence_id">
                <td>
                    <word-comp v-for="(chunk,i) in sentence.chunks" :key="i" :chunk="chunk"></word-comp>
                </td>
            </tr>
        </sui-table>
    </sui-segment>



</template>
<script>
import WordComp from "@/components/WordComp.vue"
export default{
    components:{
        WordComp
    },
    
    data(){
        return {
            textHeader:{},
            sentenceList:[],
            squery:'',
        }
    },
    mounted(){
        this.clock=null;
        this.listGet();
        this.textHeaderGet();
    },
    computed:{
        compSentenceList(){
            let slist=this.sentenceList;
            for(const sentence of slist){
                sentence.chunks=[]
                const chunks=sentence.sentence_data.split(/([.!?'`",;\s\d\r\n]+)/g)
                for(let i in chunks){
                    sentence.chunks.push({
                        data:chunks[i],
                        meta:this.itemFindMeta(chunks[i],sentence.meta)
                    })
                }
            }
            return slist
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
        async listGet(){
            const request={
                text_id:this.$route.query.text_id,
                query:this.squery
            }
            try{
                this.sentenceList=await this.$post('Sentence/listGet',request)
            } catch{/** */}
        },
        async textHeaderGet(){
            const request={
                text_id:this.$route.query.text_id,
            }
            try{
                this.textHeader=await this.$post('Metin/itemGet',request)
            } catch{/** */}
        },
    },
    watch:{
        'squery':function(){
            this.listGet();
        }
    }
}
</script>