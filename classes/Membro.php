<?php 

class Membro 
{
    public static function lista($familia)
    {
        $conn = new PDO('mysql:host=localhost;dbname=perfil_familia', 'root');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $result = $conn->query("SELECT * FROM {$familia}");
        return $lista = $result->fetchAll();
    }

    public static function insere($pessoa)
    {
        $conn = new PDO('mysql:host=localhost;dbname=perfil_familia', 'root');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $next = self::get_proximo_id($pessoa['nome_familia']);
        $sql = "INSERT INTO {$pessoa['nome_familia']} (id, nome, idade, parentesco) 
        VALUES ({$next}, '{$pessoa['nome']}', {$pessoa['idade']}, '{$pessoa['parentesco']}')";
        $result = $conn->query($sql);
    }

    public static function get_proximo_id($tabela)
    {
        $conn = new PDO('mysql:host=localhost;dbname=perfil_familia', 'root');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $result = $conn->query("SELECT max(id) as next FROM $tabela");
        return $proximo_id = $result->fetch()['next'] + 1;
    }

}