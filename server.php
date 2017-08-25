<?php

    $data = $_REQUEST;
    $last_displayed_chat_id = $data['last_displayed_chat_id'];

    $con = mysqli_connect("localhost", "root", "", "group_chat");

    if (
      isset($data['user_name']) &&
      isset($data['user_comment'])
    ) {
      $insert = "
          INSERT INTO chats(user_name, user_comment)
          VALUES('".$data['user_name']."', '".$data['user_comment']."')
      ";
      $insert_result = mysqli_query($con, $insert);
    }




    // TO UPDATE THE CHAT 
    $select = "SELECT *
              FROM chats
              WHERE chat_id > '".$last_displayed_chat_id."'
    ";

    $result = mysqli_query($con, $select);

    $arr = array();

    $row_count =  mysqli_num_rows($result);

    if ($row_count > 0) {
      while ($row = mysqli_fetch_array($result)) {
        array_push($arr, $row);
      }
    }

    mysqli_close($con);

    echo json_encode($arr);

 ?>
