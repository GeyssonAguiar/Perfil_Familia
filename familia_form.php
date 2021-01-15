<?php 
    require 'classes/Familia.php';

    if(!empty($_REQUEST)){
        
        $familia_criada = '';
        
        if($_REQUEST['action'] == 'create' && $_POST['nome_familia']) {
            try {
                $nome_familia = $_POST['nome_familia'];
                // Colocar essa variavel do lado de fora
                $familias = Familia::lista();
                
                foreach($familias as $familia) {
                    if(strtoupper($nome_familia) == strtoupper($familia['nome'])) {
                        echo 'familia já criada';
                        $familia_criada = TRUE;
                    }    
                }
                
                if(!$familia_criada) {
                    $result_cria_tabela = Familia::cria($nome_familia);
                    $result_insere_familia = Familia::insere($nome_familia);
                }   
            }
            catch(Exception $e) {
                print $e->getMessage();
            }
        }
    }
    try {
        $familias = Familia::lista();
    }   
    catch (Exception $e) {
        print $e->getMessage();
    }
    
    $opcoes = '';
    $form = file_get_contents('html/form.html');
    
    foreach($familias as $familia) {
        $opcao = file_get_contents('html/familia.html');
        $opcao = str_replace('{nome}', $familia['nome'], $opcao);
        $opcoes .= $opcao;
    }

    $form = str_replace('{opcoes}', $opcoes, $form);
    print($form); 
    

