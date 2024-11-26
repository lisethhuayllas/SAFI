
INSERT INTO escuela VALUES
    (1,'Ingeniería de sistemas','Ccoyahuacho'), -- 1
    (2,'Ingeniería ambiental','Santa Rosa'), -- 2
    (3,'Ingeniería agroindustrial','Santa Rosa');  -- 3

-- ASESOR

INSERT INTO asesor VALUES('71402888','$2y$10$onDQPXqe81VhwGaC1DEAS.6AxKN08tMb.lgbTBTVzymVYZjOaGie2','Mauricio','Altamirano Medina','mau@gmail.com', '987456789','Contratado', '1', 'LABORANDO');
INSERT INTO asesor VALUES('71700555','$2y$10$onDQPXqe81VhwGaC1DEAS.6AxKN08tMb.lgbTBTVzymVYZjOaGie2','Erikc','Rivera Rosales', 'erik@gmail.com',  '914256756','Nombrado', '1', 'LABORANDO');
INSERT INTO asesor VALUES('71884000','$2y$10$onDQPXqe81VhwGaC1DEAS.6AxKN08tMb.lgbTBTVzymVYZjOaGie2','Ana Lucia','Rojas Espinoza', 'ana@gmail.com',  '936945852', 'Contratado', '1', 'LABORANDO');
-- INSERT INTO asesor VALUES('71402666','$2y$10$onDQPXqe81VhwGaC1DEAS.6AxKN08tMb.lgbTBTVzymVYZjOaGie2','José Luis','Urrutia Villano', 'jose@gmail.com', '945125653','Nombrado', '2', 'LABORANDO');
-- INSERT INTO asesor VALUES('71404588','$2y$10$onDQPXqe81VhwGaC1DEAS.6AxKN08tMb.lgbTBTVzymVYZjOaGie2','Miguel','Villano Lagos', 'miguel@gmail.com', '945125655','Nombrado', '3', 'LABORANDO');
-- ADMINISTRADOS
 INSERT INTO administrador VALUES
    ('72118318','$2y$10$onDQPXqe81VhwGaC1DEAS.6AxKN08tMb.lgbTBTVzymVYZjOaGie2','Cynthia Giovanna','Leiva Antay','fingenieria@unajma.edu.pe','917334428');
-- TESISTAS 

INSERT INTO tesista values ("72045676","$2y$10$onDQPXqe81VhwGaC1DEAS.6AxKN08tMb.lgbTBTVzymVYZjOaGie2","Ever","Huachuhuillca Mañuico","1008120162","pablo@","989955541",1,"71402888", "Activo" );
INSERT INTO tesista values ("72045344","$2y$10$onDQPXqe81VhwGaC1DEAS.6AxKN08tMb.lgbTBTVzymVYZjOaGie2","Romel Edison","Palomino Mallma","1078120162","martha@","906455541",1,"71402888", "Activo" );
INSERT INTO tesista values ("73044676","$2y$10$onDQPXqe81VhwGaC1DEAS.6AxKN08tMb.lgbTBTVzymVYZjOaGie2","Liliana Ester","Torres Ortiz","1908120162","juan@","986855541",1,"71402888", "Activo" );

INSERT INTO tesista values ("71531548","$2y$10$onDQPXqe81VhwGaC1DEAS.6AxKN08tMb.lgbTBTVzymVYZjOaGie2","Lucas","Ramirez Castro","1008120172","lucas@","98994541",2,"71884000", "Activo" );
INSERT INTO tesista values ("72615658","$2y$10$onDQPXqe81VhwGaC1DEAS.6AxKN08tMb.lgbTBTVzymVYZjOaGie2","Jhoseline","Ramirez Perez","1078120172","jhoseline@","906355541",2,"71884000", "Activo" );
INSERT INTO tesista values ("41548625","$2y$10$onDQPXqe81VhwGaC1DEAS.6AxKN08tMb.lgbTBTVzymVYZjOaGie2","Ana","Matute lopez","1908120172","ana@","986835541",2,"71884000", "Activo" );

INSERT INTO tesista values ("71531158","$2y$10$onDQPXqe81VhwGaC1DEAS.6AxKN08tMb.lgbTBTVzymVYZjOaGie2","Kevin","Ramirez Castro","1008120182","kevin@","989955141",3,"71884000", "Activo" );
INSERT INTO tesista values ("72652325","$2y$10$onDQPXqe81VhwGaC1DEAS.6AxKN08tMb.lgbTBTVzymVYZjOaGie2","Frank","Ramirez Perez","1078120182","frank@","906495541",3,"71884000", "Activo" );
INSERT INTO tesista values ("41512565","$2y$10$onDQPXqe81VhwGaC1DEAS.6AxKN08tMb.lgbTBTVzymVYZjOaGie2","Denis","Matute lopez","1908120182","denis@","926855541",3,"71884000", "Activo" );

