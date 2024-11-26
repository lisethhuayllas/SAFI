CREATE DATABASE safi_unajma;
USE safi_unajma;

CREATE TABLE Escuela
(
	ID_escuela INT PRIMARY KEY NOT NULL,
    nombre VARCHAR(45) UNIQUE NOT NULL,
    sede VARCHAR(45) NOT NULL
);

CREATE TABLE Asesor
(
	DNI CHAR(8) PRIMARY KEY NOT NULL,
    contrasenia VARCHAR(256) NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    apellidos VARCHAR(50) NOT NULL,
    correo VARCHAR(50) UNIQUE NOT NULL,
    celular CHAR(9) UNIQUE NOT NULL,
    tipo_docente VARCHAR(10) NOT NULL,
    escuela INT NOT NULL,
    estado VARCHAR(10) NOT NULL, -- LABORANDO/RETIRADO

    FOREIGN KEY(Escuela) REFERENCES Escuela(ID_Escuela)
);

CREATE TABLE Jurado
(
	DNI CHAR(8) PRIMARY KEY NOT NULL,
    contrasenia VARCHAR(256) NOT NULL,
    nombre VARCHAR(45) NOT NULL,
    apellidos VARCHAR(50) NOT NULL,
    correo VARCHAR(50) UNIQUE NOT NULL,
    celular CHAR(9) UNIQUE NOT NULL,
    escuela INT NOT NULL,
    estado VARCHAR(10) NOT NULL, -- LABORANDO/RETIRADO

    FOREIGN KEY(escuela) REFERENCES Escuela(ID_escuela)
);

CREATE TABLE Tesista
(
	DNI CHAR(8) PRIMARY KEY NOT NULL,
    contrasenia VARCHAR(256) NOT NULL,
    nombre VARCHAR(45) NOT NULL,
    apellidos VARCHAR(50) NOT NULL,
    codigo CHAR(10) UNIQUE NOT NULL,
    correo VARCHAR (45) UNIQUE NOT NULL,
    celular CHAR(9) UNIQUE NOT NULL,
    escuela INT NOT NULL,
    DNI_asesor CHAR(8) NOT NULL,
    Estado VARCHAR(8) NOT NULL, -- activo/inactivo

    FOREIGN KEY(escuela) REFERENCES Escuela(ID_escuela),
    FOREIGN KEY(DNI_asesor) REFERENCES Asesor(DNI)
);

CREATE TABLE Trabajo_Investigacion
(
	ID_proyecto INT  AUTO_INCREMENT NOT NULL,
    autor CHAR(8) NOT NULL, 
    titulo VARCHAR(200) NOT NULL,
    fecha_presentacion DATE NOT NULL,
    estado VARCHAR(45) NOT NULL,
    archivo MEDIUMBLOB NOT NULL,
    tipo VARCHAR(45) NOT NULL, -- primera presentación/ sustentación
    
    PRIMARY KEY (ID_proyecto, autor),
    FOREIGN KEY(autor) REFERENCES Tesista(DNI) 
);

CREATE TABLE Tipo_Jurado
(
	jurado CHAR(8) NOT NULL,
    proyecto INT NOT NULL,
    tipo_jurado VARCHAR(10) NOT NULL,

    FOREIGN KEY(jurado) REFERENCES Jurado(DNI),
    FOREIGN KEY(proyecto) REFERENCES Trabajo_Investigacion(ID_proyecto)
);

CREATE TABLE Administrador
(
	DNI CHAR(8) PRIMARY KEY NOT NULL,
    contrasenia VARCHAR(256) NOT NULL,
    nombre VARCHAR(45) NOT NULL,
    apellidos VARCHAR(50) NOT NULL,
    correo VARCHAR (50) UNIQUE NOT NULL,
    celular CHAR(9) UNIQUE NOT NULL
);

CREATE TABLE Resolucion
(
	numero CHAR(8) PRIMARY KEY NOT NULL,
    tipo VARCHAR(50) NOT NULL, 
    fecha DATE NOT NULL,
    archivo MEDIUMBLOB NOT NULL,
    autor CHAR(8) NOT NULL,

    FOREIGN KEY(autor) REFERENCES Administrador(DNI)
);

