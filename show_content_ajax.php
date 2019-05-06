<?php
   $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    $id=$_POST['id'];
    
    $filter=['_id'=>'$id']; 
    $query = new MongoDB\Driver\Query($filter);     
    
    $res = $mng->executeQuery("test.cony", $query);
    
    $row = current($res->toArray());
    //if (!empty($row)) {
?>

<h2>Content Entered</h2>

<h5><?php echo $row->heading; ?></h5>
<sub><?php echo $row->author; ?></sub>
<p class="flow-text"><?php echo $row->content; ?></p>

<?php //} ?>