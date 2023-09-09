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

        $currentPage = 1;//por padrão => página atual
        $offset = 0;//por padrão => se estamos na página um, qual será o primeiro item que será exibido ?
        $limit = 3;//por padrão => se estamos na página um, qual será o último item que será exibido ?
        //continuando na linha de raciocínio da explicação acima: se estou na currentPage 10, qual será o primeiro item a ser exibido ? 

        if (!empty($_GET['p'])) {
            /* echo "Hello". $_GET['p'];    */
            $currentPage = $_GET['p'];
        } 
        $offset = ($currentPage * $limit) - $limit;//AQUI FICA MAIS CLARO POR EXEMPLO COMO FUNCIONA A TAG `LIMIT` DENTRO DA CONSULTA SQL, POR EXEMPLO SE ELA `LIMIT 4,3` INDICA QUE IREI PEGAR ITENS A PARTIR DO ID 4, ATÉ O ID 7.

        $dados['products'] = $products->getListOfProducts($offset, $limit);
        $dados['totalItem'] = $products->getTotal();
        $dados['numberOfpages'] = ceil($dados['totalItem'] / $limit);//número de páginas
        $dados['currentPage'] = $currentPage;

        $this->loadTemplate('home', $dados);
    }
}
