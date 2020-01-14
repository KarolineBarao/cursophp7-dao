<?php

class Usuario{

	private $idUsuario;
	private $desLogin;
	private $desSenha;
	private $dtCadastro;

	public function getIdUsuario(){
		return $this->idUsuario;
	}

	public function setIdUsuario($value){
		$this->idUsuario = $value;
	}

	public function getDesLogin(){
		return $this->desLogin;
	}

	public function setDesLogin($value){
		$this->desLogin = $value;
	}

	public function getDesSenha(){
		return $this->desSenha;
	}

	public function setDesSenha($value){
		$this->desSenha = $value;
	}

	public function getDtCadastro(){
		return $this->dtCadastro;
	}

	public function setDtCadastro($value){
		$this->dtCadastro = $value;
	}

	public function loadById($id){
		$sql = new Sql();

		$results = $sql->select("SELECT *FROM tb_usuarios WHERE idUsuario = :ID", array(":ID"=>$id));

		if(count($results)>0){
			
			$this->setData($results[0]);
		}
	}

	public static function getList(){
		$sql = new Sql();

		return $sql->select("SELECT *FROM tb_usuarios ORDER BY desLogin");
	}

	public static function search($login){
		$sql = new Sql();
		return $sql->select("SELECT *FROM tb_usuarios WHERE desLogin LIKE :SEARCH ORDER BY desLogin", array(':SEARCH'=>"%".$login."%"
		));
	}

	public function login($login, $password){

		$sql = new Sql();

		$results = $sql->select("SELECT *FROM tb_usuarios WHERE desLogin=:LOGIN AND desSenha=:PASSWORD", array(
			":LOGIN"=>$login,
			":PASSWORD"=>$password
		));

		if(count($results)>0){
			
			$this->setData($results[0]);
			
		} else{
			throw new Exception("Login e/ou senha invalidos");
			
		}


	}

	public function setData($data){
		$this->setIdUsuario($data['idUsuario']);
		$this->setDesLogin($data['desLogin']);
		$this->setDesSenha($data['desSenha']);
		$this->setDtCadastro(new DateTime($data['dtCadastro']));


	}

	public function insert(){

		$sql = new Sql();
		$results=$sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
			':LOGIN'=>$this->getDesLogin(),
			':PASSWORD'=>$this->getDesSenha()
		));

		if (count($results)>0){
			$this->setData($results[0]);
		}

	}

	public function __construct($login ="", $password =""){
		$this->setDesLogin($login);
		$this->setDesSenha($password);
	}


	public function update($login, $password){

		$this->setDesLogin($login);
		$this->setDesSenha($password);
		$sql= new Sql;

		$sql->query("UPDATE tb_usuarios SET desLogin = :LOGIN, desSenha =:PASSWORD WHERE idUsuario= :ID", array(
			':LOGIN'=>$this->getDesLogin(),
			':PASSWORD'=>$this->getDesSenha(),
			':ID'=>$this->getIdUsuario()
		));
	}

	public function delete(){
		$sql = new Sql();
		$sql->query("DELETE FROM tb_usuarios WHERE idUsuario = :ID", array(
			':ID'=>$this->getIdUsuario()
		));

		$this->setIdUsuario(0);
		$this->setDesLogin("");
		$this->setDesSenha("");
		$this->setDtCadastro(new DateTime());
	}



	public function __toString(){
		return json_encode(array(
			"idUsuario"=>$this->getIdUsuario(),
			"desLogin"=>$this->getDesLogin(),
			"desSenha"=>$this->getDesSenha(),
			"dtCadastro"=>$this->getDtCadastro()->format("d/m/Y H:i:s")
		));
	}

}