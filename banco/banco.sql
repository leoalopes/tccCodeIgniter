SET SESSION FOREIGN_KEY_CHECKS=0;

/* Drop Tables */

DROP TABLE IF EXISTS responsaveis_atividade;
DROP TABLE IF EXISTS atividade;
DROP TABLE IF EXISTS documentacao;
DROP TABLE IF EXISTS permissoes_projeto;
DROP TABLE IF EXISTS projeto_grupo;
DROP TABLE IF EXISTS reuniao;
DROP TABLE IF EXISTS usuarios_grupo;
DROP TABLE IF EXISTS grupo;
DROP TABLE IF EXISTS quadro_atividades;
DROP TABLE IF EXISTS projeto;
DROP TABLE IF EXISTS usuario;




/* Create Tables */

CREATE TABLE atividade
(
	id_atividade int NOT NULL AUTO_INCREMENT,
	descricao varchar(200) NOT NULL,
	data_inicio date NOT NULL,
	prazo date NOT NULL,
	id_quadro int NOT NULL,
	PRIMARY KEY (id_atividade),
	UNIQUE (id_atividade)
);


CREATE TABLE documentacao
(
	id_documentacao int NOT NULL AUTO_INCREMENT,
	conteudo varchar(1000) NOT NULL,
	id_usuario int NOT NULL,
	id_projeto int NOT NULL,
	PRIMARY KEY (id_documentacao),
	UNIQUE (id_documentacao)
);


CREATE TABLE grupo
(
	id_grupo int NOT NULL AUTO_INCREMENT,
	nome varchar(60) NOT NULL,
	id_usuario int NOT NULL,
	PRIMARY KEY (id_grupo),
	UNIQUE (id_grupo)
);


CREATE TABLE permissoes_projeto
(
	id_usuario int NOT NULL,
	id_projeto int NOT NULL,
	leitura boolean NOT NULL,
	escrita boolean NOT NULL,
	PRIMARY KEY (id_usuario, id_projeto)
);


CREATE TABLE projeto
(
	id_projeto int NOT NULL AUTO_INCREMENT,
	nome varchar(60) NOT NULL,
	id_usuario int,
	PRIMARY KEY (id_projeto),
	UNIQUE (id_projeto)
);


CREATE TABLE projeto_grupo
(
	id_projeto int NOT NULL,
	id_grupo int NOT NULL,
	PRIMARY KEY (id_projeto),
	UNIQUE (id_projeto)
);


CREATE TABLE quadro_atividades
(
	id_quadro int NOT NULL AUTO_INCREMENT,
	nome_quadro varchar(60) NOT NULL,
	id_projeto int NOT NULL,
	PRIMARY KEY (id_quadro),
	UNIQUE (id_quadro)
);


CREATE TABLE responsaveis_atividade
(
	id_atividade int NOT NULL,
	id_usuario int NOT NULL,
	PRIMARY KEY (id_atividade, id_usuario)
);


CREATE TABLE reuniao
(
	id_reuniao int NOT NULL AUTO_INCREMENT,
	motivo varchar(200) NOT NULL,
	data datetime NOT NULL,
	id_grupo int NOT NULL,
	PRIMARY KEY (id_reuniao),
	UNIQUE (id_reuniao)
);


CREATE TABLE usuario
(
	id_usuario int NOT NULL AUTO_INCREMENT,
	nome varchar(40) NOT NULL,
	email varchar(60) NOT NULL,
	senha varchar(40) NOT NULL,
	PRIMARY KEY (id_usuario),
	UNIQUE (id_usuario),
	UNIQUE (email)
);


CREATE TABLE usuarios_grupo
(
	id_usuario int NOT NULL,
	id_grupo int NOT NULL,
	admin boolean NOT NULL,
	PRIMARY KEY (id_usuario, id_grupo)
);



/* Create Foreign Keys */

ALTER TABLE responsaveis_atividade
	ADD FOREIGN KEY (id_atividade)
	REFERENCES atividade (id_atividade)
	ON UPDATE RESTRICT
	ON DELETE RESTRICT
;


ALTER TABLE projeto_grupo
	ADD FOREIGN KEY (id_grupo)
	REFERENCES grupo (id_grupo)
	ON UPDATE RESTRICT
	ON DELETE RESTRICT
;


ALTER TABLE reuniao
	ADD FOREIGN KEY (id_grupo)
	REFERENCES grupo (id_grupo)
	ON UPDATE RESTRICT
	ON DELETE RESTRICT
;


ALTER TABLE usuarios_grupo
	ADD FOREIGN KEY (id_grupo)
	REFERENCES grupo (id_grupo)
	ON UPDATE RESTRICT
	ON DELETE RESTRICT
;


ALTER TABLE documentacao
	ADD FOREIGN KEY (id_projeto)
	REFERENCES projeto (id_projeto)
	ON UPDATE RESTRICT
	ON DELETE RESTRICT
;


ALTER TABLE projeto_grupo
	ADD FOREIGN KEY (id_projeto)
	REFERENCES projeto (id_projeto)
	ON UPDATE RESTRICT
	ON DELETE RESTRICT
;


ALTER TABLE quadro_atividades
	ADD FOREIGN KEY (id_projeto)
	REFERENCES projeto (id_projeto)
	ON UPDATE RESTRICT
	ON DELETE RESTRICT
;


ALTER TABLE permissoes_projeto
	ADD FOREIGN KEY (id_projeto)
	REFERENCES projeto_grupo (id_projeto)
	ON UPDATE RESTRICT
	ON DELETE RESTRICT
;


ALTER TABLE atividade
	ADD FOREIGN KEY (id_quadro)
	REFERENCES quadro_atividades (id_quadro)
	ON UPDATE RESTRICT
	ON DELETE RESTRICT
;


ALTER TABLE documentacao
	ADD FOREIGN KEY (id_usuario)
	REFERENCES usuario (id_usuario)
	ON UPDATE RESTRICT
	ON DELETE RESTRICT
;


ALTER TABLE grupo
	ADD FOREIGN KEY (id_usuario)
	REFERENCES usuario (id_usuario)
	ON UPDATE RESTRICT
	ON DELETE RESTRICT
;


ALTER TABLE permissoes_projeto
	ADD FOREIGN KEY (id_usuario)
	REFERENCES usuario (id_usuario)
	ON UPDATE RESTRICT
	ON DELETE RESTRICT
;


ALTER TABLE projeto
	ADD FOREIGN KEY (id_usuario)
	REFERENCES usuario (id_usuario)
	ON UPDATE RESTRICT
	ON DELETE RESTRICT
;


ALTER TABLE responsaveis_atividade
	ADD FOREIGN KEY (id_usuario)
	REFERENCES usuario (id_usuario)
	ON UPDATE RESTRICT
	ON DELETE RESTRICT
;


ALTER TABLE usuarios_grupo
	ADD FOREIGN KEY (id_usuario)
	REFERENCES usuario (id_usuario)
	ON UPDATE RESTRICT
	ON DELETE RESTRICT
;



