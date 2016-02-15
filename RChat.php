<?php
/**
 * @author Saleh
 * https://github.com/Saleh7
 */
require 'Curl.php';

class RocketChat {
    private $AuthToken = "";    // Authentication Token
    private $UserId = "";       // User ID
    private $UrlApi = "";       // URL to Rocket Chat APIs

    function __construct(){
        $this->Curl = new Curl();
    }

    //Obtaining the running Rocket.Chat version via REST API
    public function RC_version() {
        $version = $this->Curl->get($this->UrlApi.'version');
        return $version;
    }

    // Login with REST API
    public function RC_login($username, $password, $rc_url) {
        $data['user'] = $username;
        $data['password'] = $password;
        $this->UrlApi = $rc_url . "/api/";   // Save the URL for the other functions
        $login = $this->Curl->post($this->UrlApi.'login', $data);
        if ($login->status == "success") {
            $this->AuthToken = $login->data->authToken;
            $this->UserId = $login->data->userId;
        }
        return $login;
    }

    // Logout with REST API
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

    // Sending a message via REST API
    public function RC_send($ID_Rooms,$msg) {
        $this->Curl->setHeader('X-Auth-Token', $this->AuthToken);
        $this->Curl->setHeader('X-User-Id', $this->UserId);
        $send = $this->Curl->post($this->UrlApi."rooms/$ID_Rooms/send",array('msg' => $msg));
        return $send;
    }

}
