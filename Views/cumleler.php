<script>
const text_id="<?=$text_id?>";
ItemList = {
    clock:null,
    init(){
        $("#search_input i").on("click",()=>{
            ItemList.search()
        });
    },
    search(){
        location.href='./?page=Sentence/listView&text_id='+ text_id + '&query='+$("#search_input input").val();
    },
    reload(){
        location.reload();
    },
    delete(sentence_id){
        $.post('?page=Metin/itemDelete',{sentence_id}).done(()=>{
            ItemList.reload();
        });
    },
    openWords(sentence_id){
        location.href=`?page=Word/listView&sentence_id=${sentence_id}`;
    },
};
$(ItemList.init);
</script>



<div class="ui green segment" style="margin:50px">
    <h2><?=$_GET['text_title']?> Cumleleri</h2>
    <table  class="ui selectable celled table">
        <tr>
            <td colspan="2"  class="green">
            <form class="ui form" onsubmit="ItemList.search();return false;">
            <div class="ui icon fluid input" id="search_input">
                <input type="text" placeholder="Qidir..." value="<?=$_GET['query']??''?>" autofocus/>
                <i class="inverted circular search link icon"></i>
            </div>
            </form>
            </td>
        </tr>
        <?php foreach ($cumleler as $cumle): ?>
        <tr>
            <td><?=stripslashes($cumle->sentence_data)?></td>
            <td><button class="ui icon button" onclick="ItemList.delete('<?= $cumle->sentence_id ?>')"><i class="icon trash red"></i></button></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>