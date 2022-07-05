<?php
namespace Classes;

use Traits\TraitsParseUrl;

class ClassDispatch{
    private $init;
    private $url;
    private $dir=null;
    private $cont;
    private $file;
    private $page;

    use TraitsParseUrl;

    public function __construct()
    {
        $this->url=TraitsParseUrl::parseUrl();
        $this->cont=count($this->url);
        $this->verificaParametro();
    }

    #Verifica se existem parâmetros digitados pelo usuário
    private function verificaParametro()
    {
         if ($this->cont == 1 && empty($this->url[0])) {
            $this->page=DIRREQ.'views/index.php';
         } else {
            $this->verificaDir();
         }
    }

    #Verifica se o indice digitado pelo usuário é um diretorio
    private function verificaDir()
    {
        $this->init=$this->url[0].'/';
        for ($i=0; $i < $this->cont; $i++) { 
            if (is_dir($this->init)) {
                if($i==0){
                    $this->dir.=$this->init;
                }
                elseif(is_dir($this->dir.$this->url[$i])){
                    $this->dir.=$this->url[$i].'/';
                }
                else{
                    $this->file=$this->url[$i];
                    break;
                }                
            } else {
                if($i==0){
                    $this->dir.='views/';
                }

                if(is_dir(is_dir($this->dir.$this->url[$i]))){
                    $this->dir.=$this->url[$i].'/';
                }
                else{
                    $this->file=$this->$this->url[$i];
                    break;
                }
            }
            
        }
        
        $this->dir=str_replace("//", "/",$this->dir);
        $this->verificaFile();
    }

    #Verifica se existe o arquivo verificado, se não existir ele chama o index.php
    #se não chama a página 404
    private function verificaFile()
    {
        $dirAbs=DIRREQ.$this->dir;
        if(file_exists($dirAbs.$this->file.'.php')){
            $this->page=$dirAbs.$this->file.'.php';
        }
        elseif(file_exists($dirAbs.'index.php')){
            $this->page=$dirAbs.'index.php';
        }else{
            $this->page=DIRREQ.'views/404.php';
        }
    }

    #Retorna a página final para o sistema
    public function getInclusao()
    {
        return $this->page;
    }
}