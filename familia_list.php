<?php
    require_once 'classes/Membro.php';
    
    if(!empty($_REQUEST)) {
        
        if($_REQUEST['action'] == 'list') {
            
            $familia = $_POST['nome'];
            try {
                $membros = Membro::lista($familia);
            }
            catch(Exception $e) {
                print $e->getMessage();
            }
            $listas = '';
           
            foreach($membros as $membro) {
                $mostra_familia = file_get_contents('html/mostra_familia.html');
                $mostra_familia = str_replace('{nome}', $membro['nome'], $mostra_familia);
                $mostra_familia = str_replace('{idade}', $membro['idade'], $mostra_familia);
                $mostra_familia = str_replace('{parentesco}', $membro['parentesco'], $mostra_familia);
                $listas .= $mostra_familia;
            }
            
            $lista = file_get_contents('html/list.html');
            $lista = str_replace('{nome_familia}', $familia, $lista);
            $lista = str_replace('{mostra_familia}', $listas, $lista);
            print($lista);
            
        }

        if($_REQUEST['action'] == 'create') {
            $pessoa = $_POST;
            try {
                $result = Membro::insere($pessoa);
            }
            catch (Exception $e) {
                print $e->getMessage();
            }
        }
        
    }