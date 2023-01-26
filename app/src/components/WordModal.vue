<template>
  <sui-modal v-model="is_revealed">
    <sui-modal-header>Söz tuzenluvı</sui-modal-header>
    <sui-modal-content>
      <sui-modal-description>
        <sui-header lang="tr" style="text-transform: uppercase;" :color="in_lugatciq?'green':'red'">
            {{word}}
            <span v-if="wordMeta.word_status=='skip'">(atlanğan)</span>
            <span v-if="wordMeta.word_status=='typo'">(hatalı)</span>
        </sui-header>
        <sui-table celled>
            <sui-table-row>
                <sui-table-cell>Elekteki sayısı</sui-table-cell>
                <sui-table-cell>{{wordMeta?.word_count}}</sui-table-cell>
            </sui-table-row>
            <sui-table-row>
                <sui-table-cell>Elekteki yeri</sui-table-cell>
                <sui-table-cell>
                    {{wordMeta?.word_rank}} / {{wordMeta?.global_word_count}}
                </sui-table-cell>
            </sui-table-row>
            <sui-table-row>
                <sui-table-cell>Rastlanuv sıklığı</sui-table-cell>
                <sui-table-cell>
                    <sui-progress :percent="100-wordMeta?.global_rank*100" />
                </sui-table-cell>
            </sui-table-row>
            <sui-table-row>
                <sui-table-cell>Luğatçıqta</sui-table-cell>
                <sui-table-cell  :color="in_lugatciq?'green':'red'">
                    <span v-if="in_lugatciq">BAR</span>
                    <span v-else>YOQ</span>
                </sui-table-cell>
            </sui-table-row>
            <sui-table-row>
                <sui-table-cell>Rastkelgeni cümleler</sui-table-cell>
                <sui-table-cell>
                    <p v-for="(sentence,i) in wordMeta?.sentence_list" :key="sentence.sentence_id">
                        {{i+1}}) {{sentence.sentence_data}}
                    </p>
                </sui-table-cell>
            </sui-table-row>
        </sui-table>


        <sui-card v-if="wordMeta.word_status=='new'||wordMeta.word_status=='alternative'" fluid>
          <sui-card-content> 
            <sui-card-header v-if="wordMeta.word_status=='new'">Yanı söz qoşuluvı</sui-card-header>
            <sui-card-header v-else>Yazıluv şeklinin qoşuluvı</sui-card-header>
            <sui-grid :columns="2">
                <sui-grid-column>
                    <div>Söz tamırı</div>
                    <sui-input
                        @change="itemUpdate('word_lemma',$event.target.value)"
                        placeholder="Söz tamırı"
                        v-model="wordMeta.word_lemma" 
                        fluid
                    />
                    <div v-if="wordMeta.word_status=='alternative'" >Ana söz</div>
                    <sui-input 
                        v-if="wordMeta.word_status=='alternative'" 
                        @change="itemUpdate('word_parent_value',$event.target.value)"
                        placeholder="Ana söz"
                        v-model="wordMeta.word_parent_value" 
                        fluid
                    />
                    <div>Söz şekli</div>
                    <select @change="itemUpdate('word_form',wordMeta.word_form)" v-model="wordMeta.word_form">
                        <option v-for="opt in wordforms" :key="opt" :value="opt">{{opt}}</option>
                    </select>
                </sui-grid-column>
                <sui-grid-column>
                    <h5>İmzalar</h5>
                    <sui-grid v-for="signature in wordMeta.signature_list" :key="signature.signature_id" :columns="4">
                        <sui-grid-column>{{signature.user_name}}</sui-grid-column>
                        <sui-grid-column>{{signature.user_group_title}}</sui-grid-column>
                        <sui-grid-column>{{signature.sign_date_dmy}}</sui-grid-column>
                        <sui-grid-column>
                            <sui-button v-if="signature.is_current_user" @click="itemUnSign()" negative size="mini"><sui-icon name="trash" /> sil</sui-button>
                        </sui-grid-column>
                    </sui-grid>
                    
                    <sui-grid :columns="2">
                        <sui-grid-column>
                            <sui-button fluid :disabled="!is_ready_to_submit" @click="itemSubmit()">Yanı söznü qoş</sui-button>
                        </sui-grid-column>
                        <sui-grid-column>
                            <sui-button v-if="!is_signed_by_user" @click="itemSign()"><sui-icon name="pen alternate" />İmzala</sui-button>
                        </sui-grid-column>
                    </sui-grid>

                    <div v-if="!is_ready_to_submit">
                        <sui-label basic as="a" pointing color="red">Söznü qoşmaq içün imza sayısı yetersiz</sui-label>
                    </div>
                </sui-grid-column>
            </sui-grid>
          </sui-card-content>
        </sui-card>
      </sui-modal-description>
    </sui-modal-content>
    <sui-modal-actions>
      <sui-button v-if="!in_lugatciq" @click="itemMarkNew()" :disabled="is_signed" positive>Yanı söz</sui-button>
      <sui-button v-if="!in_lugatciq" @click="itemMarkAlternative()" :disabled="is_signed" primary>Yazıluv şekli</sui-button>
      <sui-button v-if="!in_lugatciq" @click="itemMarkTypo()" :disabled="is_signed" color="teal">Hatalı</sui-button>
      <sui-button v-if="!in_lugatciq" @click="itemMarkSkip()" :disabled="is_signed" color="yellow">Atla</sui-button>
      <sui-button @click="is_revealed = false">Qapat</sui-button>
    </sui-modal-actions>
  </sui-modal>
