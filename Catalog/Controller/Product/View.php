<?php


namespace Catalog\Controller\Product;


use Catalog\Model\CategoryRepository;
use Catalog\Model\ProductRepository;
use Framework\ActionInterface;
use Framework\PageResult;
use Framework\ResultInterface;

class View implements ActionInterface
{

    public function execute(): ResultInterface
    {
        $ProductRepository = new ProductRepository();
        $product = $ProductRepository->getById((int)$_GET['id']);
        $CategoryRepository = new CategoryRepository();
        $category = $CategoryRepository->getCategoryName($product->getCategoryId());

        $result = new PageResult();
        $result->setContentTemplate('/Catalog/view/templates/product/view.phtml');
        $result->setVars(['product'=>$product, 'category' => $category]);
        return $result;
    }
}