<?php

session_start();

include("../user/config.php");

set_time_limit(9999);

// extract($_REQUEST);
// print_r($_REQUEST);
// echo $_SESSION['user_id'];

// exit();

  

  foreach ($_POST as $key => $value) 
  {
     // print_r($key);   
      if($key=="password")
      {
        $_SESSION['pass'] = $value;
        $update = mysqli_query($con,"UPDATE users SET password = '".$value."' WHERE id = '".$_SESSION['user_id']."'");
        // echo "UPDATE users SET password = '".$value."' WHERE id = '".$_SESSION['user_id']."'";
      }

      if($key == "username")
      {
        $update = mysqli_query($con,"UPDATE users SET name = '$value' WHERE id = '".$_SESSION['user_id']."'");
        // echo "td update<br>";

      }

      if(!empty($_FILES['university_photo']['name']))
      {

        $total = count($_FILES['university_photo']['name']);

        for( $i=0 ; $i < $total ; $i++ ) 
        {

             //Get the temp file path
              $tmpFilePath = $_FILES['university_photo']['tmp_name'][$i];
             //Make sure we have a file path

              if ($tmpFilePath != "")
              {
                //Setup our new file path
                $newFilePath = __DIR__.'/../upload/university_photo/' . $_FILES['university_photo']['name'][$i];
                //Upload the file into the temp dir
                if(move_uploaded_file($tmpFilePath, $newFilePath)) 
                {
                    $key = 'university_photo';
                    $value = implode(',', $_FILES["university_photo"]['name']);  
                }
              }
        }
       
        /*if (move_uploaded_file($_FILES['university_photo']['tmp_name'], __DIR__.'/../upload/university_photo/'. $_FILES["university_photo"]['name'])) {   
}*/
      }

      if(isset($_POST['img_data']) && $_POST['img_data'] == 0)
      {
            $value = '';
            $key = 'university_photo';
      }

      if(!empty($_FILES['univeristy_photo1']))
      {
          if (move_uploaded_file($_FILES['univeristy_photo1']['tmp_name'], __DIR__.'/../upload/univeristy_photo1/'. $_FILES["univeristy_photo1"]['name'])) 
          {
              $key = 'univeristy_photo1';
              $value = $_FILES["univeristy_photo1"]['name'];
          }
      }

      if(!empty($_FILES['univeristy_photo2']))
      {

          if (move_uploaded_file($_FILES['univeristy_photo2']['tmp_name'], __DIR__.'/../upload/univeristy_photo2/'. $_FILES["univeristy_photo2"]['name'])) 
          {
              $key = 'univeristy_photo2';
              $value = $_FILES["univeristy_photo2"]['name'];

          }

      }

      if($key == 'employer_offer_benefit' || $key == 'type_setting_1' || $key == 'type_setting_2')
      {
          if(!empty($value))
          {
            $value = implode(',', $value);
          }
      }

      



       $query = "SELECT DISTINCT TABLE_NAME  FROM INFORMATION_SCHEMA.COLUMNS  WHERE COLUMN_NAME IN ('$key')  AND TABLE_SCHEMA='$db'";
// echo "<br>";
        $run_qry = mysqli_query($con,$query);
        $table = mysqli_fetch_array($run_qry);

        if(!empty($table) && !empty($table[0]))
        {
            $table = $table[0];
            $chk = mysqli_query($con,"SELECT user_id FROM $table WHERE user_id = '".$_SESSION['user_id']."'") or die(mysqli_error($con));
            $count = mysqli_num_rows($chk);

            if(!empty($count))
            {
                $value = mysqli_real_escape_string($con,$value);            
                $update = mysqli_query($con,"UPDATE $table SET $key = '$value' WHERE user_id = '".$_SESSION['user_id']."'") or die(mysqli_error($con));
                // echo "update<br>";
            }
            else
            {
                $value = mysqli_real_escape_string($con,$value);
                $insert = mysqli_query($con,"INSERT INTO $table SET $key = '$value',user_id =  '".$_SESSION['user_id']."'") or die(mysqli_error($con));
                // echo "insert<br>";
            }
        }

  }

  

    

    

    $tab = $_GET['tab'];

        if(mysqli_affected_rows($con)>0)

        {

          

            header('Location: ../form.php?tab='.$tab);

        }else{

            header('Location: ../form.php?tab='.$tab);

        }

     ?>