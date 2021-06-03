<?php


namespace Catalog\Controller\Product;


use Catalog\Model\ProductRepository;
use Framework\ActionInterface;
use Framework\JsonResult;
use Framework\ResultInterface;

class Save implements ActionInterface
{

    public function execute(): ResultInterface
    {
        $ProductRepository = new ProductRepository();
        $ProductRepository->save($_POST, $_FILES);

        $result = new JsonResult();
        $result->setData(["message" => "Product ".$_POST['name']." was successfully created!", "success"=>true]);
        return $result;
    }
}
