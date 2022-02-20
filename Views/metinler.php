<script>
ItemList = {
    reload(){
        location.reload();
    },
    fileUpload: function (filelist) {
        if (filelist.length) {
            let attached_count = 0;
            let total_size_limit = 10 * 1024 * 1024;
            let fl=filelist?.[0];
            total_size_limit -= fl?.size;
            if (total_size_limit < 0) {
                alert("Разовый объем файлов должен быть не больше 10МБ.\nПрикреплено только: " + attached_count + "файлов");
            }
            ItemList.fileUploadFormData.append("files", fl);
            
            ItemList.fileUploadXhr.send(ItemList.fileUploadFormData);
        }
    },
    fileUploadFormData: null,
    fileUploadXhr: null,
    fileUploadInit: function () {
        var url = '?page=Elek/fileUpload';
        ItemList.fileUploadXhr = new XMLHttpRequest();
        ItemList.fileUploadFormData = new FormData();
        //ItemList.fileUploadFormData.set('image_holder_id', image_holder_id);

        ItemList.fileUploadXhr.open("POST", url, true);
        ItemList.fileUploadXhr.onreadystatechange = function () {
            if (ItemList.fileUploadXhr.readyState === 4 && ItemList.fileUploadXhr.status === 200) {
                ItemList.reload();
            }
        };
        $('#itemlist_uploader').click();
    },
    update(text_id,field,value){
        $.post('?page=Metin/itemUpdate',{text_id,field,value}).done(()=>{
            ItemList.reload();
        });
    },
    delete(text_id){
        $.post('?page=Metin/itemDelete',{text_id}).done(()=>{
            ItemList.reload();
        });
    },
    openSentences(text_id){
        location.href=`?page=Metin/sentenceListShow&text_id=${text_id}`;
    },
    openWords(text_id){
        location.href=`?page=Metin/wordListShow&text_id=${text_id}`;
    },
};
</script>
<div class="ui red segment" style="margin:50px">
    <h2>Yuklenilgen metinler</h2>
    <table  class="ui celled table">
        <thead>
            <tr>
                <th>Yazar</th>
                <th>Serleva</th>
                <th>Cumleler</th>
                <th>Sozler(Essiz)</th>
                <th>Arifler</th>
                <th>Yuklendi</th>
                <th></th>
            </tr>
        </thead>
        <?php foreach ($metinler as $metin): ?>
            <tr>
                <td>
                    <div class="ui input">
                        <input value="<?= $metin->text_author ?>" onchange="ItemList.update('<?= $metin->text_id ?>','text_author',this.value)">
                    </div>
                </td>
                <td>
                    <div class="ui input">
                        <input value="<?= $metin->text_title ?>" onchange="ItemList.update('<?= $metin->text_id ?>','text_title',this.value)">
                    </div>
                </td>
                <td>
                    <?= $metin->text_sentence_count ?>
                    <button class="ui button" onclick="ItemList.openSentences('<?= $metin->text_id ?>')"><i class="icon search"></i></button>
                </td>
                <td>
                    <?= $metin->text_word_total_count ?>(<?= $metin->text_word_unique_count ?>)
                    <button class="ui button" onclick="ItemList.openSentences('<?= $metin->text_id ?>')"><i class="icon search"></i></button>
                </td>
                <td>
                    <?= $metin->text_letter_count ?>
                </td>
                <td>
                    <?= $metin->created_at ?>
                </td>
                <td>
                    
                    <button class="ui button" onclick="ItemList.delete('<?= $metin->text_id ?>')"><i class="icon trash red"></i> Sil</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <button class="ui button" onclick="ItemList.fileUploadInit()"><i class="icon plus"></i>Metin yukle</button>
</div>

<input type="file" id="itemlist_uploader" name="items[]" multiple style="display:none" onchange="ItemList.fileUpload(this.files)">