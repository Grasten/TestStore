<?php


namespace Catalog\Controller\Product;


use Catalog\Model\ProductRepository;
use Framework\ActionInterface;
use Framework\JsonResult;
use Framework\ResultInterface;
use Index\Model\DbAdapter;

class Delete implements ActionInterface
{

    public function execute(): ResultInterface
    {
        $ProductRepository = new ProductRepository();
        $ProductRepository->delete($_POST['id']);

        $result = new JsonResult();
        $result->setData(["success"=>true]);
        return $result;
    }
}