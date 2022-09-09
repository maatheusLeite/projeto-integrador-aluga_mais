/* Informações do banco de dados
 *
 *  Servidor usado: XAMPP SERVER
 *
 *  SGBD: MYSQL
 *  Nome do banco = "alugamais";
 *  Host = "localhost"; 
 *  Usuário = "root";
 *  Senha = "";
 *  Porta = "3306";
 *  
 *  Tipo de conexão: PHP PDO;
 *
 *  Tabelas do banco: USUARIOS, LOCACOES, ENDERECOS;
 *       
 */

-- Script de criação do banco

CREATE DATABASE alugamais;

USE alugamais;

CREATE TABLE USUARIO(
    IDUSUARIO INT PRIMARY KEY AUTO_INCREMENT,
    NOME VARCHAR(100) NOT NULL,
    EMAIL VARCHAR(100) NOT NULL UNIQUE,
    SENHA VARCHAR(100) NOT NULL
);

CREATE TABLE LOCALIDADE(
    IDLOCALIDADE INT PRIMARY KEY AUTO_INCREMENT,
    NOME VARCHAR(100) NOT NULL,
    TIPO ENUM('Fechado', 'ArLivre', 'Buffet') NOT NULL,
    VALOR FLOAT(6,2) NOT NULL,
    PAGAMENTO ENUM('Hora', 'Diária') NOT NULL,
    ID_USUARIO INT NOT NULL,
    FOREIGN KEY(ID_USUARIO)
    REFERENCES USUARIO(IDUSUARIO)
);

CREATE TABLE ENDERECO(
    IDENDERECO INT PRIMARY KEY AUTO_INCREMENT,
    RUA VARCHAR(100) NOT NULL,
    BAIRRO VARCHAR(100) NOT NULL,
    CIDADE VARCHAR(100) NOT NULL,
    ESTADO CHAR(2),
    NUMERO VARCHAR(5) NOT NULL,
    ID_LOCALIDADE INT UNIQUE NOT NULL,
    FOREIGN KEY(ID_LOCALIDADE)
    REFERENCES LOCALIDADE(IDLOCALIDADE)
);

CREATE TABLE RESERVA(
    IDRESERVA INT PRIMARY KEY AUTO_INCREMENT,
    DATA CHAR(10) NOT NULL,
    HORA CHAR(5) NOT NULL, 
    ID_LOCALIDADE INT NOT NULL,
    ID_USUARIO INT NOT NULL,
    FOREIGN KEY(ID_LOCALIDADE)
    REFERENCES LOCALIDADE(IDLOCALIDADE),
    FOREIGN KEY(ID_USUARIO)
    REFERENCES USUARIO(IDUSUARIO) 
);

CREATE TABLE IMAGEM(
    IDIMAGEM INT PRIMARY KEY AUTO_INCREMENT,
    URL VARCHAR(100) NOT NULL UNIQUE,
    ID_LOCALIDADE INT NOT NULL,
    FOREIGN KEY(ID_LOCALIDADE)
    REFERENCES LOCALIDADE(IDLOCALIDADE)
);

CREATE TABLE TELEFONE(
    IDTELEFONE INT PRIMARY KEY AUTO_INCREMENT,
    DDD CHAR(2) NOT NULL,
    NUMERO VARCHAR(9) NOT NULL,
    ID_USUARIO INT NOT NULL UNIQUE,
    FOREIGN KEY(ID_USUARIO)
    REFERENCES USUARIO(IDUSUARIO)
);


-- Usuarios e Telefones

INSERT INTO USUARIO(NOME, EMAIL, SENHA) 
VALUES('Claudio Silva', 'claudiosilva@gmail.com', '$2y$10$cCg9fCZ6t7mWvHG1li9N5.XXR3403QlcAjj/Aa1qeVb2Cs83hiZDm'); /* SENHA: senhaclaudio */

INSERT INTO TELEFONE(DDD, NUMERO, ID_USUARIO)
VALUES ('11', '908129834', 1); /* Claudio Silva */


