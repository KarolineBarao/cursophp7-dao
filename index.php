<?php

require_once("config.php");

// carrega um usuário;
//$root = new Usuario();
//$root->loadById(3);
//echo $root;

// carrega uma lista de usuários

//$lista= Usuario::getList();
//echo json_encode($lista);

// carrega uma lista de usuario atraves do login
//$search = Usuario::search("jo");
//echo json_encode($search);

// carrega um usuario usando login e senha

//$usuario =  new Usuario();
//$usuario->login('jose', '1234567');

//echo $usuario;

// Criando um novo usuario com insert
//$aluno = new Usuario("aluno", "@luno");
//$aluno->insert();
//echo $aluno;


// alterar um usuario
/*
$usuario = new Usuario();

$usuario->loadById(8);

$usuario->update("professor", "kjhrjetj");

echo $usuario;,
*/

$usuario = new Usuario();

$usuario->loadById(7);
$usuario->delete();
echo $usuario;
