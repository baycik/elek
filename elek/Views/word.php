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
        location.href='./?page=Word/listView&text_id='+ text_id + '&query='+$("#search_input input").val()+'&text_title=<?=$_GET['text_title']?>';
    },
    reload(){
        location.reload();
    },
    delete(word_id){
        $.post('?page=Metin/itemDelete',{word_id}).done(()=>{
            ItemList.reload();
        });
    },
    openWords(word_id){
        location.href=`?page=Word/listView&word_id=${word_id}`;
    },
};
$(ItemList.init);

</script>

<div id="app">
    {{ message }}
</div>

<script>
  Vue.createApp({
    data() {
      return {
        message: 'Hello Vue!'
      }
    }
  }).mount('#app')
</script>







<div id="word" class="ui cian segment" style="margin:50px">
    <h2><?=$_GET['text_title']?> Sozleri</h2>
    <table  class="ui selectable celled table">
    <thead>
        <tr>
            <th>Soz</th>
            <th>Tekrar</th>
            <th></th>
        </tr>
    </thead>
        <tr>
            <td colspan="3"  class="green">
            <form class="ui form" onsubmit="ItemList.search();return false;">
            <div class="ui icon fluid input" id="search_input">
                <input type="text" placeholder="Qidir..." value="<?=$_GET['query']??''?>" autofocus/>
                <i class="inverted circular search link icon"></i>
            </div>
            </form>
            </td>
        </tr>
        <?php foreach ($sozler as $soz): ?>
        <tr>
        <td><?=stripslashes($soz->word_data)?></td>
        <td><?=stripslashes($soz->repeated)?></td>
            <td><button class="ui icon button" onclick="ItemList.delete('<?= $soz->word_id ?>')"><i class="icon trash red"></i></button></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>