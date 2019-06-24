<?php 

class Usuario
{
    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;

    public function getIdusuario(): int
    {
        return $this->idusuario;
    }

    public function setIdusuario($idusuario)
    {
        $this->idusuario = $idusuario;
    }

    public function getDeslogin(): string
    {
        return $this->deslogin;
    }

    public function setDeslogin($deslogin)
    {
        $this->deslogin = $deslogin;
    }

    public function getDessenha(): string
    {
        return $this->dessenha;
    }

    public function setDessenha($dessenha)
    {
        $this->dessenha = $dessenha;
    }

    public function getDtcadastro()
    {
        return $this->dtcadastro;
    }

    public function setDtcadastro($dtcadastro)
    {
        $this->dtcadastro = $dtcadastro;
    }



    /**
     * get usuario by id
     */

    public function loadById($id) {
        $sql = new Sql();
        
        /**
         * chama a função select que está na classe Sql
         * e a mesma va realizar a execução das instruções junto ao banco
         * e retorna os valores
         */
        $results = $sql->select("SELECT * FROM usuarios WHERE idusuario = :ID",array(
            ":ID" => $id
        ));

        /**
         * aqui fazemos a validação, se houver dados retornado
         * carregamos nosso objeto com esses dados
         */

         if (count($results)) {
             
            $row = $results[0];

            $this->setAttributes($row);
         }
    }


    public function loginExists($value): array
    {
        $sql = new Sql();

        $results = $sql->select("SELECT * FROM usuarios WHERE deslogin = :LOGIN",array(
            ":LOGIN" => $value
        ));

        $row = (count($results) > 0) ? $results[0] : array();
            
        return $row;
        
    }


    
    //faz insert e popula o objeto instanciado
    public function insert($login, $pwd)
    {
        
        $sql = new Sql();

        $sql->select("INSERT INTO usuarios (deslogin, dessenha) VALUES (:LOGIN,:PWD)",array(
            ":LOGIN"=>$login,
            ":PWD"=>$pwd
        ));

        $result = $sql->select("SELECT * FROM usuarios WHERE idusuario = last_insert_id()",array());

        if(count($result)){

            $this->setAttributes($result[0]);

        }

    }


    public function update($login, $pwd)
    {
        
        $id = $this->getIdusuario();

        $sql = new Sql();

        $sql->select("UPDATE usuarios SET deslogin=:LOGIN, dessenha=:PWD WHERE idusuario = :ID", array(
            ":LOGIN"=>$login,
            ":PWD"=>$pwd,
            ":ID"=>$id,
        ));

        $result = $sql->select("SELECT * FROM usuarios WHERE idusuario = :ID", array(
            ":ID"=>$id,
        ));

        $this->setAttributes($result[0]);

    }


    public function delete(): void
    {
        $sql = new Sql();

        $sql->query("DELETE FROM usuarios WHERE idusuario = :ID",array(
            ":ID"=>$this->getIdusuario()
        ));

        $this->setIdusuario(0);
        $this->setDeslogin("");
        $this->setDessenha("");
        $this->setDtcadastro(new DateTime());

    }




    private function setAttributes($data)
    {

        //popula o objeto
        $this->setIdusuario($data['idusuario']);
        $this->setDeslogin($data['deslogin']);
        $this->setDessenha($data['dessenha']);
        $this->setDtcadastro(new DateTime($data['dtcadastro']));

    }


    /**
     * o metodo mágico toString permite retornar uma resposta predefinida
     * quando se tenta imprimir uma objeto na tela
     */
    public function __toString()
    {
        return json_encode(
            array(
                "idusuario" => $this->getIdusuario(),
                "deslogin" => $this->getdeslogin(),
                "dessenha" => $this->getDessenha(),
                "dtcadastro" => $this->getDtcadastro()->format("d/m/Y H:i:s")
            )
            );
    }


}

?>