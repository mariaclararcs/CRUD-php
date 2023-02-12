<?php
class Cli{
    const AC_LIST = 1;
    const AC_CREATE = 2;
    const AC_UPDATE = 3;
    const AC_DELETE = 4;
    const AC_EXIT = 5;
    private $pdo;

    public function __construct(){
        $this->pdo = new PDO('mysql:host=localhost;dbname=amazon', "root", "");
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
                self::AC_LIST=>$this->list(),
                self::AC_CREATE=>$this->create(),
                self::AC_UPDATE=>$this->update(),
                self::AC_DELETE=>$this->delete(),
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
        $ch = $this->input();
        if($ch =='S'){
            $database = new PDO("mysql:host=localhost; dbname=amazon", "root", "");
            $sql = "INSERT INTO users VALUES (`null`, `:name`, `:password`, `:email`)";
            $comando = $this->pdo->prepare($sql);
            $comando->bindParam(":name", $name, PDO::PARAM_STR);
            $comando->bindParam(":password", $password, PDO::PARAM_STR);
            $comando->bindParam(":email", $email, PDO::PARAM_STR);
            $comando->execute();
        }
    }
    private function list(){
        $sql = "SELECT * FROM users";
        $comando = $this->pdo->prepare($sql);
        $comando->execute();
        if($comando->rowCount() == 0){
            $this->output("Não encontrado.");
            return;
        }
        $lindao = $comando->fetchAll(PDO::FETCH_ASSOC);
        $this->output("Listando");
        foreach($lindao as $gatao){
            $this->output($gatao['id'].' '.$gatao['name'].' '.$gatao['password'].' '.$gatao['email']);
        }
    }
    private function delete(){
        $this->output("Informe o ID:");
        $id = $this->input();
        $sql = "SELECT id FROM users WHERE id = :id";
        $query = $this->pdo->prepare($sql);
        $query->bindParam(":id", $id, PDO::PARAM_INT);
        $query->execute();
        $this->output("Deletando");
    }
    private function update(){
        $this->output("Informe o ID:");
        $id = $this->input();
        $sql = "SELECT * FROM users WHERE id = :id";
        $query = $this->pdo->prepare($sql);
        $query->bindParam(":id", $id, PDO::PARAM_INT);
        $query->execute();
        if($query->rowCount() == 0){
            $this->output("Pessoa não cadastrada.");
            return;
        }
        $db = $query->fetch(PDO::FETCH_ASSOC);
        $this->output("Informe seu nome:");
        $name = $this->input();
        //$name = empty($name) ? $gatao['name'] : $name;
        $this->output("Informe a senha:");
        $password = $this->input();
        //$password = empty($password) ? $gatao['password'] : $password;
        $this->output("Informe a email:");
        $email = $this->input();
        //$email = empty($email) ? $gatao['email'] : $email;
        $sq = "UPDATE users SET `name` = `:name`, `password` = `:password`, `email` = `:email` WHERE id = :id";
        $query = $this->pdo->prepare($sq);
        $query->bindParam(":name", $name, PDO::PARAM_STR);
        $query->bindParam(":password", $password, PDO::PARAM_STR);
        $query->bindParam(":email", $email, PDO::PARAM_STR);
        $query->bindParam(":id", $id, PDO::PARAM_INT);
        $this->output("Atualizado com sucesso!");
    }
}