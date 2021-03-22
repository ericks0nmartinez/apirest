<?php

header('Content-Type: application/json; charset=utf-8');

require_once 'classes/Estoque.php';

class Rest
{
    public static function open($requisicao)
    {

        $param = explode('?', $requisicao);
        $url = explode('/', $param[0]);

        $parametros[] = $param[1];
        $classe = ucfirst($url[1]);
        $metodo = $url[2];
        try {
            if (class_exists($classe)) {
                if (method_exists($classe, $metodo)) {
                    $retorno = call_user_func_array(array(new $classe, $metodo), $parametros);
                    return json_encode(array('status' => 'sucesso', 'dados' => $retorno), JSON_UNESCAPED_UNICODE);
                } else {
                    json_encode(array('status' => 'erro', 'dados' => 'Método inexistente'));
                }
            } else {
                return json_encode(array('status' => 'erro', 'dados' => 'Classe inexistente'));
            }
        } catch (Exception $e) {
            return json_encode(array('status' => 'erro', 'dados' => $e->getMessage()));
        }
    }
}

$url ="$_SERVER[REQUEST_URI]";
echo Rest::open($url);