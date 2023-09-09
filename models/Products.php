<?php
require_once 'core/Model.php';
require_once 'models/Brands.php';
class Products extends model
{

    //primeira maneira de pegar o nome de uma marca (relacionamento entre tabelas)
    public function getListOfProductsSecondForm()
    {
        $arrayFromRecords = array();

        $sql = " SELECT *, 
                (SELECT brands.name FROM bands WHERE brands.id = products.id) as brand_name,
                (SELECT categories.name FROM categories WHERE categories.id = products.id) as category_name,
         FROM products";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $arrayFromRecords = $sql->fetchAll();
        }

        return $arrayFromRecords;
    }
    //segunda maneira de pegar o nome de uma marca (relacionamento entre tabelas)
    public function getListOfProducts($offseat = 0, $limit = 3)
    {
        $arrayFromRecords = array();

        $sql = "SELECT * FROM products LIMIT $offseat, $limit";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $arrayFromRecords = $sql->fetchAll();

            $brand = new Brands();
            foreach ($arrayFromRecords as $key => $item) {
                $arrayFromRecords[$key]['brand_name'] = $brand->getNameById(
                    $item['id_brand']
                );
                $arrayFromRecords[$key]['images'] = $this->getImagesById($item['id_brand']);
            }
        }

        return $arrayFromRecords;
    }
    public function getImagesById(int $id)
    {
        $imagesUrl = array();

        $sql = "SELECT url FROM products_images WHERE id_product = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $imagesUrl = $sql->fetchAll();
        }

        return $imagesUrl;
    }

    public function getTotal()
    {
        $sql = "SELECT COUNT(*) as c FROM products";
        $sql = $this->db->query($sql);
        $sql = $sql->fetch();
        /* var_dump($sql['c']);  */
        return $sql['c']; 
    }
}
