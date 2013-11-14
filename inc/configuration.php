<?php 
//configuration.php
session_start();
setlocale(LC_ALL,null);
setlocale(LC_ALL,"pt_BR");

function manipuladorDeErro($number,$msg,$file,$line,$erro){
	//notices de menor gravidade, por exemplo definição de
	//variáveis, sem o comando isset.
	if($number >= 10  )	{
	echo "<br/></br>Erro:".$msg."<br/>Arquivo: ".$file.
	"<br/>Linha: ".$line;
	}
}
set_error_handler("manipuladorDeErro");


$path = $_SERVER["DOCUMENT_ROOT"]."/";

//criando um método mágico que será explicado em detalhes
//no cap. 8 para carregar classes automaticamente
//para que funcione bem, precisamos seguir um padrão.
//Classe.class.php Ex:  Sql.class.php
function __autoload($class){
	require_once $path."class/$class.class.php";
}

//criando funções úteis para formulário
function get($x){
	if(isset($x)){
return trim(str_replace("'","",addslashes($_GET[$x])));
	}
}

function post($x){
	if(isset($x)){
return trim(str_replace("'","",addslashes($_POST[$x])));
	}
}

$Banco = "Sql\MySQL\Sql";

 ?>