CREATE TABLE Sustentacion
(
	ID_sustentacion INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    lugar VARCHAR(25) NOT NULL,
    fecha_sustentacion DATE NOT NULL,
    hora TIME NOT NULL,
    estado VARCHAR(50) NOT NULL, -- pendiente/finalizado
    calificacion FLOAT NOT NULL,
    proyecto INT NOT NULL,

    FOREIGN KEY(proyecto) REFERENCES Trabajo_Investigacion(ID_proyecto)
);

CREATE TABLE Revision
(
	ID_revision INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    DNI_jurado CHAR(8) NOT NULL,
    fecha DATE NOT NULL, 
    estado_revision VARCHAR(45) NULL,
    trabajo_revisado INT NOT NULL,
    observaciones VARCHAR(50) NULL,

    FOREIGN KEY(trabajo_revisado) REFERENCES Trabajo_Investigacion(ID_proyecto),
    FOREIGN KEY(DNI_jurado) REFERENCES Jurado(DNI)
);

CREATE TABLE Resolucion_Tesista
(
	DNI_tesista CHAR(8) NOT NULL,
    N_resolucion CHAR(8) NOT NULL,

    FOREIGN KEY(DNI_tesista) REFERENCES Tesista(DNI),
	FOREIGN KEY(N_resolucion) REFERENCES Resolucion(numero)
);

CREATE TABLE Sustentacion_Jurado
(
	ID_sustentacion INT NOT NULL,
    DNI_jurado CHAR(8) NOT NULL,
    Calificacion FLOAT,

    FOREIGN KEY(ID_sustentacion) REFERENCES Sustentacion(ID_sustentacion),
	FOREIGN KEY(DNI_jurado) REFERENCES Jurado(DNI)
);

-- CREACION DE VISTAS
CREATE VIEW usuarios 
AS 
    SELECT DNI,contrasenia,correo,'administrador' AS Rol FROM Administrador
    UNION
    SELECT DNI,contrasenia,correo,'tesista' AS Rol FROM Tesista
    UNION 
    SELECT DNI,contrasenia,correo,'asesor' AS Rol FROM Asesor
    UNION 
    SELECT DNI,contrasenia,correo,'jurado' AS Rol FROM Jurado;

-- CREACIÓN DE PROCEDIMIENTOS ALMACENADOS
-- SP para tesistas --
DELIMITER //
CREATE PROCEDURE SP_agregar_tesista(IN DNI CHAR(8), IN contrasenia VARCHAR(255), IN nombre VARCHAR(45), IN apellidos VARCHAR(50), IN codigo CHAR(10), IN correo VARCHAR(45), IN celular char(9), IN escuela INT, IN DNI_asesor CHAR(8))
BEGIN
    INSERT INTO tesista VALUES(DNI,contrasenia,nombre,apellidos,codigo,correo,celular,escuela,DNI_asesor, 'Activo');
END
// DELIMITER ;

DELIMITER //
CREATE PROCEDURE SP_mostrar_tesista_por_DNI(IN DNI CHAR(8))
BEGIN
    SELECT t.DNI, CONCAT(t.nombre, ' ', t.apellidos) AS 'nombre_completo', e.nombre AS escuela, CONCAT(a.nombre,' ', a.apellidos) AS asesor FROM tesista t 
    INNER JOIN escuela e 
    ON e.ID_escuela=t.escuela 
    INNER JOIN asesor a 
    ON a.DNI=t.DNI_asesor
    WHERE t.DNI like CONCAT(DNI,'%')
    ORDER BY nombre_completo;
END
// DELIMITER ;

DELIMITER //
CREATE PROCEDURE SP_mostrar_asesores_escuela(IN escuela VARCHAR(45))
BEGIN
    SELECT DNI, CONCAT(a.nombre,' ', a.apellidos) AS 'datos_asesor' FROM asesor a
    INNER JOIN escuela e
    ON a.escuela=e.ID_escuela
    WHERE e.nombre=escuela;
END
// DELIMITER ;

