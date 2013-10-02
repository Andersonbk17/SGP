<?php
    include_once 'Email.php';
	class Funcionario{
			private $idFuncionario;
			private $nome;
			private $rg;
			private $reservistaMilitar;
			private $tituloEleitoral;
			private $dataNascimento;
			private $dataCasamento;
			private $certidaoNascimento;
			private $certidaoCasamentoDivorcio;
			private $pendencias; 
			private $nomePai; 
			private $nomeMae; 
			private $cpf; 
			private $conjugue;
                        private $idTipo_Sanguineo; //FOREING KEY
			private $idEstado_Civil; //FOREING KEY
			private $sexo;
                        private $portariaNomeacao;
                        private $dataPosse;
			private $dataExercicio;
			private $portariaFG;
                        private $portariaCD;
			private $numeroSiape;
                        private $idCampus; //FOREING KEY
			private $idTitulacao; //FOREING KEY
			private $endereco;
			private $endNumero;
			private $endBairro;
			private $endComplemento;
			private $endCidade;
                        private $cep;
                        private $email;
                        private $casadoDivorciado;
			
			
			
			//Construtores
                        /*
			function __construct($idFuncionario,$nome,$rg,$reservistaMilitar,$tituloEleitoral,$dataNascimento,$dataCasamento,$certidaoCasamentoDivorcio,$pendencias,$nomePai,$nomeMae,$conjugue){
				$this->idFuncionario = $$idFuncionario;
				$this->nome = $nome;
				$this->rg = $rg;
				$this->reservistaMilitar = $reservistaMilitar;
				$this->tituloEleitoral = $tituloEleitoral;
				$this->dataNascimento = $dataNascimento;
				$this->dataCasamento = $dataCasamento;
				$this->certidaoNascimento = $certidaoNascimento;
				$this->certidaoCasamentoDivorcio = $certidaoCasamentoDivorcio;
				$this->pendencias = $pendencias;
				$this->nomePai = $nomePai;
				$this->nomeMae = $nomeMae;
				$this->cpf = $cpf;
				$this->conjugue = $conjugue;
				$this->idTipo_Sanguineo = $idTipo_Sanguineo; //FOREING KEY
				$this->idEstado_Civil = $idEstado_Civil; //FOREING KEY
				$this->sexo = $sexo;
				$this->portariaNomeacao = $portariaNomeacao;
				$this->dataPosse = $dataPosse;
				$this->dataExercicio = $dataExercicio;
				$this->portariaFG = $portariaFG;
				$this->portariaCD = $portariaCD;
				$this->numeroSiape = $numeroSiape;
				$this->idCampus = $idCampus; //FOREING KEY
			    $this->idTitulacao = $idTitulacao; //FOREING KEY
				$this->endereco = $endereco;
				$this->endNumero = $endNumero;
				$this->endBairro = $endBairro;
				$this->endComplemento = $endComplemento;
			    $this->endCidade = $endCidade;
			}
			*/
			function __construct(){
				$this->idFuncionario = 0;
				$this->nome = "";
				$this->rg = 0;
				$this->reservistaMilitar = "";
				$this->tituloEleitoral = "";
				$this->dataNascimento = "";
				$this->dataCasamento = "";
				$this->certidaoNascimento = "";
				$this->certidaoCasamentoDivorcio = "";
				$this->pendencias = "";
				$this->nomePai = "";
				$this->nomeMae = "";
				$this->cpf = "";
				$this->conjugue = "";
				$this->idTipo_Sanguineo = 0; //FOREING KEY
				$this->idEstado_Civil = 0; //FOREING KEY
				$this->sexo = "";
				$this->portariaNomeacao = "";
				$this->dataPosse = "";
				$this->dataExercicio = "";
				$this->portariaFG = "";
				$this->portariaCD = "";
				$this->numeroSiape = "";
				$this->idCampus = 0; //FOREING KEY
			    $this->idTitulacao = 0; //FOREING KEY
				$this->endereco = "";
				$this->endNumero = "";
				$this->endBairro = "";
				$this->endComplemento = "";
			    $this->endCidade = "";
                            $this->cep = "";
                            $this->email = "";
                            $this->casadoDivorciado = 0;
			}
			
			//Métodos
			public function setId($idFuncionario){
				$this->idFuncionario = addslashes($idFuncionario);
			}
			//----
			public function setNome($nome){
				$this->nome = addslashes($nome);
			}
			//----
			public function setRg($rg){
				$this->rg = addslashes($rg);
			}
			//----
			public function setReservistaMilitar($reservistaMilitar){
				$this->reservistaMilitar = addslashes($reservistaMilitar);
			}
			//----
			public function setTituloEleitoral($tituloEleitoral){
				$this->tituloEleitoral = addslashes($tituloEleitoral);
			}
			//----
			public function setDataNascimento($dataNascimento){
				$this->dataNascimento = addslashes($dataNascimento);
			}
			//----
			public function setDataCasamento($dataCasamento){
				$this->dataCasamento = addslashes($dataCasamento);
			}
			//----
			public function setCertidaoNascimento($certidaoNascimento){
				$this->certidaoNascimento = addslashes($certidaoNascimento);
			}
			//----
			public function setCertidaoCasamentoDivorcio($certidaoCasamentoDivorcio){
				$this->certidaoCasamentoDivorcio = addslashes($certidaoCasamentoDivorcio);
			}
			//----
			public function setPendencias($pendencias){
				$this->pendencias = addslashes($pendencias);
			}
			//----
			public function setNomePai($nomePai){
				$this->nomePai = addslashes($nomePai);
			}
			//----
			public function setNomeMae($nomeMae){
				$this->nomeMae = addslashes($nomeMae);
			}
			//----
			public function setCpf($cpf){
				$this->cpf = addslashes($cpf);
			}
			//----
			public function setConjugue($conjugue){
				$this->conjugue = addslashes($conjugue);
			}
			//----
			public function setSexo($sexo){
				$this->sexo = addslashes($sexo);
			}
			//----
			public function setPortariaNomeacao($portariaNomeacao){
				$this->portariaNomeacao = addslashes($portariaNomeacao);
			}
			//----
			public function setDataPosse($dataPosse){
				$this->dataPosse = addslashes($dataPosse);
			}
			//----
			public function setDataExercicio($dataExercicio){
				$this->dataExercicio = addslashes($dataExercicio);
			}
			//----
			public function setPortariaFG($portariaFG){
				$this->portariaFG = addslashes($portariaFG);
			}
			//----
			public function setPortariaCD($portariaCD){
				$this->portariaCD = addslashes($portariaCD);
			}
			//----
			public function setNumeroSiape($numeroSiape){
				$this->numeroSiape = addslashes($numeroSiape);
			}
			//----
			public function setEndereco($endereco){
				$this->endereco = addslashes($endereco);
			}
			//----
			public function setEndNumero($endNumero){
				$this->endNumero = addslashes($endNumero);
			}
			//----
			public function setEndBairro($endBairro){
				$this->endBairro = addslashes($endBairro);
			}
			//----
			public function setEndComplemento($endComplemento){
				$this->endComplemento = addslashes($endComplemento);
			}
			//----
			public function setEndCidade($endCidade){
				$this->endCidade = addslashes($endCidade);
                                
			}
                        
                        public function setIdTipo_Sanguineo($idTipo_Sanguineo) {
                            $this->idTipo_Sanguineo = $idTipo_Sanguineo;
                        }

                        public function setIdEstado_Civil($idEstado_Civil) {
                            $this->idEstado_Civil = $idEstado_Civil;
                        }

                        public function setIdCampus($idCampus) {
                            $this->idCampus = $idCampus;
                        }

                        public function setIdTitulacao($idTitulacao) {
                            $this->idTitulacao = $idTitulacao;
                        }
                        
                        public function setCep($cep) {
                            $this->cep = $cep;
                        }

                        
                                                
			// FIM METODOS SETTERS
			
			
			
			//====
		    
		    public function getId(){
				return $this->idFuncionario;
			}
			
			public function getNome(){
				return $this->nome;
			}
			//----
			public function getRg(){
				return $this->rg;
			}
			//----
			public function getReservistaMilitar(){
				return $this->reservistaMilitar;
			}
			//----
			public function getTituloEleitoral(){
				return $this->tituloEleitoral;
			}
			//----
			public function getDataNascimento(){
				return $this->dataNascimento;
			}
			//----
			public function getDataCasamento(){
				return $this->dataCasamento;
			}
			//----
			public function getCertidaoNascimento(){
				return $this->certidaoNascimento;
			}
			//----
			public function getCertidaoCasamentoDivorcio(){
				return $this->certidaoCasamentoDivorcio;
			}
			//----
			public function getPendencias(){
				return $this->pendencias;
			}
			//----
			public function getNomePai(){
				return $this->nomePai;
			}
			//----
			public function getNomeMae(){
				return $this->nomeMae;
			}
			//----
			public function getCpf(){
				return $this->cpf;
			}
			//----
			public function getConjugue(){
				return $this->conjugue;
			}
			//----
			public function getSexo(){
				return $this->sexo;
			}
			//----
			public function getPortariaNomeacao(){
				return $this->portariaNomeacao;
			}
			//----
			public function getDataPosse(){
				return $this->dataPosse;
			}
			//----
			public function getDataExercicio(){
				return $this->dataExercicio;
			}
			//----
			public function getPortariaFG(){
				return $this->portariaFG;
			}
			//----
			public function getPortariaCD(){
				return $this->portariaCD;
			}
			//----
			public function getNumeroSiape(){
				return $this->numeroSiape;
			}
			//----
			public function getEndereco(){
				return $this->endereco;
			}
			//----
			public function getEndNumero(){
				return $this->endNumero;
			}
			//----
			public function getEndBairro(){
				return $this->endBairro;
			}
			//----
			public function getEndComplemento(){
				return $this->endComplemento;
			}
			//----
			public function getEndCidade(){
				return $this->endCidade;
			}
                        
                        public function getIdTipo_Sanguineo() {
                            return $this->idTipo_Sanguineo;
                        }

                        public function getIdEstado_Civil() {
                            return $this->idEstado_Civil;
                        }

                        public function getIdCampus() {
                            return $this->idCampus;
                        }

                        public function getIdTitulacao() {
                            return $this->idTitulacao;
                        }
                        
                        public function getCep() {
                            return $this->cep;
                        }
                        public function getEmail() {
                            return $this->email;
                        }

                        public function setEmail($email) {
                            $this->email = $email;
                        }
                        
                        public function getCasadoDivorciado() {
                            return $this->casadoDivorciado;
                        }

                        public function setCasadoDivorciado($casadoDivorciado) {
                            $this->casadoDivorciado = $casadoDivorciado;
                        }







	}
?>
