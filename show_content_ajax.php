<?php
   $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    $id=(int)$_POST['id'];

    $filter=['_id'=>$id];
    $query = new MongoDB\Driver\Query($filter);

    $res = $mng->executeQuery("Test.cony", $query);
    foreach ($res as $row) {
?>
<div class="<?php if(isset($row->color)){echo $row->color;} ?>" style="padding:15px;">
  <h2>Content Entered</h2>
  <h5><?php echo $row->data->heading; ?></h5>
  <sub><?php echo $row->data->author; ?></sub>
  <p class="flow-text"><?php echo $row->data->content; ?></p>
</div>
<?php } ?>
