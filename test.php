<?php
    require_once('RChat.php'); 

    $Username = ""; // Fill in the user name of the account to be used with this
    $Password = ""; // The password of the account
    $API_URL = "https://web.site.url"; // The URL of Rocket Chat server

    $RC = new RocketChat();
    $res = $RC->RC_login($Username, $Password, $API_URL);
    print_r($res);
    
    print_r("\n");
    
    if ($res->status == "success") {
    /*
        $res = $RC->RC_publicRooms();
        
        $ID_Rooms = ""; // Set the ID of the room which can be returned from RC_publicRooms()
        $res = $RC->RC_join($ID_Rooms);
        $res = $RC->RC_leave($ID_Rooms);
        $res = $RC->RC_messages($ID_Rooms);
        $res = $RC->RC_send($ID_Rooms,'hi');
    */
        $res = $RC->RC_logout();
        print_r($res);
    }

?>
