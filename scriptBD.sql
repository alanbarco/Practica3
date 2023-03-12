drop table if exists incidente;
drop table if exists usuario;
drop table if exists tipoincidente;


create table usuario(
	id_usuario serial,
	nombre varchar(150) not null,
	email varchar(100) not null,
	clave varchar(150) not null,
	estado varchar(1) not null,
	tipo varchar(50),
	roles json,
	CONSTRAINT id_usuario PRIMARY KEY (id_usuario)
);

create table tipoincidente(
	id_tipo serial,
	descripcion varchar(150) not null,
	estado varchar(1) not null,
	CONSTRAINT id_tipo PRIMARY KEY (id_tipo)
);
CREATE TABLE IF NOT EXISTS incidente
(
    id_incidente serial,
    id_usuario integer not null,
    id_tipo integer not null,
	descripcion varchar(150),
    estado character varying(1) NOT NULL,
	solucion varchar(250),
    estado_incidente character varying(100),
	observacion varchar(250),
	costo float,
    CONSTRAINT id_incidente PRIMARY KEY (id_incidente),
    CONSTRAINT fk_tipo FOREIGN KEY (id_tipo)  REFERENCES tipoincidente(id_tipo),
    CONSTRAINT fk_usuario FOREIGN KEY (id_usuario)  REFERENCES usuario(id_usuario)
);

insert into tipoincidente(descripcion, estado) values('Robo','A');
SELECT sequence_name FROM information_schema.sequences WHERE sequence_name = 'incidente_id_incidente_seq';


insert into tipoincidente(descripcion, estado) values('Ataque animal','A');
insert into tipoincidente(descripcion, estado) values('Robo','A');
insert into tipoincidente(descripcion, estado) values('Incendio','A');
select * from tipoincidente;
select * from usuario;
select * from incidente;

