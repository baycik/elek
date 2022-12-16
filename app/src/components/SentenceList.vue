<template>
    <div>
    <sui-segment color="green">
        <sui-header ref="ttt">{{textHeader?.text_title}} Cumleleri</sui-header>
        <sui-input icon="search" placeholder="Search..." v-model="squery"/>
        <sui-table stackable>
            <tr v-for="sentence in compSentenceList" :key="sentence.sentence_id">
                <td>
                    <word-comp v-for="(chunk,i) in sentence.chunks" :key="i" :chunk="chunk" @wordClick="itemReveal"></word-comp>
                </td>
            </tr>
        </sui-table>
    </sui-segment>
    <word-modal ref="wmodal"></word-modal>
    </div>
</template>
<script>
import WordComp from "@/components/WordComp.vue"
import WordModal from "@/components/WordModal.vue"
export default{
    components:{
        WordComp,
        WordModal
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
                const regex=new RegExp(/([.!?:,;\-'‘`"”“\s\d\r\n]+)/g);
                const chunks=sentence.sentence_data.split(regex)
                const known_words=sentence.known_words?.split(',')||[]
                for(let i in chunks){
                    const is_known=(known_words.indexOf(chunks[i].toLowerCase())>-1);
                    const is_word=!chunks[i].match(regex);
                    sentence.chunks.push({
                        data:chunks[i],
                        lower:chunks[i].toLowerCase(),
                        is_known:is_known,
                        is_word:is_word,
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
        itemReveal(word_data){
            this.$refs.wmodal.show(word_data)
        },
        async listGet(){
            const request={
                text_id: (this.$route.query.text_id??0),
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