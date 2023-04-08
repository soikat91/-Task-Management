  <?php
  include_once "./config.php";
  // echo DB_Table;
  
  $connect=mysqli_connect(DB_HOST,DB_User,DB_password,DB_Database);
  
  if(!$connect){
      
      throw new Exception("Database Error");
   }else{
      //echo 'connected';
      //INSERT INTO table_name (column1, column2, column3, ...) VALUES (value1, value2, value3, ...);
     // mysqli_query($connect,"INSERT INTO task (task,date) values ('do somthing','2023/04/04')");'
 
   }  