INSERT INTO USUARIO(NOME, EMAIL, SENHA) 
VALUES('Carlos Teixeira Silva', 'carlossilva@gmail.com', '$2y$10$gGwS2GIB5dPHUPrjnVXt3uK9iRqkdHJ1Ug57yiaJx7lfbcQWb8cdy'); /* SENHA: senhacarlos */

INSERT INTO TELEFONE(DDD, NUMERO, ID_USUARIO)
VALUES ('11', '918273622', 2); /* Carlos Teixeira Silva */


INSERT INTO USUARIO(NOME, EMAIL, SENHA) 
VALUES('Bruna dos Santos', 'brunadossantos@gmail.com', '$2y$10$3Vh1xcIi3Xoky7D90P1.k.f8WBoCZT4BZApLP8VnyhULkAnM7I3xe'); /* SENHA: senhabruna */

INSERT INTO TELEFONE(DDD, NUMERO, ID_USUARIO)
VALUES ('31', '918243253', 3); /* Bruna dos Santos */


INSERT INTO USUARIO(NOME, EMAIL, SENHA) 
VALUES('Fred Varejão', 'fredvarejão@gmail.com', '$2y$10$aEqsodzEtCFIJBm5.UhhVenO0YfdtnHqvCrMZBCZCKFit9MM/Biyy'); /* SENHA: senhafred */

INSERT INTO TELEFONE(DDD, NUMERO, ID_USUARIO)
VALUES ('27', '999182323', 4); /* Fred Varejão */


INSERT INTO USUARIO(NOME, EMAIL, SENHA) 
VALUES('Maria Ana Souza', 'mariaana@gmail.com', '$2y$10$XliWbYt1Y8xAmQ9is3Iy/ei.5JgBCGugB14QchtIcx98Wz1kWnkbe'); /* SENHA: senhamaria */

INSERT INTO TELEFONE(DDD, NUMERO, ID_USUARIO)
VALUES ('13', '911124323', 5); /* Maria Ana Souza */


-- Localidades, Imagens e Enderecos

INSERT INTO LOCALIDADE(NOME, TIPO, PAGAMENTO, VALOR,ID_USUARIO) 
VALUES('Sitio do Boi', 'ArLivre', 'Diária', 750.00, 1); /* Sitio do Boi */

INSERT INTO IMAGEM(URL, ID_LOCALIDADE)
VALUES('../posts/sitiodoboi.jpg', 1); /* Sitio do Boi */

INSERT INTO IMAGEM(URL, ID_LOCALIDADE)
VALUES('../posts/sitiodoboi2.jpg', 1); /* Sitio do Boi */

INSERT INTO IMAGEM(URL, ID_LOCALIDADE)
VALUES('../posts/sitiodoboi3.jpg', 1); /* Sitio do Boi */

INSERT INTO ENDERECO(RUA, BAIRRO, CIDADE, ESTADO, NUMERO, ID_LOCALIDADE) 
VALUES('Avenida dos Labradores', 'Bosque das Sereias', 'São Paulo', 'SP', '5730', 1); /* Sitio do Boi */


INSERT INTO LOCALIDADE(NOME, TIPO, PAGAMENTO, VALOR,ID_USUARIO) 
VALUES('Sitio das cabras', 'ArLivre', 'Diária', 450.00, 2); /* Sitio das Cabras */

INSERT INTO IMAGEM(URL, ID_LOCALIDADE)
VALUES('../posts/sitiodascabras.jpg', 2); /* Sitio das Cabras */

INSERT INTO ENDERECO(RUA, BAIRRO, CIDADE, ESTADO, NUMERO, ID_LOCALIDADE) 
VALUES('Avenida Marcos Saas', 'Monte Uivante', 'São Paulo', 'SP', '1233', 2); /* Sitio das cabras */