DELIMITER //
CREATE PROCEDURE SP_mostrar_todos_tesistas()
BEGIN
    SELECT t.DNI, CONCAT(t.nombre, ' ', t.apellidos) AS 'nombre_completo', e.nombre AS escuela, CONCAT(a.nombre,' ', a.apellidos) AS asesor FROM tesista t 
    INNER JOIN escuela e 
    ON e.ID_escuela=t.escuela 
    INNER JOIN asesor a 
    ON a.DNI=t.DNI_asesor
    ORDER BY nombre_completo;
END
// DELIMITER ;

DELIMITER //
CREATE PROCEDURE SP_mostrar_tesistas_por_carrera(IN carrera VARCHAR(45))
BEGIN
    SELECT t.DNI, CONCAT(t.nombre, ' ', t.apellidos) AS 'nombre_completo', e.nombre AS escuela, CONCAT(a.nombre,' ', a.apellidos) AS asesor FROM tesista t 
    INNER JOIN escuela e 
    ON e.ID_escuela=t.escuela 
    INNER JOIN asesor a 
    ON a.DNI=t.DNI_asesor
    WHERE e.nombre=carrera
    ORDER BY nombre_completo;
END
// DELIMITER ;

DELIMITER //
CREATE PROCEDURE SP_mostrar_detalles_tesista(IN DNI CHAR(8))
BEGIN
    SELECT t.DNI, t.nombre, t.apellidos, t.codigo, t.correo, t.celular, e.nombre AS escuela ,CONCAT(a.nombre,' ', a.apellidos) AS asesor, a.DNI AS DNI_asesor FROM tesista t 
    INNER JOIN escuela e
    ON e.ID_escuela=t.escuela 
    INNER JOIN asesor a 
    ON a.DNI=t.DNI_asesor
    WHERE t.DNI=DNI;
END
// DELIMITER ;

DELIMITER //
CREATE PROCEDURE SP_actualizar_informacion_tesista(IN nombre VARCHAR(45), IN apellidos VARCHAR(50), IN DNI_viejo CHAR(8),IN DNI_nuevo CHAR(8), IN codigo CHAR(10), IN escuela INT, IN correo VARCHAR(45), IN celular char(9), IN DNI_asesor CHAR(8))
BEGIN
    UPDATE tesista SET nombre=nombre, apellidos=CONCAT('',apellidos), DNI=DNI_nuevo,codigo=codigo,correo=correo,celular=celular,escuela=escuela, DNI_asesor=DNI_asesor 
    WHERE DNI=DNI_viejo;
END
// DELIMITER ;

DELIMITER //
CREATE PROCEDURE SP_verifica_DNI_repetido(IN DNI_ CHAR(8))
BEGIN
    SELECT * FROM tesista WHERE DNI=DNI_;
END
// DELIMITER ;

DELIMITER //
CREATE PROCEDURE SP_verifica_codigo_repetido(IN codigo_ CHAR(10))
BEGIN
    SELECT * FROM tesista WHERE codigo=codigo_;
END
// DELIMITER ;

DELIMITER //
CREATE PROCEDURE SP_verifica_correo_repetido(IN correo_ VARCHAR(45))
BEGIN
    SELECT * FROM tesista WHERE correo=correo_;
END
// DELIMITER ;

DELIMITER //
CREATE PROCEDURE SP_verifica_celular_repetido(IN celular_ CHAR(9))
BEGIN
    SELECT * FROM tesista WHERE celular=celular_;
END
// DELIMITER ;

DELIMITER //
CREATE PROCEDURE SP_verifica_DNI_repetidoII(IN DNI_ CHAR(8), IN DNI_viejo CHAR(8))
BEGIN
    SELECT * FROM tesista WHERE DNI=DNI_ AND DNI!=DNI_viejo;
END
// DELIMITER ;

DELIMITER //
CREATE PROCEDURE SP_verifica_codigo_repetidoII(IN codigo_ CHAR(10), IN DNI_viejo CHAR(8))
BEGIN
    SELECT * FROM tesista WHERE codigo=codigo_ AND DNI!=DNI_viejo;
