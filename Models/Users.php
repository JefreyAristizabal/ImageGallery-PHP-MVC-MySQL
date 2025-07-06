<?php
/*
**
*@author: Jefrey Aristizabal
*@date: 20/06/2025
*@description: ORM (Object Relational Mapping)
*
*/

class Users {
    private $id_user;
    private $username;
    private $password;
    private $last_session;
    private $created_at;
    private $role;
    private $status;
    private $profile_picture;

    public function __construct($username, $password, $last_session, $created_at, $role, $status, $profile_picture, $id_user = null)
    {
        $this->id_user = $id_user;
        $this->username = $username;
        $this->password = $password;
        $this->last_session = $last_session;
        $this->created_at = $created_at;
        $this->role = $role;
        $this->status = $status;
        $this->profile_picture = $profile_picture;
    }

    public function getIdUser(){
        return $this->id_user;
    }

    public function setIdUser($id_user){
        return $this->id_user = $id_user;
    }

    public function getUsername(){
        return $this->username;
    }

    public function setUsername($username){
        return $this->username= $username;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setPassword($password){
        return $this->password = $password;
    }

    public function getLastSession(){
        return $this->last_session;
    }

    public function setLastSession($last_session){
        return $this->last_session = $last_session;
    }

    public function getCreatedAt(){
        return $this->created_at;
    }

    public function setCreatedAt($created_at){
        return $this->created_at = $created_at;
    }

    public function getRole(){
        return $this->role;
    }

    public function setRole($role){
        return $this->role = $role;
    }

    public function getStatus(){
        return $this->status;
    }

    public function setStatus($status){
        return $this->status = $status;
    }

    public function getProfilePicture(){
        return $this->profile_picture;
    }

    public function setProfilePicture($profile_picture){
        return $this->profile_picture = $profile_picture;
    }
}