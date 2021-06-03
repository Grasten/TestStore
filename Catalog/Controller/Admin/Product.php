<?php


namespace Catalog\Controller\Admin;


use Catalog\Model\ProductRepository;
use Framework\ActionInterface;
use Admin\Framework\PageResult;
use Framework\ResultInterface;

class Product implements ActionInterface
{
    public function execute(): ResultInterface
    {
        $ProductRepository = new ProductRepository();
        $products = $ProductRepository->getList();

        $result = new PageResult();
        $result->setContentTemplate('/Catalog/view/templates/admin/list.phtml');
        $result->setVars(['products'=>$products]);
        $result->setTitle('Admin - Products');
        return $result;
    }
}