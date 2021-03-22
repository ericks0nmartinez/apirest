CREATE DATABASE IF NOT EXISTS filial;
use filial;

CREATE TABLE  IF NOT EXISTS estoque(
                        id int NOT NULL primary key AUTO_INCREMENT comment 'primary key',
                        create_time DATETIME COMMENT 'create time',
                        update_time DATETIME COMMENT 'update time',
                        id_funcionario INT NOT NULL,
                        descricao VARCHAR (255),
                        nome_produto VARCHAR(255) NOT NULL,
                        preco FLOAT NOT NULL
) default charset utf8 comment '';
CREATE TABLE  IF NOT EXISTS funcionario(
                            id int NOT NULL PRIMARY key AUTO_INCREMENT COMMENT 'primary key',
                            nome VARCHAR (255) not NULL,
                            create_time DATETIME COMMENT 'create time',
                            update_time DATETIME COMMENT 'update time'
) default charset utf8 comment '';
ALTER TABLE
    `estoque`
    ADD
        CONSTRAINT `fk_funcionario` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionario` (`id`);

ALTER TABLE estoque ADD COLUMN quantidate int NOT NULL;