<h1><?=$title?></h1>

<form action="inc/conf.php?cmd=edit_page&page=home" method="post" name="edit_page">
    <p><input type="text" name="meta_d" placeholder="meta description *" value="<?=$meta_d ?>"></p>
    <p><textarea name="descr" placeholder="Բնութագիր *"><?=$descr?></textarea></p>
    <p><button type="submit">Պահպանել</button></p>
</form>