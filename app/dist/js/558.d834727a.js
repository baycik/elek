"use strict";(self["webpackChunkapp"]=self["webpackChunkapp"]||[]).push([[558],{8558:function(t,e,l){l.r(e),l.d(e,{default:function(){return w}});l(7658);var i=l(3396),a=l(9242),n=l(7139);const d=(0,i._)("h2",null,"Yuklenilgen metinler",-1),o={class:"ui stackable table"},u=(0,i._)("thead",null,[(0,i._)("tr",null,[(0,i._)("th",null,"Yazar adi"),(0,i._)("th",null,"Serleva"),(0,i._)("th",null,"Yayinlanuv tarihi"),(0,i._)("th",null,"Yuklenme tarihi"),(0,i._)("th",null,"Arifler sayisi"),(0,i._)("th",null,"Cumleler"),(0,i._)("th",null,"Sozler(Essiz)"),(0,i._)("th")])],-1),s=["onUpdate:modelValue","onChange"],r=["onUpdate:modelValue","onChange"],_=["onUpdate:modelValue","onChange"],h=(0,i._)("i",{class:"icon plus"},null,-1);function p(t,e,l,p,c,m){const f=(0,i.up)("sui-button-content"),w=(0,i.up)("sui-icon"),U=(0,i.up)("sui-button"),x=(0,i.up)("sui-segment");return(0,i.wg)(),(0,i.j4)(x,{color:"red"},{default:(0,i.w5)((()=>[d,(0,i._)("table",o,[u,(0,i._)("tbody",null,[((0,i.wg)(!0),(0,i.iD)(i.HY,null,(0,i.Ko)(m.computedTextList,(e=>((0,i.wg)(),(0,i.iD)("tr",{key:e.text_id},[(0,i._)("td",null,[(0,i.wy)((0,i._)("input",{"onUpdate:modelValue":t=>e.text_author=t,onChange:t=>m.itemUpdate(e.text_id,"text_author",e.text_author),style:{width:"100%"}},null,40,s),[[a.nr,e.text_author]])]),(0,i._)("td",null,[(0,i.wy)((0,i._)("input",{"onUpdate:modelValue":t=>e.text_title=t,onChange:t=>m.itemUpdate(e.text_id,"text_title",e.text_title),style:{width:"100%"}},null,40,r),[[a.nr,e.text_title]])]),(0,i._)("td",null,[(0,i.wy)((0,i._)("input",{"onUpdate:modelValue":t=>e.text_date=t,type:"date",onChange:t=>m.itemUpdate(e.text_id,"text_date",e.text_date),style:{width:"100%"}},null,40,_),[[a.nr,e.text_date]])]),(0,i._)("td",null,(0,n.zw)(e.date),1),(0,i._)("td",null,(0,n.zw)(e.text_letter_count),1),(0,i._)("td",null,[(0,i.Wm)(U,{animated:"",fluid:""},{default:(0,i.w5)((()=>[(0,i.Wm)(f,{visible:""},{default:(0,i.w5)((()=>[(0,i.Uk)((0,n.zw)(e.text_sentence_count),1)])),_:2},1024),(0,i.Wm)(f,{hidden:"",onClick:l=>t.$router.push(`sentence-list?text_id=${e.text_id}`)},{default:(0,i.w5)((()=>[(0,i.Uk)(" koz at "),(0,i.Wm)(w,{name:"arrow right"})])),_:2},1032,["onClick"])])),_:2},1024)]),(0,i._)("td",null,[(0,i.Wm)(U,{animated:"",fluid:""},{default:(0,i.w5)((()=>[(0,i.Wm)(f,{visible:""},{default:(0,i.w5)((()=>[(0,i.Uk)((0,n.zw)(e.text_word_total_count)+"("+(0,n.zw)(e.text_word_unique_count)+")",1)])),_:2},1024),(0,i.Wm)(f,{hidden:"",onClick:l=>t.$router.push(`word-list?text_id=${e.text_id}`)},{default:(0,i.w5)((()=>[(0,i.Uk)(" koz at "),(0,i.Wm)(w,{name:"arrow right"})])),_:2},1032,["onClick"])])),_:2},1024)]),(0,i._)("td",null,[(0,i.Wm)(U,{fluid:"",onClick:t=>m.itemDelete(e.text_id)},{default:(0,i.w5)((()=>[(0,i.Uk)("Metinni Sil "),(0,i.Wm)(w,{name:"trash red"})])),_:2},1032,["onClick"])])])))),128))])]),(0,i._)("button",{class:"ui button",onClick:e[0]||(e[0]=t=>m.fileUploadInit())},[h,(0,i.Uk)("Metin yukle")]),(0,i._)("input",{type:"file",ref:"metin_uploader",name:"items[]",multiple:"",style:{display:"none"},onChange:e[1]||(e[1]=t=>m.fileUpload())},null,544)])),_:1})}var c={data(){return{textList:[],fileUploadFormData:null,fileUploadXhr:null}},created(){this.listGet()},computed:{computedTextList(){let t=this.textList;for(let e in t){const l=new Date(Date.parse(t[e].created_at));t[e].date=l.toLocaleDateString()}return t}},methods:{fileUpload(){var t=this.$refs.metin_uploader.files;if(t.length){let e=t?.[0];this.fileUploadFormData.append("files",e),this.fileUploadXhr.send(this.fileUploadFormData)}},fileUploadInit(){var t=this,e=`${this.$conf.hostname}?page=Elek/fileUpload`;this.fileUploadXhr=new XMLHttpRequest,this.fileUploadFormData=new FormData,this.fileUploadXhr.open("POST",e,!0),this.fileUploadXhr.onreadystatechange=function(){4===t.fileUploadXhr.readyState&&200===t.fileUploadXhr.status&&'"ok"'==t.fileUploadXhr.response&&t.listGet()},this.$refs.metin_uploader.click()},async itemCreate(){},async itemUpdate(t,e,l){const i={text_id:t,field:e,value:l};try{await this.$post("Metin/itemUpdate",i)}catch{alert("Soñ işlev sırasında hata peyda oldı")}},async itemDelete(t){if(!confirm("Silinsin mi?"))return;const e={text_id:t};try{await this.$post("Metin/itemDelete",e)}catch{alert("Soñ işlev sırasında hata peyda oldı")}this.listGet()},async listGet(){this.textList=await this.$post("Metin/listGet")}}},m=l(89);const f=(0,m.Z)(c,[["render",p]]);var w=f}}]);
//# sourceMappingURL=558.d834727a.js.map