END
// DELIMITER ;

DELIMITER //
CREATE PROCEDURE SP_verifica_correo_repetidoII(IN correo_ VARCHAR(45), IN DNI_viejo CHAR(8))
BEGIN
    SELECT * FROM tesista WHERE correo=correo_ AND DNI!=DNI_viejo;
END
// DELIMITER ;

DELIMITER //
CREATE PROCEDURE SP_verifica_celular_repetidoII(IN celular_ CHAR(9), IN DNI_viejo CHAR(8))
BEGIN
    SELECT * FROM tesista WHERE celular=celular_ AND DNI!=DNI_viejo;
END
// DELIMITER ;

-- SP para asesores --
DELIMITER //
CREATE PROCEDURE SP_agregar_asesor(IN DNI CHAR(8), IN contrasenia VARCHAR(255), IN nombre VARCHAR(45), IN apellidos VARCHAR(50), IN correo VARCHAR(45), IN celular char(9), IN tipo_docente VARCHAR(10),IN escuela INT, IN estado CHAR(10))
BEGIN
    INSERT INTO asesor VALUES(DNI,contrasenia,nombre,apellidos,correo,celular, tipo_docente, escuela,estado);
END
// DELIMITER ;

DELIMITER //
CREATE PROCEDURE SP_mostrar_todos_asesores()
BEGIN
    SELECT a.DNI, CONCAT(a.nombre, ' ', a.apellidos) AS 'nombre_completo', e.nombre AS escuela, (SELECT COUNT(*) FROM tesista t WHERE t.DNI_asesor = a.DNI) AS asesorados FROM asesor a 
    INNER JOIN escuela e 
    ON e.ID_escuela=a.escuela
    ORDER BY nombre_completo;
END
// DELIMITER ;

DELIMITER //
CREATE PROCEDURE SP_mostrar_asesores_por_carrera(IN carrera VARCHAR(45))
BEGIN
    SELECT a.DNI, CONCAT(a.nombre, ' ', a.apellidos) AS 'nombre_completo', e.nombre AS escuela, (SELECT COUNT(*) FROM tesista t WHERE t.DNI_asesor = a.DNI) AS asesorados FROM asesor a 
    INNER JOIN escuela e 
    ON e.ID_escuela=a.escuela
    WHERE e.nombre = carrera
    ORDER BY nombre_completo;
END
// DELIMITER ;

DELIMITER //
CREATE PROCEDURE SP_mostrar_asesor_por_DNI(IN DNI CHAR(8))
BEGIN
    SELECT a.DNI, CONCAT(a.nombre, ' ', a.apellidos) AS 'nombre_completo', e.nombre AS escuela, (SELECT COUNT(*) FROM tesista t WHERE t.DNI_asesor = a.DNI) AS asesorados FROM asesor a 
    INNER JOIN escuela e 
    ON e.ID_escuela=a.escuela
    WHERE a.DNI like CONCAT(DNI,'%')
    ORDER BY nombre_completo;
END
// DELIMITER ;

DELIMITER //
CREATE PROCEDURE SP_verifica_DNI_repetido_asesor(IN DNI_ CHAR(8))
BEGIN
    SELECT * FROM asesor WHERE DNI=DNI_;
END
// DELIMITER ;

DELIMITER //
CREATE PROCEDURE SP_verifica_correo_repetido_asesor(IN correo_ VARCHAR(45))
BEGIN
    SELECT * FROM asesor WHERE correo=correo_;
END
// DELIMITER ;

DELIMITER //
CREATE PROCEDURE SP_verifica_celular_repetido_asesor(IN celular_ CHAR(9))
BEGIN
    SELECT * FROM asesor WHERE celular=celular_;
END
// DELIMITER ;

DELIMITER //
CREATE PROCEDURE SP_verifica_DNI_repetidoII_asesor(IN DNI_ CHAR(8), IN DNI_viejo CHAR(8))
BEGIN
    SELECT * FROM asesor WHERE DNI=DNI_ AND DNI!=DNI_viejo;
END
// DELIMITER ;

