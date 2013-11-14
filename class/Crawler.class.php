<?php  
/**
* @author Humberto
* @date 2013-11-12
* @objective procurar os links externos a partir de uma url fornecida pelo usuário
*/
class Crawler
{	
	public $arrayJSON;
	
	/**
	* @param url: url a ser procurada
	* @param depth: quantidade de dominios diferentes a serem considerados
	*/
	set_time_limit(0);
	function procurar($url,$depth)
	{
		static $resultado = array();
		$partes = parse_url($url);
		$dominio = explode(".", $partes['host']);
		if(isset($resultado[$dominio[1]]) || $depth == 0){
			return;
		}

		if ($dominio[1] == "com") { 
			$resultado[$dominio[0]] = $url;
		}
		else{
			$resultado[$dominio[1]] = $url;
		}
		
		$dom = new DOMDocument('1.0');
		@$dom->loadHTMLFile($url);
		$href = "";
		$links = $dom->getElementsByTagName('a');
		foreach ($links as $elemento):
			$href = $elemento->getAttribute('href');
			if(strpos($href,'http') !== 0):
				$caminho = '/' . ltrim($href,'/');
				$href = $partes['scheme']. "://";
				if (isset($partes['user']) && isset($partes['pass'])) {
					$href .= $partes['user'] . ":" . $partes['pass'] . "@";	
				}
				$href .= $partes['host'];
				if (isset($partes['port'])) {			
					$href .= ":" . $partes['port'];
				}
				$href .= $caminho;
			endif;
			if (count($resultado) < 100) 
			{
				$this->procurar($href,$depth-1);
			}
			else{
				exit();
			}
		endforeach;

	}//end function

	public function resultado()
	{
		echo "<pre>";
		print(json_encode($this->arrayJSON));
		echo "</pre>";
	}

}//end class
?>