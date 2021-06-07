<?php


namespace Admin\Model;


class User
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getId():int
    {
        return $this->data['id'];
    }

    public function getName():string
    {
        return $this->data['name'];
    }

    public function isLoggedIn(){
        return isset($_SESSION['id']);
    }
}