</template>
<script>
export default {
    data(){
        return {
            word:null,
            wordMeta:{},
            is_revealed:false,
            min_signs:1,
            wordforms:['isim','sıfat','zarf','bağlayıcı','nida','sayı','zamir','munasebetçi','fiil','edat','kiriş söz','yardımcı isim','yardımcı fiil','isimfiil','fiil infinitivi','sıfatfiil']
        }
    },
    computed:{
        in_lugatciq(){
            return !!this.wordMeta?.lugat_wordform_id
        },
        is_signed(){
            if(this.wordMeta.signature_list?.length){
                return true;
            }
            return false
        },
        is_signed_by_user(){
            for( let sign of this.wordMeta.signature_list ){
                if(sign.is_current_user==1){
                    return true
                }
            }
            return false
        },
        is_ready_to_submit(){
            return this.wordMeta.signature_list?.length>=this.min_signs
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
        },
        async itemMarkSkip(){
            if(this.wordMeta.word_status=='skip'){
                return
            }
            const request={
                word_id:this.wordMeta.word_id,
                field:'word_status',
                value:'skip',
            }
            await this.$post('Word/itemUpdate',request)
            this.itemMetaGet(this.word)
        },
        async itemMarkTypo(){
            if(this.wordMeta.word_status=='typo'){
                return
            }
            const request={
                word_id:this.wordMeta.word_id,
                field:'word_status',
                value:'typo',
            }
            await this.$post('Word/itemUpdate',request)
            this.itemMetaGet(this.word)
        },
        async itemMarkNew(){
            if(this.wordMeta.word_status=='new'){
                return
            }
            let request={
                word_id:this.wordMeta.word_id,
                field:'word_parent_value',
                value:'',
            }
            await this.$post('Word/itemUpdate',request)

            request={
                word_id:this.wordMeta.word_id,
                field:'word_status',
                value:'new',
            }
            await this.$post('Word/itemUpdate',request)
            this.itemMetaGet(this.word)
        },
        async itemMarkAlternative(){
            if(this.wordMeta.word_status=='alternative'){
                return
            }
            const request={
                word_id:this.wordMeta.word_id,
                field:'word_status',
                value:'alternative',
            }
            await this.$post('Word/itemUpdate',request)
            this.itemMetaGet(this.word)
        },
        async itemSign(){
            if(!this.itemValidate()){
                alert("Boş alanlar qalmamalı")
                return false
            }

            console.log(this.wordMeta.word_status,this.wordMeta.word_parent_value,this.wordMeta.word_lemma)


            const request={
                word_id:this.wordMeta.word_id
            }
            await this.$post('Signature/itemCreate',request)
            this.itemMetaGet(this.word)
        },
        async itemUnSign(){
            if( !confirm("İmzanıznı silmek isteginizden eminsiniz mi?") ){
                return;
            }
            const request={
                word_id:this.wordMeta.word_id
            }
            await this.$post('Signature/itemDelete',request)
            this.itemMetaGet(this.word)
        },
        async itemUpdate( field, value ){
            const request={
                word_id:this.wordMeta.word_id,
                field, value
            }
            this.wordMeta[field]=value
            await this.$post('Word/itemUpdate',request) 
        },
        itemValidate(){
            if(this.wordMeta.word_status=='alternative' && (!this.wordMeta.word_parent_value || !this.wordMeta.word_lemma || !this.wordMeta.word_form)){
                return false
            }
            if(this.wordMeta.word_status=='new' && (!this.wordMeta.word_lemma || !this.wordMeta.word_form)){
                return false
            }
            return true
        },
        async itemSubmit(){
            const request={
                word_id:this.wordMeta.word_id,
                field:'lugat_is_submited',
                value:1
            }
            await this.$post('Word/itemUpdate',request)

            try{
                await fetch("https://diyar.im/index.php?option=com_elek&scope=word&format=raw&method=add", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Access-Control-Allow-Origin':'*'
                    },
                    mode:'cors',
                    body: JSON.stringify(this.wordMeta)
                });
                alert("Söz muvaffaqıyetnen luğatcıqqa koşuldı");
            } catch(err){
                alert("Söz luğatcıqqa koşulganda hata peyda oldı");
            }
        }
    }
}
</script>