<style>

</style>
<template>
<sui-segment color="red">
    <h2>Yuklenilgen metinler</h2>
    <table  class="ui stackable table">
        <thead>
            <tr>
                <th>Yazar adi</th>
                <th>Serleva</th>
                <th>Yuklenme tarihi</th>
                <th>Arifler sayisi</th>
                <th>Cumleler</th>
                <th>Sozler(Essiz)</th>
                <th></th>
            </tr> 
        </thead>
        <tbody>
            <tr v-for="metin in computedTextList" :key="metin.text_id">
                <td>
                    <sui-input v-model="metin.text_author" @change="itemUpdate(metin.text_id,'text_author',metin.text_author)" style="width:100%"/>
                </td>
                <td>
                    <sui-input v-model="metin.text_title" @change="itemUpdate('{{metin.text_id}}')" style="width:100%"/>
                </td>
                <td>
                    {{metin.date}}
                </td>
                <td>
                    {{metin.text_letter_count}}
                </td>
                <td>
                    <sui-button animated fluid>
                        <sui-button-content visible>{{metin.text_sentence_count}}</sui-button-content>
                        <sui-button-content hidden @click="$router.push(`sentence-list?text_id=${metin.text_id}`)">
                            koz at <sui-icon name="arrow right" />
                        </sui-button-content>
                    </sui-button>
                </td>
                <td>
                    <sui-button animated fluid>
                        <sui-button-content visible>{{metin.text_word_total_count}}({{metin.text_word_unique_count}})</sui-button-content>
                        <sui-button-content hidden @click="$router.push(`word-list?text_id=${metin.text_id}`)">
                            koz at <sui-icon name="arrow right" />
                        </sui-button-content>
                    </sui-button>
                </td>
                <td>
                    <sui-dropdown button class="primary" icon="bars">
                        <sui-dropdown-menu>
                            <sui-dropdown-item text="Cumlelere koz at" icon="list" />
                            <sui-dropdown-item text="Sozlere koz at" icon="list alternate outline" />
                            <sui-dropdown-item text="Metinni Sil" icon="trash red"  @click="itemDelete('{{metin.text_id}}')"/>
                        </sui-dropdown-menu>
                    </sui-dropdown>
                </td>
            </tr>
        </tbody>
    </table>
    <button class="ui button" onclick="ItemList.fileUploadInit()"><i class="icon plus"></i>Metin yukle</button>
</sui-segment>

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
    computed:{
        computedTextList(){
            let list=this.textList
            for(let i in list){
                const date=new Date(Date.parse(list[i].created_at))
                list[i].date=date.toLocaleDateString()
            }
            return list
        }
    },
    methods:{
        async listGet(){
            this.textList=await this.$post('Metin/listGet')
        },
        async itemUpdate(text_id,field,value){
            const request={
                text_id,field,value
            }
            await this.$post('Metin/itemUpdate',request)
        }
    }

}

</script>