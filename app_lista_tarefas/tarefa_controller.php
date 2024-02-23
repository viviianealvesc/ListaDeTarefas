<?php

// Importando os scripts
require "../app_lista_tarefas/conexao.php";
require "../app_lista_tarefas/tarefa_service.php";
require "../app_lista_tarefas/tarefa_model.php";

// assim a nossa aplicaçao ira saber tratar as informacoes vindas do parametro e a variavel previamente estabelecida
$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

if($acao == 'inserir') {

    $tarefa = new Tarefa();
    $tarefa->__set('tarefa', $_POST['tarefa']);

    $conexao = new Conexao(); 

    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefaService->inserir();

    //Após a inserçao do registro
    header('Location: nova_tarefa.php?inclusao=1');

} else if($acao == 'recuperar') {

    $tarefa = new Tarefa();
    $conexao = new Conexao(); 

    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefas = $tarefaService->recuperar();//Vamos receber como retorno a nossa lista de array "return $stmt->fetchAll(PDO::FETCH_OBJ)"

}else if($acao == 'atualizar') {

    $tarefa = new Tarefa();
    $tarefa->__set('id', $_POST['id']);
    $tarefa->__set('tarefa', $_POST['tarefa']);

    $conexao = new Conexao(); 

    $tarefaService = new TarefaService($conexao, $tarefa);

    //Se o retorno dessa atualizacao for 1 (true) eu executo essa instrução
    //Isso pois o  "return" retorna 1 para verdadeiro e vazio para falso
    if($tarefaService->atualizar()) {

        if(isset($_GET['pag']) && $_GET['pag'] == 'index') {

            header('Location: index.php');

        }else {

            header('Location: todas_tarefas.php');
        }
    }

   
}else if($acao == 'remover') {

    $tarefa = new Tarefa();
    $tarefa->__set('id', $_GET['id']);

    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefaService->remover();

    if(isset($_GET['pag']) && $_GET['pag'] == 'index') {

        header('Location: index.php');

    }else {

        header('Location: todas_tarefas.php');
    }
    

}else if($acao == 'marcarRealizada') {

    $tarefa = new Tarefa();
    $tarefa->__set('id', $_GET['id']);
    $tarefa->__set('id_status', 2);

    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefaService->marcarRealizada();

    if(isset($_GET['pag']) && $_GET['pag'] == 'index') {

        header('Location: index.php');

    }else {

        header('Location: todas_tarefas.php');
    }
    

} else if($acao == 'pendente') {

    $tarefa = new Tarefa();

    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefas = $tarefaService->pendente();
}