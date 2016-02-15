<?php
/**
 * @author Saleh
 * https://github.com/Saleh7
 */
require 'Curl.php';
class RocketChat {

	private $User = ""; //the username to use authentication as
  private $Password = ""; // the password for that user
  private $AuthToken = ""; // Auth Token
  private $UserId = ""; // id User
  private $UrlApi = "https://Site/api/";

	function __construct(){
		$this->Curl = new Curl();
	}

  //Obtaining the running Rocket.Chat version via REST API
	public function RC_version() {
    $version = $this->Curl->get($this->UrlApi.'version');
    return $version;
	}

  // Logon with REST API
	public function RC_login() {
    $data['user'] = $this->User;
    $data['password'] = $this->Password;
    $login = $this->Curl->post($this->UrlApi.'login',$data);
    //You will need to provide the authToken and userId for any of the authenticated methods.
    return $login;
	}

  // Logoff with REST API
	public function RC_logout() {
    $this->Curl->setHeader('X-Auth-Token', $this->AuthToken);
    $this->Curl->setHeader('X-User-Id', $this->UserId);
    $logout = $this->Curl->get($this->UrlApi.'logout');
    return $logout;
	}

  // Get list of public rooms via REST API
	public function RC_publicRooms() {
    $this->Curl->setHeader('X-Auth-Token', $this->AuthToken);
    $this->Curl->setHeader('X-User-Id', $this->UserId);
    $listRooms = $this->Curl->get($this->UrlApi.'publicRooms');
    //return list public rooms
    return $listRooms;

	}

  // Join a room via REST API
	public function RC_join($ID_Rooms) {
    $this->Curl->setHeader('X-Auth-Token', $this->AuthToken);
    $this->Curl->setHeader('X-User-Id', $this->UserId);
    $join = $this->Curl->post($this->UrlApi."rooms/$ID_Rooms/join");
    return $join;
	}

  // Leave a room via REST API
	public function RC_leave($ID_Rooms) {
    $this->Curl->setHeader('X-Auth-Token', $this->AuthToken);
    $this->Curl->setHeader('X-User-Id', $this->UserId);
    $leave = $this->Curl->post($this->UrlApi."rooms/$ID_Rooms/leave");
    return $leave;
	}

  // Get all unread messages in a room via REST API
	public function RC_messages($ID_Rooms) {
    $this->Curl->setHeader('X-Auth-Token', $this->AuthToken);
    $this->Curl->setHeader('X-User-Id', $this->UserId);
    $messages = $this->Curl->get($this->UrlApi."rooms/$ID_Rooms/messages");
    //return all messages
    return $messages;
	}

  // // Sending a message via REST API
	public function RC_send($ID_Rooms,$msg) {
    $this->Curl->setHeader('X-Auth-Token', $this->AuthToken);
    $this->Curl->setHeader('X-User-Id', $this->UserId);
    $send = $this->Curl->post($this->UrlApi."rooms/$ID_Rooms/send",array('msg' => $msg));
    return $send;

	}

}//class

// Test >>
$ID_Rooms = "9swtWpWp83cXmuk";//
$RC = new RocketChat();
$res = $RC->RC_login();
/*
  $res = $RC->RC_logout();
  $res = $RC->RC_publicRooms();
  $res = $RC->RC_join($ID_Rooms);
  $res = $RC->RC_leave($ID_Rooms);
  $res = $RC->RC_messages($ID_Rooms);
  $res = $RC->RC_send($ID_Rooms,'hi');
*/
echo "<pre>";
print_r($Response);


?>
