<?php

namespace Catalog\Controller\Product;


use Catalog\Model\ProductRepository;
use Catalog\Model\CategoryRepository;
use Framework\ActionInterface;
use Framework\PageResult;
use Framework\ResultInterface;

class Editpage implements ActionInterface
{

    public function execute(): ResultInterface
    {
        $ProductRepository = new ProductRepository();
        $CategoryRepository = new CategoryRepository();
        $product = $ProductRepository->getById((int)$_GET['id']);
        $categories = $CategoryRepository->getCategories();

        $result = new PageResult();
        $result->setContentTemplate('/Catalog/view/templates/product/edit.phtml');
        $result->setVars(['product'=>$product, 'categories'=>$categories]);
        return $result;
    }
}