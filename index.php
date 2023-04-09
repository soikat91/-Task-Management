<?php
  include_once "./config.php";
  include_once "./conntectdb.php";

  //upcoming task
  $query="Select * from task where complete=0 order by date";
  $result=mysqli_query($connect,$query);


//complete task
  $completeQueryTask="Select * from task where complete=1 order by date";
  $completeResult=mysqli_query($connect,$completeQueryTask);
  //print_r($result);
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-lg-3">

        </div>
        <div class="col-lg-6">
            <h1>
                Task Manager
            </h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates, temporibus.</p>

            <?php
              if(mysqli_num_rows($completeResult)>0){?>
             <h4>Complete Tasks</h4>
             <table class="table">
                <tbody>
                    <tr>
                        <th></th>
                        <th>Id</th>
                        <th>Task</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
              <?php
               while($cdata=mysqli_fetch_assoc($completeResult)){
                  $time=strtotime($cdata['date']);
                  $cdate=date("jS M,Y",$time);
                
                ?>
                     <tr>
                        <td><input type="checkbox" value="<?php echo $cdata['id']?>"></td>
                        <td><?php echo $cdata['id']?></td>
                        <td><?php echo $cdata['task']?></td>
                        <td><?php echo $cdate?></td>
                        <td><a class="delete" data-taskid="<?php echo $cdata['id'] ?>" href="#">Delete</a> | <a class="inComplete" data-taskid="<?php echo $cdata['id'] ?>" href="#">Mark Complete</a> </td>
                    </tr>    
               <?php
               }
              ?>
               </tbody>
              
            </table>
              <?php
              }
            ?>       

            <h4>Upcoming Tasks</h4>
            <?php
               if(mysqli_num_rows($result)==0){?>
               <p class="text-center text-danger" >No Upcoming Task</p>
            
            <?php
               }else{
            ?>
            <form action="task.php" method="post" >
            <table class="table">
                
                    <tbody>
                        <tr>
                            <th></th>
                            <th>Id</th>
                            <th>Task</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        while($data=mysqli_fetch_assoc($result)){

                            $timeStmp=strtotime($data['date']);
                            $date=date("jS M,Y",$timeStmp);
                                        
                        ?>
                        <tr>
                            <td><input name="taskids[]" type="checkbox" value="<?php echo $data['id']?>"></td>
                            <td><?php echo $data['id']?></td>
                            <td><?php echo $data['task']?></td>
                            <td><?php echo $date?></td>
                            <td><a class="delete" data-taskid="<?php echo $data['id'] ?>" href="#">Delete</a> | <a class="complete" data-taskid="<?php echo $data['id']?>" href="#">Complete</a></td>
                        </tr>
                        <?php
                        }
                        ?>
                        
                    </tbody>
                
            </table>

            <select class="form-select p-2" name="action" id="bulkAction">
                    
                    <option value="" selected>Selet One</option>
                    <option value="bulkComplete">Mark Complete</option>
                    <option value="bulkDelete">Delete</option>
                   
           </select>
           <button type="submit" class="btn" id="bulkSubmit">Submit</button>
        </form>  
            <?php
            } 
            
            ?>
          
        <h2 class="mt-3">Add Tasks</h2>
        <?php
            $msg=$_GET['added']?? '';

            if($msg){?>
            
                <p class="text-success">Data added Successfully</p>
            <?php
            }
        ?>
            <form action="task.php" method="post">
                <label class="form-label" for="">Task</label>
                <input class="form-control" type="text" name="task" id="">
                <label class="form-label" for="">Date</label>
                <input  class="form-control" type="text" name="date" id="">
               
                
                <button type="submit" class="btn btn-primary mt-3" name="add">Add</button>
                <input type="hidden" class="form-control" name="action" value="add">
            </form>
        </div>

        <form action="task.php" method="post" id="completeForm">
            <input type="hidden" class="form-control" name="action" value="c">
            <input type="hidden" id="taskid" name="taskid">
        </form>

        <form action="task.php" method="post" id="inCompleteForm">
            <input type="hidden" class="form-control" name="action" value="incomplete">
            <input type="hidden" id="itaskid" name="taskid">
        </form>

        <form action="task.php" method="post" id="deleteForm">
            <input type="hidden" class="form-control" name="action" value="delete">
            <input type="hidden" id="dtaskid" name="taskid">
        </form>
        <div class="col-lg-3">
            
        </div>
    </div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script>
     ;(function($){    
     $(document).ready(function(){
        $(".complete").on('click',function(){
            var id=$(this).data("taskid");
           // alert(id);
            $("#taskid").val(id);
            $("#completeForm").submit();
        });

        $(".inComplete").on('click',function(){
            var id=$(this).data('taskid');
           // alert(id);
            $("#itaskid").val(id);
            $("#inCompleteForm").submit();
        })

        $(".delete").on("click",function(){
            if(confirm("Are you sure Delete this?")){
                var id=$(this).data("taskid");
                //alert(id);
                $("#dtaskid").val(id);
                $("#deleteForm").submit();
            }
            
        })
        $("#bulkSubmit").on("click",function(){
            if($("#bulkAction").val()=="bulkDelete"){
                if(!confirm("Are You Sure ?")){
                    return false;
                }
            }
        })
     });
    })(jQuery);
    </script>
</html>