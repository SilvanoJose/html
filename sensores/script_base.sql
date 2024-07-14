CREATE TABLE sensor_temperatura (
    id INTEGER AUTO_INCREMENT NOT NULL,
    momento_leitura INTEGER NOT NULL,
    momento_gravacao TIMESTAMP NOT NULL DEFAULT now(),
    valor FLOAT NOT NULL,
    CONSTRAINT pk_sensor_temperatura PRIMARY KEY (id)
);

/* INSERT INTO sensor_temperatura (momento_leitura, valor) VALUES (1698705192, 30.682491106593503); */