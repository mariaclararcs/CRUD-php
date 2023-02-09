<?php
class Cli{
    const AC_LIST = 1;
    const AC_CREATE = 2;
    const AC_UPDATE = 3;
    const AC_DELETE = 4;
    const AC_EXIT = 5;
    private $pdo;

    public function __construct(){
        $this->pdo = new PDO("mysql:host=localhost; dbname=amazon", "root", "");
    }
    public function teste(){
        echo "-----------" . PHP_EOL;
    }
    private function avaliarOpcoes(){
        $this->output("Cli");
        $this->teste();
        $this->output("1- Listar");
        $this->output("2- Criar");
        $this->output("3- Editar");
        $this->output("4- Deletar");
        $this->output("5- Sair");
    }
    private function output(string $msg){
        echo $msg . PHP_EOL;
    }
    private function input(){
        return trim(fgets(STDIN));
    }
    public function run(){
        while(true){
            $this->avaliarOpcoes();
            $ch = (int) $this->input();
            match ($ch) {
                self::AC_EXIT=>$this->exit(),
                self::AC_LIST=>
                self::AC_CREATE=>$this->create(),
                self::AC_UPDATE=>
                self::AC_DELETE=>
            };
        }
    }

    private function exit(){
        $this->output("Finalizando...");
        die;
    }
    private function create(){
        $this->output("Qual o seu nome?");
        $name = $this->input();
        $this->output("Qual o seu e-mail?");
        $email = $this->input();
        $this->output("Qual a sua senha?");
        $password = $this->input();
        $this->teste();
        $this->output("Nome: $name");
        $this->output("E-mail: $email");
        $this->output("Senha: $password");
        $this->teste();
        $this->output("Certeza que quer cadastrar? S/N");
        if($ch=='S'){
            $database = new PDO("mysql:host=localhost; dbname=amazon", "root", "");
            $sql = "INSERT INTO users VALUES (`null`, `:name`, `:password`, `:email`)";
            $comando = $this->pdo->prepare($sql);
            $comando->bindParam(":name", $name, PDO::PARAM_STR);
            $comando->bindParam(":password", $password, PDO::PARAM_STR);
            $comando->bindParam(":email", $email, PDO::PARAM_STR);
            $comando->execute();
        }
    }
}