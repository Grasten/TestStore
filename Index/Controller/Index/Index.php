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
        $sort = $_GET['sort'] ?? '';
        $query = $_GET['query'] ?? '';
        $category = $_GET['category'] ?? '';
        $products = $ProductRepository->getList(['sort' => $sort, 'query' => $query , 'category' => $category]);

        $CategoryRepository = new CategoryRepository();
        $categories = $CategoryRepository->getCategories();


        $result = new PageResult();
        $result->setContentTemplate('/Catalog/view/templates/list.phtml');
        $result->setVars(['products'=>$products, 'categories'=>$categories, 'query'=>$query, 'sort'=>$sort, 'categoryId'=>$category]);
        $result->setTitle('Homepage');
        return $result;
    }
}