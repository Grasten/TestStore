<?php


namespace Catalog\Model;


class Category
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
}