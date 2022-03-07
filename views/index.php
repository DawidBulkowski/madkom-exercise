<?php
    $user = isset($_GET['user']) ? $_GET['user'] : '';
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $url = '?user='.$user;
    if($_GET['sort']) $url.= '&sort='.$_GET['sort'];
    if($_GET['direction']) $url.= '&direction='.$_GET['direction'];
?>
<center>

<h3>Wprowadź nazwę użytkownika Github aby wyświetlić jego repozytoria</h3>

<form method="get">
    <input type="text" name="user" value="<?=$user?>" /><br/>
    <input type="submit" value="Pokaż repozytoria" />
</form>

</center>

<a href="?user=<?=$user;?>&sort=name&direction=desc" class="sort">Sortuj malejąco po <b>nazwa</b></a>
<a href="?user=<?=$user;?>&sort=name&direction=asc" class="sort">Sortuj rosnąco po <b>nazwa</b></a>

<a href="?user=<?=$user;?>&sort=contributors&direction=desc" class="sort">Sortuj malejąco po <b>ilość kontrybutorów</b></a>
<a href="?user=<?=$user;?>&sort=contributors&direction=desc" class="sort">Sortuj rosnąco po <b>ilość kontrybutorów</b></a>

<h4>Repozytoria - strona <?=$page;?></h4>

<?php
    if($this->data->getRepositories()) {
        foreach ($this->data->getRepositories() as $key => $repository) {
?>

<div class="repository">
    <a href="<?=$repository->html_url;?>" target="_blank"><?=$repository->name;?></a>
    <p class="description"><?=$repository->description;?></p>
    <p class="description"><b>Ilość kontrybutorów</b>: <?=$repository->count_contributtors;?></p>
</div>

<?php }} ?>

<div class="pagination-block">
<?php if($page > 1){ ?>
    <a class="pagination" href="<?=$url."&page=".($page-1);?>">Poprzednia strona</a>
<?php } ?>

<?php if($this->data->getSize() == 5){ ?>
    <a class="pagination" href="<?=$url."&page=".($page+1);?>">Następna strona</a>
<?php } ?>
</div>
