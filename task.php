<?php
include_once "./config.php";
include_once "./conntectdb.php";
// echo DB_Table;

//$connect=mysqli_connect(DB_HOST,DB_User,DB_password,DB_Database);

// if(!$connect){
    
//     throw new Exception("Database Error");
//  }else{
//     echo 'connected';
//     //INSERT INTO table_name (column1, column2, column3, ...) VALUES (value1, value2, value3, ...);
//    // mysqli_query($connect,"INSERT INTO task (task,date) values ('do somthing','2023/04/04')");'
//    mysqli_close($connect);
//  }


 $action=isset($_POST['action'])? $_POST['action'] :'';
 if(!$action){
   header("Location:index.php");
   die();
 }else{
      if('add'==$action){

         $task=$_POST['task'];
         $date=$_POST['date'];

         if($task && $date){

            $query="INSERT INTO ".DB_Table." (task,date) values ('{$task}','{$date}')";
            mysqli_query($connect,$query);
            header("Location:index.php?added=true");
            mysqli_close($connect);         
           
         }
         
        
        

      }else if("c"==$action){

         $taskid=$_POST['taskid'];
       //  echo $taskid;
        if($taskid){
         $query="update task set complete=1 where id=$taskid limit 1";
         mysqli_query($connect,$query);
        
        
        }
        header("Location:index.php");
       
     
      } else if("incomplete"==$action){
      
       $taskid=$_POST['taskid'];
      //  echo $taskid;
       if($taskid){
        $query="update task set complete=0 where id=$taskid limit 1";
        mysqli_query($connect,$query);      
       
       }
      header("Location:index.php");
      
    
     }else if ("delete"==$action){
        
         $taskid=$_POST['taskid'];
        // echo $taskid;
         
         if($taskid){
           $query="delete from task where id=$taskid limit 1";
           mysqli_query($connect,$query);
         }
         header("Location:index.php");


     }else if ("bulkComplete"==$action){      
        
      $taskids=$_POST['taskids'];
      // print_r($taskids);
      $_taskids=join(",",$taskids);
      
      if($taskids){
        $query="update task set complete=1 where id in ($_taskids)";
      //  echo $query;
      //  exit();
       mysqli_query($connect,$query);
      }
      header("Location:index.php");


      }else if ("bulkDelete"==$action){      
            
        $taskids=$_POST['taskids'];
        // print_r($taskids);
        $_taskids=join(",",$taskids);
        
        if($taskids){
          $query="delete from task where id in ($_taskids)";
        //  echo $query;
        //  exit();
        mysqli_query($connect,$query);
        }
        header("Location:index.php");


    }
 }