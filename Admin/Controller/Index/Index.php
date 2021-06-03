<?php


namespace Index\Controller\Index;


use Catalog\Model\CategoryRepository;
use Catalog\Model\ProductRepository;
use Framework\ActionInterface;
use Framework\PageResult;
use Framework\ResultInterface;

class Index implements ActionInterface
{

    public function execute(): ResultInterface
    {
        $ProductRepository = new ProductRepository();
        $products = $ProductRepository->getList();

        $result = new PageResult();
        $result->setContentTemplate('/Admin/view/templates/list.phtml');
        $result->setVars(['products'=>$products]);
        return $result;
    }
}