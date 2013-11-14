<?php  
require_once 'inc/configuration.php';
$url = get('url');
$profundidade = get('depth')?get('depth'):5;

$crawler = new Crawler;
$crawler->procurar($url,$profundidade);
$crawler->resultado();
?>