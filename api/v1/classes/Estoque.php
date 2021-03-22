<?php
class Estoque
{
    static function conectar(){
        $con = new PDO('mysql: host=localhost; dbname=filial;', 'pepeu', 'Git@18203568');
        return $con;
    }

    public function selectAll($param)
    {
        $con = self::conectar();
        $sql = "SELECT estoque.id as codigo_produto,
            nome_produto,
            descricao,
            preco,
            quantidate,
            date_format(estoque.create_time,'%d/%m/%y') as data_criacao,
            date_format(estoque.update_time,'%d/%m/%y') as data_atualizacao,
            nome as funcionario_cadastro
            FROM estoque JOIN funcionario f on estoque.id_funcionario = f.id ORDER BY estoque.id ASC;";
        $sql = $con->prepare($sql);
        $sql->execute();
        $resultado = [];
        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            $resultado[] = $row;
        }
        if (!$resultado) {
            throw new Exception('Nenhum produto no estoque');
        }
        return $resultado;
    }

    public function selectID($param)
    {
        $id = explode('=',$param);
        $con = self::conectar();
        $sql = "SELECT estoque.id as codigo_produto,
            nome_produto,
            descricao,
            preco,
            quantidate,
            date_format(estoque.create_time,'%d/%m/%y') as data_criacao,
            date_format(estoque.update_time,'%d/%m/%y') as data_atualizacao,
            nome as funcionario_cadastro
            FROM estoque JOIN funcionario f on estoque.id_funcionario = f.id WHERE estoque.id = :id;";
        $sql = $con->prepare($sql);
        $sql->bindValue(':id', $id[1]);
        $sql->execute();
        $resultado = [];
        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            $resultado[] = mb_convert_encoding($row, "UTF-8");
        }
        if (!$resultado) {
            throw new Exception('Nenhum produto no estoque');
        }
        return $resultado;
    }
    public function inserir($param){
        $con = self::conectar();
        $sql = "INSERT INTO estoque (create_time,id_funcionario, descricao, nome_produto, preco, quantidate) VALUES (:create_time, :id_funcionario, :descricao, :nome_produto, :preco, :quantidade);";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(':create_time', '2021-03-20 00:00:00');
        $stmt->bindValue(':id_funcionario', 1);
        $stmt->bindValue(':descricao', 'De frango');
        $stmt->bindValue(':nome_produto', 'Empadão');
        $stmt->bindValue(':preco', 10.50);
        $stmt->bindValue(':quantidade', 20);

        if($stmt === false){
            throw new RuntimeException($this->connection->errorInfo()[2]);
        }
        return $stmt->execute();
    }

    public function atualizar($param)
    {
        $con = self::conectar();
        $sql = "UPDATE estoque SET update_time = :update_time , id_funcionario = :id_funcionario, descricao = :descricao , preco = :preco, quantidate = :quantidade WHERE id = :id AND nome_produto = :nome_produto;";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(':update_time', '2021-03-21 00:00:00');
        $stmt->bindValue(':id_funcionario', 1);
        $stmt->bindValue(':descricao', 'De frango com Catupiri');
        $stmt->bindValue(':nome_produto', 'Empadão');
        $stmt->bindValue(':preco', 25);
        $stmt->bindValue(':quantidade', 20);
        $stmt->bindValue(':id', 7);

        if($stmt === false){
            throw new RuntimeException($this->connection->errorInfo()[2]);
        }
        return $stmt->execute();
    }

    public function deletar($param)
    {
        $id = explode('=',$param);

        $con = self::conectar();
        $sql = "DELETE FROM estoque WHERE id = :id";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(':id', $id[1]);

        if($stmt === false){
            throw new RuntimeException($this->connection->errorInfo()[2]);
        }
        return $stmt->execute();
    }
}
