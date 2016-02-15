<?php
/**
 * @author Saleh
 * https://github.com/Saleh7
 */
require 'Curl.php';

class RocketChat {

    function __construct(){
        $this->Curl = new Curl();
    }

    //Obtaining the running Rocket.Chat version via REST API
    public function version() {
        $version = $this->Curl->get($this->urlApi.'version');
        return $version;
    }

    // Login with REST API
    public function login($username, $password , $rc_url) {
        $data['user']     = $username;
        $data['password'] = $password;
        $this->urlApi = $rc_url . "/api/";   // Save the URL for the other functions
        $login = $this->Curl->post($this->urlApi.'login', $data);
        if ($login->status == "success") {
            $this->authToken = $login->data->authToken;
            $this->userId = $login->data->userId;
        }
        return $login;
    }

    // Logout with REST API
    public function logout() {
        $this->Curl->setHeader('X-Auth-Token', $this->authToken);
        $this->Curl->setHeader('X-User-Id', $this->userId);
        $logout = $this->Curl->get($this->urlApi.'logout');
        return $logout;
    }

    // Get list of public rooms via REST API
    public function publicRooms() {
        $this->Curl->setHeader('X-Auth-Token', $this->authToken);
        $this->Curl->setHeader('X-User-Id', $this->userId);
        $listRooms = $this->Curl->get($this->urlApi.'publicRooms');
        //return list public rooms
        return $listRooms;
    }

    // Join a room via REST API
    public function join($idRooms) {
        $this->Curl->setHeader('X-Auth-Token', $this->authToken);
        $this->Curl->setHeader('X-User-Id', $this->userId);
        $join = $this->Curl->post($this->urlApi."rooms/$idRooms/join");
        return $join;
    }

    // Leave a room via REST API
    public function leave($idRooms) {
        $this->Curl->setHeader('X-Auth-Token', $this->authToken);
        $this->Curl->setHeader('X-User-Id', $this->userId);
        $leave = $this->Curl->post($this->urlApi."rooms/$idRooms/leave");
        return $leave;
    }

    // Get all unread messages in a room via REST API
    public function getMessages($idRooms) {
        $this->Curl->setHeader('X-Auth-Token', $this->authToken);
        $this->Curl->setHeader('X-User-Id', $this->userId);
        $messages = $this->Curl->get($this->urlApi."rooms/$idRooms/messages");
        //return all messages
        return $messages;
    }
    // Sending a message via REST API
    public function sendMessage($idRooms,$message) {
        $this->Curl->setHeader('X-Auth-Token', $this->authToken);
        $this->Curl->setHeader('X-User-Id', $this->userId);
        $send = $this->Curl->post($this->urlApi."rooms/$idRooms/send",array('msg' => $message));
        return $send;
    }

}