INSERT INTO LOCALIDADE(NOME, TIPO, PAGAMENTO, VALOR,ID_USUARIO) 
VALUES('Buffet Comida e Piscina', 'Buffet', 'Diária', 5000.00, 2); /* Buffet Comida e Piscina */

INSERT INTO IMAGEM(URL, ID_LOCALIDADE)
VALUES('../posts/buffetcomidaepsina.jpg', 3); /* Buffet Comida e Piscina */

INSERT INTO IMAGEM(URL, ID_LOCALIDADE)
VALUES('../posts/buffetcomidaepsina2.jpg', 3); /* Buffet Comida e Piscina */

INSERT INTO IMAGEM(URL, ID_LOCALIDADE)
VALUES('../posts/buffetcomidaepsina3.jpg', 3); /* Buffet Comida e Piscina */

INSERT INTO ENDERECO(RUA, BAIRRO, CIDADE, ESTADO, NUMERO, ID_LOCALIDADE) 
VALUES('Rua das cartolas Roxas', 'Bosque das Sereias', 'São Paulo', 'SP', '5730', 3); /* Buffet Comida e Piscina */


INSERT INTO LOCALIDADE(NOME, TIPO, PAGAMENTO, VALOR,ID_USUARIO) 
VALUES('Buffet Fogueira Viva', 'Buffet', 'Diária', 1750.00, 3); /* Buffet fogueira viva */

INSERT INTO IMAGEM(URL, ID_LOCALIDADE)
VALUES('../posts/buffetfogueiraviva.jpg', 4); /* Buffet fogueira viva */

INSERT INTO ENDERECO(RUA, BAIRRO, CIDADE, ESTADO, NUMERO, ID_LOCALIDADE) 
VALUES('Rua das Pedras Baixas', 'Vila Martelo', 'Belo Horizonte', 'MG', '222', 4); /* Buffet fogueira viva */


INSERT INTO LOCALIDADE(NOME, TIPO, PAGAMENTO, VALOR,ID_USUARIO) 
VALUES('Buffet La Fiesta', 'Buffet', 'Diária', 2050.00, 3); /* Buffet La Fiesta */

INSERT INTO IMAGEM(URL, ID_LOCALIDADE)
VALUES('../posts/buffetlafiesta.jpg', 5); /* Buffet La Fiesta */

INSERT INTO IMAGEM(URL, ID_LOCALIDADE)
VALUES('../posts/buffetlafiesta2.jpg', 5); /* Buffet La Fiesta */

INSERT INTO IMAGEM(URL, ID_LOCALIDADE)
VALUES('../posts/buffetlafiesta3.jpg', 5); /* Buffet La Fiesta */

INSERT INTO ENDERECO(RUA, BAIRRO, CIDADE, ESTADO, NUMERO, ID_LOCALIDADE) 
VALUES('Avenida das Estreças', 'Bairro Verde', 'Rio de Janeiro', 'RJ', '1040', 5); /* Buffet La Fiesta */


INSERT INTO LOCALIDADE(NOME, TIPO, PAGAMENTO, VALOR,ID_USUARIO) 
VALUES('Campo dos Pinheiros', 'ArLivre', 'Hora', 120.00, 4); /* Campo dos Pinheiros */

INSERT INTO IMAGEM(URL, ID_LOCALIDADE)
VALUES('../posts/campodospinheiros.jpg', 6); /* Campo dos Pinheiros */

INSERT INTO IMAGEM(URL, ID_LOCALIDADE)
VALUES('../posts/campodospinheiros2.jpg', 6); /* Campo dos Pinheiros */

INSERT INTO IMAGEM(URL, ID_LOCALIDADE)
VALUES('../posts/campodospinheiros3.jpg', 6); /* Campo dos Pinheiros */

INSERT INTO ENDERECO(RUA, BAIRRO, CIDADE, ESTADO, NUMERO, ID_LOCALIDADE) 
VALUES('Rua Lebron de Luordes', 'Jardim das Flores', 'São Paulo', 'SP', '128', 6); /* Campo dos Pinheiros */


