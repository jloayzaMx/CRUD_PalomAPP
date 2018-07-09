<?php require_once('./header.php');
require_once('./tabla.php');
?>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <a href="insert.php" class="btn btn-default">Nuevo Registro</a>
        </div>
        <div class="col-md-9">
            <form action="search.php" method="get" >
            <div class="pull-right"style="padding-left: 0;"  >
              <span class="pull-right">  
                <label class="col-lg-12 control-label" for="keyword" style="padding-right: 0;">
                  <input type="text" value="<?=$_GET["keyword"]?>" placeholder="Name" class="form-control" name="keyword">
                </label>
                </span>
              <button class="btn btn-info">Buscar</button>
            </div>
            </form>
        </div>
    </div>
</div>
<br>

<?php

include '../db_connect.php';
 

include '../libs/ps_pagination.php';
 

$sql = "select * from $table order by id_$table";
 

$pager = new PS_Pagination($pdo, $sql, 15, 23);
 

$rs = $pager->paginate();

$num = $rs->rowCount();
 
if($num >= 0 ){

	print '<div class="container" align="center">';
    echo '<table class="table table-hover">';
    echo "<tr>";
        $sth = $pdo->query($sql);
        $numfields = $sth->columnCount();
        
        for($x=0;$x<$numfields;$x++){
            $meta = $sth->getColumnMeta($x);
            $field = $meta['name'];
	?>
	  <th><?=ucfirst($field)?></th>
	<?php
        }
		  print '<th colspan="2">Action</th>';
    echo "</tr>";

    while ($row = $rs->fetch(PDO::FETCH_ASSOC)){
        echo "<tr>";
            for($x=0;$x<$numfields;$x++){
                $meta = $sth->getColumnMeta($x);
                $field = $meta['name'];
            ?>
            <td><?=$row[$field]?></td>
            <?php
            }
?>
            <td><a href="update.php?id=<?=$row['id_'.$table.'']?>"><i class="glyphicon glyphicon-edit" title="Update"></a></td>
            <td><a href="delete.php?id=<?=$row['id_'.$table.'']?>"><i class="glyphicon glyphicon-remove-circle" title="Delete"></a></td></tr>
<?php
        echo "</tr>";
    }
 
    echo "</table>";
}else{

    echo "No se encontraron registros!";
}
 

echo "<div class='page-nav' align='center'>";

    echo $pager->renderFullNav();
echo "</div>";
?>
</div>
<?php require_once('./footer.php'); ?> 