DELIMITER //
CREATE PROCEDURE SP_verifica_correo_repetidoII_asesor(IN correo_ VARCHAR(45), IN DNI_viejo CHAR(8))
BEGIN
    SELECT * FROM asesor WHERE correo=correo_ AND DNI!=DNI_viejo;
END
// DELIMITER ;

DELIMITER //
CREATE PROCEDURE SP_verifica_celular_repetidoII_asesor(IN celular_ CHAR(9), IN DNI_viejo CHAR(8))
BEGIN
    SELECT * FROM asesor WHERE celular=celular_ AND DNI!=DNI_viejo;
END
// DELIMITER ;

DELIMITER //
CREATE PROCEDURE SP_mostrar_detalles_asesor(IN DNI CHAR(8))
BEGIN
    SELECT a.DNI, a.nombre, a.apellidos, a.correo, a.celular, a.tipo_docente, e.nombre AS escuela, (SELECT COUNT(*) FROM tesista t WHERE t.DNI_asesor = a.DNI) AS asesorados FROM asesor a 
    INNER JOIN escuela e 
    ON e.ID_escuela=a.escuela
    WHERE a.DNI like CONCAT(DNI,'%');
END
// DELIMITER ;

DELIMITER //
CREATE PROCEDURE SP_actualizar_informacion_asesor(IN nombre VARCHAR(45), IN apellidos VARCHAR(50), IN DNI_viejo CHAR(8),IN DNI_nuevo CHAR(8), IN escuela INT, IN correo VARCHAR(45), IN celular char(9), IN tipo_docente VARCHAR(10))
BEGIN
    UPDATE asesor SET nombre=nombre, apellidos=CONCAT('',apellidos), DNI=DNI_nuevo,correo=correo,celular=celular,escuela=escuela, tipo_docente=tipo_docente 
    WHERE DNI=DNI_viejo;
END
// DELIMITER ;

--JURADOS
DELIMITER //
CREATE PROCEDURE SP_mostrar_todos_jurados()
BEGIN
    SELECT j.DNI, CONCAT(j.nombre, ' ', j.apellidos) AS 'nombre_completo', e.nombre AS escuela, (SELECT COUNT(*) FROM tipo_jurado WHERE jurado = j.DNI) AS trabajos_a_revisar FROM jurado j 
    INNER JOIN escuela e 
    ON e.ID_escuela=j.escuela
    ORDER BY nombre_completo;
END
// DELIMITER ;

DELIMITER //
CREATE PROCEDURE SP_mostrar_jurados_por_carrera(IN carrera VARCHAR(45))
BEGIN
    SELECT j.DNI, CONCAT(j.nombre, ' ', j.apellidos) AS 'nombre_completo', e.nombre AS escuela, (SELECT COUNT(*) FROM tipo_jurado WHERE jurado = j.DNI) AS trabajos_a_revisar FROM jurado j 
    INNER JOIN escuela e 
    ON e.ID_escuela=j.escuela
    WHERE e.nombre = carrera
    ORDER BY nombre_completo;
END
// DELIMITER ;

DELIMITER //
CREATE PROCEDURE SP_mostrar_jurado_por_DNI(IN DNI CHAR(8))
BEGIN
    SELECT j.DNI, CONCAT(j.nombre, ' ', j.apellidos) AS 'nombre_completo', e.nombre AS escuela, (SELECT COUNT(*) FROM tipo_jurado WHERE jurado = j.DNI) AS trabajos_a_revisar FROM jurado j 
    INNER JOIN escuela e 
    ON e.ID_escuela=j.escuela
    WHERE j.DNI like CONCAT(DNI,'%')
    ORDER BY nombre_completo;
END
// DELIMITER ;

DELIMITER //
CREATE PROCEDURE SP_verifica_DNI_repetido_jurado(IN DNI_ CHAR(8))
BEGIN
    SELECT * FROM jurado WHERE DNI=DNI_;
END
// DELIMITER ;

DELIMITER //
CREATE PROCEDURE SP_verifica_correo_repetido_jurado(IN correo_ VARCHAR(45))
BEGIN
    SELECT * FROM jurado WHERE correo=correo_;
