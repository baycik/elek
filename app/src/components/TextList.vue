<style>

</style>
<template>
    
<div class="ui red segment" style="margin:50px">
    <h2>Yuklenilgen metinler</h2>
    <table  class="ui celled table">
        <thead>
            <tr>
                <th style="width:10%"></th>
                <th style="width:10%">Yazar</th>
                <th style="width:10%">Serleva</th>
                <th style="width:10%">Yuklenme tarihi</th>
                <th style="width:10%">Arifler</th>
                <th style="width:10%">Cumleler</th>
                <th style="width:10%">Sozler(Essiz)</th>
            </tr> 
        </thead>
        <tbody>
            <tr v-for="metin of textList" :key="metin.text_id">
                <td>
                    <button class="ui button" onclick="ItemList.delete('{{metin.text_id}}')"><i class="icon trash red"></i> Sil</button>
                </td>
                <td>
                    <div class="ui input">
                        <input value="{{metin.text_author}}" onchange="ItemList.update('{{metin.text_id}}','text_author',this.value)" style="width:100%"/>
                    </div>
                </td>
                <td>
                    <div class="ui input">
                        <input value="{{metin.text_title}}" onchange="ItemList.update('{{metin.text_id}}','text_title',this.value)" style="width:100%"/>
                    </div>
                </td>
                <td>
                    {{metin.created_at}}
                </td>
                <td>
                    {{metin.text_letter_count}}
                </td>
                <td>
                    <div style="display:grid;grid-template-columns:1fr 1fr">
                        <div>
                            {{metin.text_sentence_count}}
                        </div>
                        <div>
                            <button class="ui button" onclick="ItemList.openSentences('{{metin.text_id}}','{{metin.text_title}}')"><i class="icon bars"></i>Koz at</button>
                        </div>
                    </div>
                </td>
                <td>
                    <div style="display:grid;grid-template-columns:1fr 1fr">
                        <div>
                        {{metin.text_word_total_count}}({{metin.text_word_unique_count}})
                        </div>
                        <div>
                        <button class="ui button" onclick="ItemList.openWords('{{metin.text_id}}','{{metin.text_title}}')"><i class="icon bars"></i>Koz at</button>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <button class="ui button" onclick="ItemList.fileUploadInit()"><i class="icon plus"></i>Metin yukle</button>
</div>

<input type="file" id="itemlist_uploader" name="items[]" multiple style="display:none" onchange="ItemList.fileUpload(this.files)">

</template>

<script>
export default{
    data(){
        return {
            textList:[]
        }
    },
    created(){
        this.listGet()
    },
    methods:{
        async listGet(){
            this.textList=await this.$post('Metin/listGet',{gaga:'gigi'})
        }
    }

}

</script>