<?php


namespace Catalog\Model;


class Product
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

    public function getSku():string
    {
        return $this->data['sku'];
    }

    public function getName():string
    {
        return $this->data['name'];
    }

    public function getPrice():string
    {
        return $this->data['price'];
    }

    public function getDescription():string
    {
        return $this->data['descr'];
    }

    public function getCategoryId():string
    {
        return $this->data['category'];
    }

    public function getUrl():string
    {
        return "/catalog/product/view/?id=".$this->data['id'];
    }

    /**
     * @param mixed $data
     */
    public function getImageUrl():string
    {
        if (empty($this->data['image'])){
            return "/images/default.png";
        }
        return "/images/".$this->data['image'];
    }
}