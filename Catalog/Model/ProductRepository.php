<?php
declare(strict_types=1);

namespace Catalog\Model;


use Index\Model\DbAdapter;

class ProductRepository
{
    /**
     * @return \Catalog\Model\Product[]
     */
    public function getList(array $filters = ['sort' => '', 'query' => '', 'category' => '']):array
    {
        $pdo = DbAdapter::getPDO();

        $sqlQuery = 'SELECT * FROM `product`';

        if ($filters['category']){
            $sqlQuery = $sqlQuery.' WHERE `category` = '.$filters["category"];
        }

        if ($filters['query'] && $filters['category']){
            $sqlQuery = $sqlQuery.' AND (`name` LIKE "%'.$filters["query"].'%" or `descr` LIKE "%'.$filters["query"].'%" or `sku` LIKE "%'.$filters["query"].'%")' ;
        } else if ($filters['query']) {
            $sqlQuery = $sqlQuery.'  WHERE (`name` LIKE "%'.$filters["query"].'%" or `descr` LIKE "%'.$filters["query"].'%" or `sku` LIKE "%'.$filters["query"].'%")'  ;
        }

        if ($filters['sort']){
            $sort = explode ("_", $filters['sort']);
            $sqlQuery = $sqlQuery.' ORDER BY `'.$sort[0].'` '.$sort[1];
        } else {
            $sqlQuery = $sqlQuery.' ORDER BY `id` DESC';
        }
        $productsData = $pdo->query($sqlQuery)->fetchAll();
        $products = [];
        foreach ($productsData as $productData){
            $products[] = new Product($productData);
        }
        return $products;
    }

    public function getById(int $id):Product
    {
        $pdo = DbAdapter::getPDO();

        $stmt = $pdo->prepare('SELECT * FROM `product` WHERE `id` = ?');
        $stmt->execute([$id]);
        $productData = $stmt->fetch(\PDO::FETCH_ASSOC);
        return new Product($productData);
    }

    public function getCategory(int $categoryId):Category
    {
        $pdo = DbAdapter::getPDO();

        $stmt = $pdo->prepare('SELECT * FROM `product` WHERE `category` = ?');
        $stmt->execute([$categoryId]);
        $productData = $stmt->fetch(\PDO::FETCH_ASSOC);
        return new Category($productData);
    }

    public function getCategoryProducts(int $id):array
    {
        $pdo = DbAdapter::getPDO();

        $stmt = $pdo->prepare('SELECT * FROM `product` WHERE `category` = ?');
        $stmt->execute([$id]);
        $productsData = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $products = [];
        if ($productsData) {
            foreach ($productsData as $productData) {
                $products[] = new Product($productData);
            }
        }
        return $products;
    }

    public function delete(int $id): string
    {
        $pdo = DbAdapter::getPDO();

        $stmt = $pdo->prepare('DELETE FROM `product` WHERE (id = ?)');
        $stmt->execute([$id]);
        return "Successfully deleted";
    }

    public function save(array $data, $imageData){
        $pdo = DbAdapter::getPDO();

        move_uploaded_file($_FILES['photo']['tmp_name'], '/var/www/html/images/' . $_FILES['photo']['name']);
        $stmt = $pdo->prepare(
            'INSERT INTO `product` (`name`, `sku`, `price`, `descr`, `category`, image) VALUES (?,?,?,?,?,?)'
        );
        $stmt->execute(array(
            $data['name'],
            $data['sku'],
            $data['price'],
            $data['descr'],
            $data['category'],
            $imageData['photo']['name']
        ));
    }

    public function edit(array $data, $imageData){
        $pdo = DbAdapter::getPDO();

        if ($_FILES['photo']['name']) {
            move_uploaded_file($_FILES['photo']['tmp_name'], '/var/www/html/images/' . $_FILES['photo']['name']);
        }
        $pdo = DbAdapter::getPDO();

        if ($imageData['photo']['name']) {
            $stmt = $pdo->prepare(
                'UPDATE product SET
                name = ?,
                sku = ?,
                price = ?,
                descr = ?,
                category = ?,
                image = ?
                    WHERE
                id = ?;'
            );
            $stmt->execute(array(
                $data['name'],
                $data['sku'],
                $data['price'],
                $data['descr'],
                $data['category'],
                $imageData['photo']['name'],
                $data['id'],
            ));
        } else {
            $stmt = $pdo->prepare(
                'UPDATE product SET
                name = ?,
                sku = ?,
                price = ?,
                descr = ?,
                category = ?
                    WHERE
                id = ?;'
            );
            $stmt->execute(array(
                $data['name'],
                $data['sku'],
                $data['price'],
                $data['descr'],
                $data['category'],
                $data['id'],
            ));
        }
    }
}