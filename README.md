
Projeto de faculdade do segundo semestre

Um site voltado para colecionadores com o objetivo de cadastrar itens para os mesmos,
após o usuario criar uma conta ele poderá cadastrar um novo item e vizualiza-lo 
na aba de coleção, também é possivel modificar o perfil e os itens cadastrados.

Para a utilização do projeto deve-se recriar o banco

Comandos para recriar o banco: 

CREATE DATABASE testeprojeto;

USE DATABASE testeprojeto;

CREATE TABLE registros(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(30) NOT NULL,
    email VARCHAR(200) NOT NULL,
    password VARCHAR(255) NOT NULL,
    perfilImage VARCHAR(255),
    description VARCHAR(300)
);

CREATE TABLE itens(
    id INT PRIMARY KEY AUTO_INCREMENT,
    item_name VARCHAR(50) NOT NULL,
    item_status VARCHAR(25) NOT NULL,
    item_desc VARCHAR(300),
    item_path VARCHAR(255),
    id_registro INT(11),
    FOREIGN KEY (id_registro) REFERENCES registros(id)
);
