<?php


namespace Catalog\Model;

use \Index\Model\DbAdapter;

class CategoryRepository
{

    /**
     * @return \Catalog\Model\Category[]
     */
    public function getCategories(): array
    {
        $pdo = DbAdapter::getPDO();

        $categoriesData = $pdo->query('SELECT * FROM `category`')->fetchAll();
        $categories = [];
        foreach ($categoriesData as $categoryData) {
            $categories[] = new Category($categoryData);
        }
        return $categories;
    }

    public function getCategoryName($id):string
    {
        $pdo = DbAdapter::getPDO();

        $stmt = $pdo->prepare('SELECT * FROM `category` WHERE `id` = ?');
        $stmt->execute([$id]);
        return $stmt->fetch()['name'];
    }
}