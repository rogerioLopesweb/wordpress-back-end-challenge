<?php
class API {

    public static function start()
    {
    #Documentação
        #API marca e desmarca post favorito
        //dominio/wp-json/api/apiki/postfavorido/?postID=1&userID=5
        add_action(
            'rest_api_init',
            function () {
                register_rest_route(
                    'api/apiki',
                    '/postfavorido/',
                    array(
                    'methods' => 'GET',
                    'callback' => 'API::postfavorito',
                    )
                );
            }
        );
    }

    public function postfavorito($data)
    {
        //Recebe o ID do post e o ID do usuário
        $postID = $data->get_param( 'postID' );
        $userID = $data->get_param( 'userID' );
        #favorita na base de dados, caso ja tenha na base para mesmo post, então inverte desfavoritando 
        API::gravaFavorito($postID, $userID);
    }

    //Caso ja tenha o id registrado na base é deletado fazendo o desfavoritando o post, caso não tenha entra inclui
    private function gravaFavorito($postID, $userID)
    {
        global $wpdb;
        $nometabela = $wpdb->prefix . 'apiki_favorite_post';
        $sql = 'SELECT count(post_id) as qtd FROM ' . $nometabela . ' WHERE post_id = '.$postID .' and user_id = '.$userID. ';';
        $result = $wpdb->get_row($sql);
        if($result->qtd == 0)
            {
            $sql = "INSERT INTO `".$nometabela."` (`post_id`, `user_id`, `data`) VALUES ('".$postID."', '".$userID."', '". date("Y-m-d H:i:s") . "')";
            $wpdb->get_results($sql); 
             echo json_encode(array("status" => "Inserido com  Sucesso"));
            }else{
                $sql = "DELETE FROM ".$nometabela. ' WHERE post_id = '.$postID .' and user_id = '.$userID. ';';
                echo json_encode(array("status" => "Excluido com  Sucesso"));
                $wpdb->get_results($sql); 
            }
    }
}