<?php
/*
**
*@author: Jefrey Aristizabal
*@date: 20/06/2025
*@description: ORM (Object Relational Mapping)
*
*/



class Photos
{
    private $id_photo;
    private $photo;
    private $category;

    public function __construct($photo, $category, $id_photo = null)
    {
        $this->id_photo = $id_photo;
        $this->photo = $photo;
        $this->category = $category;
    }

    public function getIdPhoto()
    {
        return $this->id_photo;
    }

    public function setIdPhoto($id_photo)
    {
        return $this->id_photo = $id_photo;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto($photo)
    {
        return $this->photo = $photo;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category)
    {
        return $this->category = $category;
    }
}