END
// DELIMITER ;

DELIMITER //
CREATE PROCEDURE SP_verifica_celular_repetido_jurado(IN celular_ CHAR(9))
BEGIN
    SELECT * FROM jurado WHERE celular=celular_;
END
// DELIMITER ;

DELIMITER //
CREATE PROCEDURE SP_verifica_DNI_repetidoII_jurado(IN DNI_ CHAR(8), IN DNI_viejo CHAR(8))
BEGIN
    SELECT * FROM jurado WHERE DNI=DNI_ AND DNI!=DNI_viejo;
END
// DELIMITER ;

DELIMITER //
CREATE PROCEDURE SP_verifica_correo_repetidoII_jurado(IN correo_ VARCHAR(45), IN DNI_viejo CHAR(8))
BEGIN
    SELECT * FROM jurado WHERE correo=correo_ AND DNI!=DNI_viejo;
END
// DELIMITER ;

DELIMITER //
CREATE PROCEDURE SP_verifica_celular_repetidoII_jurado(IN celular_ CHAR(9), IN DNI_viejo CHAR(8))
BEGIN
    SELECT * FROM jurado WHERE celular=celular_ AND DNI!=DNI_viejo;
END
// DELIMITER ;

DELIMITER //
CREATE PROCEDURE SP_agregar_jurado(IN DNI CHAR(8), IN contrasenia VARCHAR(255), IN nombre VARCHAR(45), IN apellidos VARCHAR(50), IN correo VARCHAR(45), IN celular char(9),IN escuela INT, IN estado CHAR(10))
BEGIN
    INSERT INTO jurado VALUES(DNI,contrasenia,nombre,apellidos,correo,celular, escuela,estado);
END
// DELIMITER ;

DELIMITER //
CREATE PROCEDURE SP_mostrar_detalles_jurado(IN DNI CHAR(8))
BEGIN
    SELECT j.DNI, j.nombre, j.apellidos, j.correo, j.celular,e.nombre AS escuela, (SELECT COUNT(*) FROM tipo_jurado WHERE jurado = j.DNI) AS trabajos_a_revisar FROM jurado j 
    INNER JOIN escuela e 
    ON e.ID_escuela=j.escuela
    WHERE j.DNI like CONCAT(DNI,'%');
END
// DELIMITER ;

DELIMITER //
CREATE PROCEDURE SP_actualizar_informacion_jurado(IN nombre VARCHAR(45), IN apellidos VARCHAR(50), IN DNI_viejo CHAR(8),IN DNI_nuevo CHAR(8), IN escuela INT, IN correo VARCHAR(45), IN celular char(9))
BEGIN
    UPDATE jurado SET nombre=nombre, apellidos=CONCAT('',apellidos), DNI=DNI_nuevo,correo=correo,celular=celular,escuela=escuela 
    WHERE DNI=DNI_viejo;
END
// DELIMITER ;

--
DELIMITER //
CREATE PROCEDURE SP_mostrar_trabajos_investigacion()
BEGIN
    SELECT TI.ID_proyecto, TI.titulo,  CONCAT(T.nombre," ", T.apellidos)AS autor, TI.estado AS estado FROM 
    trabajo_investigacion TI 
    INNER JOIN tesista T 
    ON TI.autor= T.DNI
    ORDER BY estado;
END
//DELIMITER ;

DELIMITER //
CREATE PROCEDURE SP_buscar_trabajos_investigacion(IN textoBusqueda text)
BEGIN
    SELECT TI.ID_proyecto, TI.titulo, CONCAT(T.nombre," ", T.apellidos)AS autor, TI.estado AS estado FROM 
    trabajo_investigacion TI 
    INNER JOIN tesista T 
    ON TI.autor= T.DNI
    WHERE titulo like CONCAT('%',textoBusqueda,'%')
    ORDER BY estado;
END
//DELIMITER ;

DELIMITER //
CREATE PROCEDURE SP_mostrar_trabajo_investigacion(IN ID_trabajo INT)
BEGIN
    SELECT archivo FROM trabajo_investigacion 
    WHERE ID_proyecto = ID_trabajo;
