<?php


//CRUD
class TarefaService {

	private $conexao;
	private $tarefa;
    
	/*Aqui eu estou chamando o atributo $conexao e especificando que ele é da classe 
	Conexao e fazemos o mesmo com o atributo $tarefa. Fazemos isso pois temos que usar 
	esses atributos aqui no TarefaService tambem. */
	public function __construct(Conexao $conexao, Tarefa $tarefa) {
		$this->conexao = $conexao->conectar();
		$this->tarefa->$tarefa;
	}

	public function inserir() { //create
		$query = 'INSERT INTO tb_tarefas(tarefa) VALUES (?)';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(1, $this->tarefa->__get('tarefa'));
		$stmt->execute();
	}

	public function recuperar() { //read
		$query = '
		select 
			t.id, s.status, t.tarefa 
		from 
			tb_tarefas as t
			left join tb_status as s on (t.id_status = s.id)
	';
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function atualizar() { //update
		$query = 'UPDATE tb_tarefas SET tarefa = ? WHERE id = ?';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(1, $this->tarefa->__get('tarefa'));
		$stmt->bindValue(2, $this->tarefa->__get('id'));

		return $stmt->execute();
	}

	public function remover() { //delete
		$query = 'DELETE FROM tb_tarefas WHERE id = :id';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':id', $this->tarefa->__get('id'));
		$stmt->execute();
	}

	public function marcarRealizada() { 
		$query = 'UPDATE tb_tarefas SET id_status = ? WHERE id = ?';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(1, $this->tarefa->__get('id_status'));
		$stmt->bindValue(2, $this->tarefa->__get('id'));

		return $stmt->execute();
	}

	public function pendente() { //read
		$query = 'SELECT id, tarefa, id_status FROM tb_tarefas WHERE id_status = 1';
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	
}

?>