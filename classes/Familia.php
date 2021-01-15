<?php 

class Familia 
{
    public static function lista()
    {
        $conn = new PDO('mysql:host=localhost;dbname=perfil_familia', 'root');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $result = $conn->query("SELECT nome FROM familias");
        return $result->fetchAll();
    }

    public static function get_proximo_id($tabela)
    {
        $conn = new PDO('mysql:host=localhost;dbname=perfil_familia', 'root');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $result = $conn->query("SELECT max(id) as next FROM $tabela");
        return $proximo_id = $result->fetch()['next'] + 1;
    }

    public static function cria($nome_familia)
    {
        $conn = new PDO('mysql:host=localhost;dbname=perfil_familia', 'root');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

        $sql = "CREATE TABLE {$nome_familia} (id int(11), nome varchar(40), idade int(3), parentesco varchar(20))";
        $result = $conn->query($sql);
        return $result;
    }

    public static function insere($nome_familia)
    {
        $conn = new PDO('mysql:host=localhost;dbname=perfil_familia', 'root');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        $next = self::get_proximo_id('familias');
        $sql = "INSERT into familias (id, nome) VALUES ({$next}, '$nome_familia')";

        $result = $conn->query($sql);
        return $result;
    }
}