Yuklengen metinler
<table border>
    <tr>
        <th>Metin</th>
        <th>Cumleler</th>
        <th>Sozler</th>
    </tr>
    <?php foreach($metinler as $metin): ?>
    <tr>
        <td>
            Uzunluk: <?=$metin->length?><br>
            Yazar: <?=$metin->text_author?><br>
            Serlevasi: <?=$metin->text_title?><br>
        </td>
        <td>
            Cumle sayisi: <?=$metin->sentence_cout?><br>
        </td>
        <td>
            Soz sayisi: <?=$metin->word_total_count?><br>
            Essiz soz sayisi: <?=$metin->word_unique_count?><br>
        </td>
    </tr>
    <?php endforeach; ?>
</table>