<!DOCTYPE html>
<html>
<head>
    <title>NOSQL</title>
               <script type="text/javascript" src="js/jquery.js"></script>
        <link rel="stylesheet" type="text/css" href="css/materialize.min.css">
        <script type="text/javascript" src="js/materialize.min.js"></script>
    </head>
    <style >
    .invalid {
    color:red;
}
    </style>
<body>
  <nav>
   <div class="nav-wrapper">

     <ul id="nav-mobile" class="right hide-on-med-and-down">
       <a href="#" class="brand-logo center">NOSQL</a>
       <li><a href="contentadd.html">Add content</a></li>
       <li><a href="contentshow.php">Show content</a></li>

     </ul>
   </div>
 </nav>
    <div class="row" >

        <div class="container" >
            <div >
            <div class="col s6" >
            	<h2>Show Content</h2>
            <div >

                        <table>
                          <tr>
                              <?php
                                 $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");

                                if(!$_POST)
                                {
                                $query = new MongoDB\Driver\Query([]);
                                $rows = $mng->executeQuery("Test.cony", $query);
                                }
                                else
                                {
                                  echo "ABC";
                                }

                              ?>


                            <th>Index</th>
                            <th>Heading</th>
                          </tr>

                          <?php
                          $i=1;
                           foreach ($rows as $row) {
                          ?>
                           <tr >
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $row->data->heading; ?></td>
                            <td><button class="waves-effect waves-light btn"  onclick="showCon(<?php echo $row->_id; ?>)">Show</button></td>
                            <td><button class="waves-effect waves-light btn" onclick="delCon(<?php echo $row->_id; ?>)">Delete</button></td>
                          </tr>
                          <?php } ?>

                        </table>
                            </div>


            </div>
            <div class="col s6">
              <div id="results">
                <div class="<?php if(isset($row->color)){echo $row->color;} ?>" style="padding:15px;">
                  <h2>Content Entered</h2>
                  <h5><?php echo $row->data->heading; ?></h5>
                  <sub><?php echo $row->data->author; ?></sub>
                  <p class="flow-text"><?php echo $row->data->content; ?></p>
                </div>

              </div>

            </div>
        </div>

        <!--<div>
        	<div class="container">
            <div ng-show="allContent.length == 0">
            <h3>Please Enter some content</h3>
            <h5><a href="angularcontentadd.html">Click Here to add content</h5>
            </div>
            </div>
        </div>
        -->

        </div>

        </div>
        <script type="text/javascript">

          function showCon(id)
          {
            var formData=new FormData();
            formData.append('id',id);
            $.ajax({
                    type: "POST",
                    url: "show_content_ajax.php",
                    processData: false,
                    contentType: false,
                    data:formData,
                    success:function(result){
                      $('#results').empty();
                      $("#results").html(result);
                    }
            });
          }
          function delCon(id)
          {
            var formData=new FormData();
            formData.append('id',id);
            $.ajax({
                    type: "POST",
                    url: "delete_content_ajax.php",
                    processData: false,
                    contentType: false,
                    data:formData,
                    success:function(result){
                       if(result=='Success')
                    {
                        alert("Sucesfully Deleted");
                        window.location.replace("http://localhost/NOSQL/contentshow.php");

                    }
                    }
            });
          }

        </script>
        </div>
</body>
</html>
