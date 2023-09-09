<?php
require 'core/Controller.php';
require 'models/Products.php';
class homeController extends controller
{

    private $user;

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $dados = array();

        $products = new Products();

        $currentPage = 1;
        $offset = 0;
        $limit = 3;

        if (!empty($_GET('p'))) {
            $currentPage = $_GET['p'];
        }

        $offset = $currentPage * $limit;

        $dados['products'] = $products->getListOfProducts($offset, $limit);
        $dados['totalItem'] = $products->getTotal();
        $dados['numberOfpages'] = ceil($dados['totalItems'] / $limit);
        $dados['currentPage'] = $currentPage;

        $this->loadTemplate('home', $dados);
    }
}