-- JURADO 
    
INSERT INTO jurado VALUES('71456700','$2y$10$onDQPXqe81VhwGaC1DEAS.6AxKN08tMb.lgbTBTVzymVYZjOaGie2','Enrique','Mendoza Ramirez','enrique@gmail.com', '950996412' ,'1', 'LABORANDO');
INSERT INTO jurado VALUES('71456710','$2y$10$onDQPXqe81VhwGaC1DEAS.6AxKN08tMb.lgbTBTVzymVYZjOaGie2','Samuel','Villavicencio Cárdenas','samuel@gmail.com', '950992467', '1', 'LABORANDO');
INSERT INTO jurado VALUES('71452340','$2y$10$onDQPXqe81VhwGaC1DEAS.6AxKN08tMb.lgbTBTVzymVYZjOaGie2','Yazmin','Loayza Medina','yazmin@gmail.com', '950996555' ,'2', 'LABORANDO');
INSERT INTO jurado VALUES('71456893','$2y$10$onDQPXqe81VhwGaC1DEAS.6AxKN08tMb.lgbTBTVzymVYZjOaGie2','Adolfo','Echevarria Ramirez','adolfo@gmail.com', '950996817', '2', 'LABORANDO');

-- resoluciones

-- INSERT INTO resolucion VALUES
--     ('373-2022','RESOLUCIÓN Nº 373-2022-CFI-UNAJMA','Cambio de asesor', '2022-11-23','Archivo.pdf','72118318'),
--     ('842-2022','RESOLUCIÓN Nº 842-2022-CFI-UNAJMA','Cambio de jurado', '2022-11-24','Archivo.pdf','72118318'),
--     ('1003-2022','RESOLUCIÓN Nº 1003-2022-CFI-UNAJMA','Cambio de jurado', '2022-11-25','Archivo.pdf','72118318'),
--     ('1010-2022','RESOLUCIÓN Nº 1010-2022-CFI-UNAJMA','Aprobación de acta de sustentación','2022-11-26','Archivo.pdf','74522545'),
--     ('1020-2022','RESOLUCIÓN Nº 1020-2022-CFI-UNAJMA','Aprobación de acta de sustentación', '2022-11-27','Archivo.pdf','74522545');

-- TRABAJOS

-- INSERT INTO Trabajo_investigacion VALUES
-- (NULL,'72045676','Implemetacion de una estaacion metereologica para pronosticos del clima en el distrito de sanjeronimo -2022','2022-11-23','aprobado','Tesis1.pdf','Grupal'),
-- (NULL,'72045344','Automatizacion de timbre con sensor de movimiento para minimarket andahuaylas - 2022','2022-11-23','no aprobado','Tesis2.pdf', 'Individual'),
-- (NULL,'73044676','Implemetacion de una estaacion metereologica para pronosticos del clima en el distrito de sanjeronimo -2022','2022-11-23','aprobado','Tesis1.pdf','Grupal');

-- SUSTENTACION

-- INSERT INTO sustentacion VALUES (null,'Sede Ccoyahuacho-Unajma','2022-12-12','10:00','APROBADO',14,'1' );
-- INSERT INTO sustentacion VALUES (null,'Sede Ccoyahuacho-Unajma','2023-03-05','12:00','APROBADO CON OBSERVACIONES',13,  '2' );
-- INSERT INTO sustentacion VALUES (null,'Sede Ccoyahuacho-Unajma','2023-01-15','14:30','DESAPROBADO',09,  '3' );

-- TRABAJO - RESOLUCION
    
-- tipo jurado
INSERT INTO tipo_jurado VALUES
 ('71452340',1,'PRESIDENTE'),('71456700',1,'MIEMBRO'),('71456710',1,'MIEMBRO'),('71456893',1,'SUPLENTE'),
 ('71452340',2,'MIEMBRO'),('71456700',2,'PRESIDENTE'),('71456710',2,'SUPLENTE'),('71456893',2,'MIEMBRO');

-- INSERT INTO tipo_jurado VALUES ('71452340',3,'PRESIDENTE'),('71456700',3,'MIEMBRO'),('71456710',3,'MIEMBRO'),('71456893',3,'SUPLENTE');


