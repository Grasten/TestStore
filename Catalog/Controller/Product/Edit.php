<?php

namespace Catalog\Controller\Product;


use Framework\ActionInterface;
use Framework\JsonResult;
use Framework\ResultInterface;
use Index\Model\DbAdapter;

class Edit implements ActionInterface
{

    public function execute(): ResultInterface
    {
        if ($_FILES['photo']['name']) {
            move_uploaded_file($_FILES['photo']['tmp_name'], '/var/www/html/images/' . $_FILES['photo']['name']);
        }
        $pdo = DbAdapter::getPDO();

        if ($_FILES['photo']['name']) {
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
                $_POST['name'],
                $_POST['sku'],
                $_POST['price'],
                $_POST['descr'],
                $_POST['category'],
                $_FILES['photo']['name'],
                $_POST['id'],
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
                $_POST['name'],
                $_POST['sku'],
                $_POST['price'],
                $_POST['descr'],
                $_POST['category'],
                $_POST['id'],
            ));
        }


        $result = new JsonResult();
        $result->setData(["message" => "Product ".$_POST['name']." was successfully updated!"]);
        return $result;
    }
}