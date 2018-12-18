

<?php
class Ticket
{
	public $arquivoJson;
	public $stringArquivo;
	public $arrayArquivo;
	public $arrayAux;
	public $arrayOrdenado;
	
	public function arquivo_json($nomeArquivo)
	{
		$this->arquivoJson = $nomeArquivo;
		$path = ".\\".$nomeArquivo;
		$this->stringArquivo = implode ('', file ($path));
		$this->arrayArquivo = json_decode($this->stringArquivo, true);
		//echo "arquivo: ".$this->arquivoJson;
	}
	
	public function conta_tickets_filtrados()
	{
		if ($this->arrayAux <> null)
			return count($this->arrayAux);
		else
			return 0;
		
	}
	
	
	/*public function mostra_ticket($keyInicial, $keyFinal)
	{
		
		for ($key = $keyInicial; $key <= $keyFinal; $key++)
		{
			if ($key >= $this->conta_tickets()) exit;
			echo "TICKET: ".$this->arrayArquivo[$key]["TicketID"]. "<br>";
			echo "Cliente: ".$this->arrayArquivo[$key]["CustomerName"]."<br>";
			echo "E-mail do cliente: ".$this->arrayArquivo[$key]["CustomerEmail"]."<br>";
			echo "Data de criação: ".$this->arrayArquivo[$key]["DateCreate"]."<br>";
			echo "Data de alteração: ".$this->arrayArquivo[$key]["DateUpdate"]."<br><br>";
			foreach ($this->arrayArquivo[$key]["Interactions"] as $mensagem)
			{
				echo "Assunto: ".$mensagem["Subject"]."<br>";
				echo $mensagem["Sender"].": ".$mensagem["Message"]."<br>";
				
			}
			echo "Prioridade: ".$this->arrayArquivo[$key]["Prioridade"]."<br>";
			echo "Pontuação: ".$this->arrayArquivo[$key]["Pontuacao"]."<br><br>";
		}
		
		
	}*/
	public function mostra_ticket($keyInicial, $keyFinal, $array)
	{
		
		for ($key = $keyInicial; $key <= $keyFinal; $key++)
		{
			
			if ($key >= $this->conta_tickets()) exit;
			echo "TICKET: ".$array[$key]["TicketID"]. "<br>";
			echo "Cliente: ".$array[$key]["CustomerName"]."<br>";
			echo "E-mail do cliente: ".$array[$key]["CustomerEmail"]."<br>";
			echo "Data de criação: ".$array[$key]["DateCreate"]."<br>";
			echo "Data de alteração: ".$array[$key]["DateUpdate"]."<br><br>";
			foreach ($array[$key]["Interactions"] as $mensagem)
			{
				echo "Assunto: ".$mensagem["Subject"]."<br>";
				echo $mensagem["Sender"].": ".$mensagem["Message"]."<br>";
				
			}
			echo "Prioridade: ".$array[$key]["Prioridade"]."<br>";
			echo "Pontuação: ".$array[$key]["Pontuacao"]."<br><br>";
		}
	}
	
	public function mostrar($keyInicial, $keyFinal)
	{
		//fiz essa aqui pra chamar direto do "inicio.php"
		$this->mostra_ticket($keyInicial, $keyFinal, $this->arrayArquivo);
	}
	public function filtra_ticket($filtro, $param_ini, $param_fim)
	{
		$indice = 0;
		if ($filtro == 'data')
		{
			foreach ($this->arrayArquivo as $key => $value)
			{	
				$dataCriacao = date('d/m/Y', strtotime($this->arrayArquivo[$key]["DateCreate"]));
				if ($dataCriacao >= $param_ini && $dataCriacao <= $param_fim)
				{
					$this->mostra_ticket($key,$key, $this->arrayArquivo);
				}
			}
			
			
		}
		
		if($filtro == 'prioridade')
		{
			
			foreach ($this->arrayArquivo as $key => $value)
			{
				
				if($this->arrayArquivo[$key]["Prioridade"] == $param_ini)
				{
					$this->mostra_ticket($key,$key,$this->arrayArquivo);
				}
				
			}
		}
		
	}
	
	public function ordena_tickets($ordenacao)
	{
		if ($ordenacao == 'data_criacao')
		{
			$this->arrayOrdenado = $this->arrayArquivo;
			
			usort($this->arrayOrdenado, function ($a, $b) {
			return $a['DateCreate'] <=> $b['DateCreate'];
			});
					
			$this->mostra_ticket(0,$this->conta_tickets()-1, $this->arrayOrdenado);
		}
		
		if ($ordenacao == 'data_alt')
		{
			$this->arrayOrdenado = $this->arrayArquivo;
			
			usort($this->arrayOrdenado, function ($a, $b) {
			return $a['DateUpdate'] <=> $b['DateUpdate'];
			});
					
			$this->mostra_ticket(0,$this->conta_tickets()-1, $this->arrayOrdenado);
		}
		
		if ($ordenacao == 'prioridade')
		{
			$this->arrayOrdenado = $this->arrayArquivo;
			
			usort($this->arrayOrdenado, function ($a, $b) {
			return $a['Prioridade'] <=> $b['Prioridade'];
			});
					
			$this->mostra_ticket(0,$this->conta_tickets()-1, $this->arrayOrdenado);
		}
		
	}
	public function conta_tickets()
	{
		return count($this->arrayArquivo);
		
	}
	
	
	
	
}


?>

