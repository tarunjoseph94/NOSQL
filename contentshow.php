<!DOCTYPE html>
<html>
<head>
    <title>Angular</title>
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
       <a href="#" class="brand-logo center">Angular JS</a>
       <li><a href="angularcontentadd.html">Add content</a></li>
       <li><a href="angularcontentshow.html">Show content</a></li>

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
                                $rows = $mng->executeQuery("test.cony", $query);
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
                            <td><?php echo $row->heading; ?></td>
                            <td><button class="waves-effect waves-light btn"  onclick="showCon(<?php echo $row->_id; ?>)">Show</button></td>
                            <td><button class="waves-effect waves-light btn" onclick="delCon(<?php echo $row->_id; ?>)">Delete</button></td>
                          </tr>
                          <?php } ?>
                          
                        </table>
                            </div>


            </div>
            <div class="col s6">
              <div id="results">
              <h2>Content Entered</h2>
              <h5><?php echo $row->heading; ?></h5>
              <sub><?php echo $row->author; ?></sub>
              <p class="flow-text"><?php echo $row->content; ?></p>
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

        </script>
        </div>
</body>
</html>