END
// DELIMITER ;


DELIMITER //
CREATE PROCEDURE SP_cambiar_estado_proyecto(IN ID INT, IN nuevo_estado VARCHAR(15))
BEGIN
    UPDATE trabajo_investigacion SET estado = nuevo_estado WHERE ID_proyecto = ID;
END
// DELIMITER ;

DELIMITER //
CREATE PROCEDURE SP_mostrar_resoluciones()
BEGIN
    SELECT numero, tipo, DATE_FORMAT(fecha, '%d-%m-%Y') AS fecha, archivo FROM resolucion;
END
// DELIMITER ;

DELIMITER //
CREATE PROCEDURE SP_mostrar_resoluciones_filtrado(IN numeroResolucion VARCHAR(8))
BEGIN
    SELECT numero, tipo, DATE_FORMAT(fecha, '%d-%m-%Y') AS fecha, archivo FROM resolucion
    WHERE numero like CONCAT(numeroResolucion,'%');
END
// DELIMITER ;

DELIMITER //
CREATE PROCEDURE SP_agregar_resolucion(IN numeroResolucion VARCHAR(8), IN tipoResolucion VARCHAR(50), IN archivo MEDIUMBLOB, IN autor CHAR(8))
BEGIN
    INSERT INTO resolucion VALUES (numeroResolucion, tipoResolucion, CURDATE(), archivo, autor);
END
// DELIMITER ;

DELIMITER //
CREATE PROCEDURE SP_buscar_resolucion_validar(IN numeroResolucion VARCHAR(8))
BEGIN
    SELECT numero FROM resolucion
    WHERE numero = numeroResolucion;
END
// DELIMITER ;

DELIMITER //
CREATE PROCEDURE SP_editar_resolucion_archivo(IN numeroResolucion VARCHAR(8), IN numeroResolucionNuevo VARCHAR(8), IN tipoResolucion VARCHAR(50), IN archivo_ MEDIUMBLOB, IN autor_ CHAR(8))
BEGIN
    UPDATE resolucion SET numero = numeroResolucionNuevo, tipo = tipoResolucion, fecha = CURDATE(), archivo=archivo_, autor = autor_
    WHERE numero = numeroResolucion;
END
// DELIMITER ;

DELIMITER //
CREATE PROCEDURE SP_editar_resolucion_datos(IN numeroResolucion VARCHAR(8), IN numeroResolucionNuevo VARCHAR(8), IN tipoResolucion VARCHAR(50), IN autor_ CHAR(8))
BEGIN
    UPDATE resolucion SET numero = numeroResolucionNuevo, tipo = tipoResolucion, fecha = CURDATE(), autor = autor_
    WHERE numero = numeroResolucion;
END
// DELIMITER ;

DELIMITER //
CREATE PROCEDURE SP_buscar_resolucion_validar_editando(IN numeroResolucion VARCHAR(8), IN numeroResolucionNuevo VARCHAR(8))
BEGIN
    SELECT numero FROM resolucion
    WHERE numero = numeroResolucionNuevo AND numero != numeroResolucion;
END
// DELIMITER ;

DELIMITER //
CREATE PROCEDURE SP_mostrar_archivo(IN numeroResolucion VARCHAR(8))
BEGIN
    SELECT archivo FROM resolucion 
    WHERE numero = numeroResolucion;
END
// DELIMITER ;

DELIMITER //

CREATE TRIGGER calcular_promedio
BEFORE INSERT ON sustentacion_jurado
FOR EACH ROW
BEGIN
    DECLARE total INT;
    DECLARE promedio DECIMAL(10, 2);

    SELECT COUNT(*) INTO total
    FROM sustentacion_jurado
    WHERE ID_sustentacion = NEW.ID_sustentacion;

    IF total = 3 THEN
        SELECT AVG(calificacion) INTO promedio
        FROM sustentacion_jurado
        WHERE ID_sustentacion = NEW.ID_sustentacion;

        UPDATE sustentacion
        SET calificacion = promedio
        WHERE ID_sustentacion = NEW.ID_sustentacion;
    END IF;
END //

DELIMITER ;
