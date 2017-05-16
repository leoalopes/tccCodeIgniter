SET SESSION FOREIGN_KEY_CHECKS=0;

/* Drop Tables */

DROP TABLE IF EXISTS grupo;
DROP TABLE IF EXISTS projeto;
DROP TABLE IF EXISTS usuario;




/* Create Tables */

CREATE TABLE grupo
(
	id_grupo int NOT NULL,
	nome varchar(60) NOT NULL,
	id_usuario int NOT NULL,
	PRIMARY KEY (id_grupo),
	UNIQUE (id_grupo),
	UNIQUE (id_usuario)
);


CREATE TABLE projeto
(
	id_projeto int NOT NULL,
	nome varchar(60) NOT NULL,
	id_usuario int NOT NULL,
	PRIMARY KEY (id_projeto),
	UNIQUE (id_projeto)
);


CREATE TABLE usuario
(
	id_usuario int NOT NULL,
	nome varchar(40) NOT NULL,
	email varchar(60) NOT NULL,
	senha varchar(40) NOT NULL,
	PRIMARY KEY (id_usuario),
	UNIQUE (id_usuario),
	UNIQUE (email)
);



/* Create Foreign Keys */

ALTER TABLE grupo
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



