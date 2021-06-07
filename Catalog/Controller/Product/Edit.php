<?php

namespace Catalog\Controller\Product;


use Catalog\Model\ProductRepository;
use Framework\ActionInterface;
use Framework\JsonResult;
use Framework\ResultInterface;
use Index\Model\DbAdapter;

class Edit implements ActionInterface
{

    public function execute(): ResultInterface
    {
        $ProductRepository = new ProductRepository();
        $ProductRepository->edit($_POST, $_FILES);

        $result = new JsonResult();
        $result->setData(["message" => "Product ".$_POST['name']." was successfully edited!"]);
        return $result;
    }
}