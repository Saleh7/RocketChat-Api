<?php
    require_once('RChat.php');

    $Username = ""; // Fill in the user name of the account to be used with this
    $Password = ""; // The password of the account
    $RC_URL = "https://web.site.url"; // The URL of Rocket Chat server

    $RC = new RocketChat();
    $res = $RC->login($Username, $Password, $RC_URL);

    print_r($res); //return Login
    print_r("\n");

    if ($res->status == "success") {
      $listRooms   = $RC->publicRooms();
      /* 
        $res = $RC->publicRooms();
        $idRooms = ""; // Set the ID of the room which can be returned from RC_publicRooms()
        $res = $RC->join($idRooms);
        $res = $RC->leave($idRooms);
        $res = $RC->getMessages($idRooms);
        $res = $RC->sendMessage($idRooms,'hi');
      */
      $RC->logout(); // Logout
      print_r($listRooms);//return list public rooms
    }
?>
