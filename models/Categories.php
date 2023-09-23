<?php
require_once 'core/Model.php';
class Categories extends model
{
    public function getList()
    {
        $list = array();

        $sql = "SELECT * FROM categories ORDER BY sub DESC";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            foreach ($sql->fetchAll() as $item) {
                $item['subs'] = array(); //o registro que vem do banco de dados recebe uma nova propiedade ['subs']
                $list[$item['id']] = $item; //o array na posição de cada id, recebe um item de registro respectivo ao id
                //ou seja, lista terá todos os items da consulta, porém como nome de cada posição o id.
            }
            

            while ($this->stillNeed($list)) {
                $this->organizeCategory($list);
            }
        }

        return $list;
    }

    public function organizeCategory(&$array)
    /* o `&` possibilita alterar o array diretamente na memoria. Isto é o array que está sendo passado como parametro */
    {
        foreach ($array as $id => $item) {
            if (isset($array[$item['sub']])) {
                $array[$item['sub']]['subs'][$item['id']] = $item;
                unset($array[$id]);
                break;
            }
        }
    }

    public function stillNeed($array)
    {
        foreach ($array as $item) {
            if (!empty($array[$item['sub']])) {//verifique que se na posição ('id') do array contém valor, caso sim retorne. 
                return true;
            }
        }
        return false;
    }
}
