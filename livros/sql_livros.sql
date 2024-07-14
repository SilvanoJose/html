CREATE TABLE livros (
	id INTEGER NOT NULL AUTO_INCREMENT,
	titulo VARCHAR(50) NOT NULL,
	genero VARCHAR(1) NOT NULL, /* D=Drama, F=Ficção, R=Romance, O=Outro */
	qtd_paginas INTEGER NOT NULL,
	CONSTRAINT pk_livros PRIMARY KEY (id)
);
