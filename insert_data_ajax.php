<?php
try {

    $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    $query = new MongoDB\Driver\Query([]);
    $rows = $mng->executeQuery("Test.cony", $query);
        foreach ($rows as $row) {
		if(!isset($row->_id))
		{
			$id=1;
		}
		else
		{
			$id=$row->_id;
		}
    }
    $id++;
    if(isset($_POST['color']))
    {
      $color=$_POST['color'];
    }
    $bulk = new MongoDB\Driver\BulkWrite;
    if(isset($_POST['color']))
    {
      $color=$_POST['color'];
      $doc = ['_id' => $id,'data'=>[ 'heading' => $_POST['heading'],'author' => $_POST['author'],'content' => $_POST['content'] ] ,'color'=>$color ];
    }
    else {
      $doc = ['_id' => $id,'data'=>[ 'heading' => $_POST['heading'],'author' => $_POST['author'],'content' => $_POST['content'] ]  ];
    }

    $bulk->insert($doc);
    $mng->executeBulkWrite('Test.cony', $bulk);
    echo "Success";
} catch (MongoDB\Driver\Exception\Exception $e) {
    $filename = basename(__FILE__);
    echo "The $filename script has experienced an error.\n";
    echo "It failed with the following exception:\n";
    echo "Exception:", $e->getMessage(), "\n";
    echo "In file:", $e->getFile(), "\n";
    echo "On line:", $e->getLine(), "\n";
}
?>