INSERT INTO LOCALIDADE(NOME, TIPO, PAGAMENTO, VALOR,ID_USUARIO) 
VALUES('Fliperama GameUp', 'Fechado', 'Hora', 30.00, 4); /* Fliperama GameUp */

INSERT INTO IMAGEM(URL, ID_LOCALIDADE)
VALUES('../posts/fliperamagameup.jpg', 7); /* Fliperama GameUp */

INSERT INTO IMAGEM(URL, ID_LOCALIDADE)
VALUES('../posts/fliperamagameup2.jpg', 7); /* Fliperama GameUp */

INSERT INTO IMAGEM(URL, ID_LOCALIDADE)
VALUES('../posts/fliperamagameup3.jpg', 7); /* Fliperama GameUp */

INSERT INTO ENDERECO(RUA, BAIRRO, CIDADE, ESTADO, NUMERO, ID_LOCALIDADE) 
VALUES('Rua Nova Cinderela', 'Jardim Parque Pinho', 'São Paulo', 'SP', '716', 7); /* Fliperama GameUp */


INSERT INTO LOCALIDADE(NOME, TIPO, PAGAMENTO, VALOR,ID_USUARIO) 
VALUES('Auditório Dr. Carlos Ramos', 'Fechado', 'Hora', 150.00, 5); /* Auditório Dr. Carlos Ramos */

INSERT INTO IMAGEM(URL, ID_LOCALIDADE)
VALUES('../posts/auditoriodrcarlosramos.jpg', 8); /* Auditório Dr. Carlos Ramos */

INSERT INTO ENDERECO(RUA, BAIRRO, CIDADE, ESTADO, NUMERO, ID_LOCALIDADE) 
VALUES('Rua Dr.Carlos Ramos', 'Praça Alta', 'São Paulo', 'SP', '144', 8); /* Auditório Dr. Carlos Ramos */


INSERT INTO LOCALIDADE(NOME, TIPO, PAGAMENTO, VALOR,ID_USUARIO) 
VALUES('Sala 07', 'Fechado', 'Hora', 100.00, 5); /* Sala 07 */

INSERT INTO IMAGEM(URL, ID_LOCALIDADE)
VALUES('../posts/sala07.jpg', 9); /* Sala 07 */

INSERT INTO ENDERECO(RUA, BAIRRO, CIDADE, ESTADO, NUMERO, ID_LOCALIDADE) 
VALUES('Avenida das traças', 'João Barroso', 'São Paulo', 'SP', '182', 9); /* Sala 07 */











SELECT * FROM USUARIO
INNER JOIN TELEFONE ON IDUSUARIO = ID_USUARIO;



SELECT L.NOME, L.TIPO, L.VALOR, I.IDIMAGEM, I.URL,
        E.RUA, E.BAIRRO, E.CIDADE, E.ESTADO. E.NUMERO
FROM LOCALIDADE L
WHERE TIPO = 'Fechado'
INNER JOIN ENDERECO E
    ON E.ID_LOCALIDADE = L.IDLOCALIDADE
INNER JOIN IMAGEM I
    ON I.ID_LOCALIDADE = L.IDLOCALIDADE
LIMIT 5;




-- Trazer tudo

SELECT U.NOME, U.EMAIL, U.SENHA, T.DDD, T.NUMERO,
    L.IDLOCALIDADE, L.NOME, L.TIPO, L.VALOR, L.PAGAMENTO,
    E.RUA, E.BAIRRO, E.CIDADE, E.ESTADO, E.NUMERO, I.URL
FROM USUARIO U
INNER JOIN TELEFONE T
    ON U.IDUSUARIO = T.ID_USUARIO
INNER JOIN LOCALIDADE L 
    ON U.IDUSUARIO = L.ID_USUARIO
INNER JOIN ENDERECO E
    ON L.IDLOCALIDADE = E.ID_LOCALIDADE
INNER JOIN IMAGEM I 
    ON L.IDLOCALIDADE = I.ID_LOCALIDADE;
