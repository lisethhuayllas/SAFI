<?php
    require_once('../modelos/conexionBD.php');

    class juradoModelo{

        /* se usa para mostrar el rol*/
        static public function rolJurado($DNI){
            $consulta="SELECT J.DNI, Concat(J.Nombre, ' ', J.Apellidos) as 'Jurado', tipo_jurado, Concat(T.Nombre, ' ', T.Apellidos) AS 'Tesista',
            Id_Proyecto,Titulo,Tipo
            FROM Jurado J
            INNER JOIN tipo_jurado  ON Jurado=J.DNI
            INNER JOIN trabajo_investigacion  I ON Proyecto=Id_Proyecto
            INNER JOIN tesista T on T.DNI = Autor
            WHERE J.DNI='$DNI'";

            $respuesta=mysqli_query(conexionBD::conexion(),$consulta);
            return $respuesta;
        }

        static public function verTesis($DNI){
            $consulta="SELECT T.autor, T.estado, TP.jurado, T.Id_proyecto, T.titulo, T.fecha_presentacion, T.archivo, T.tipo, Concat(TE.Nombre, ' ', TE.Apellidos) as 'tesista'
                FROM trabajo_investigacion T
                INNER JOIN tipo_jurado TP ON TP.proyecto=T.Id_proyecto
                INNER JOIN tesista TE ON TE.DNI=T.autor
                WHERE TP.jurado ='$DNI'
                AND TP.tipo_jurado!='SUPLENTE'
                AND T.tipo='Presentacion'";
            $respuesta=mysqli_query(conexionBD::conexion(),$consulta);
            return $respuesta;
        }

        static public function RevisarTesiss($idArchivo,$DNI,$fecha,$estado,$observacion,$tipo){
            $consulta="INSERT INTO revision VALUES(NULL, '$DNI','$fecha','$estado','$idArchivo','$observacion')";
            $respuesta=mysqli_query(conexionBD::conexion(),$consulta);
            return $respuesta;
        }

        static public function verArchivo($DNI,$archivo){
            $consulta="SELECT T.Id_proyecto,T.archivo
                FROM trabajo_investigacion T
                INNER JOIN tipo_jurado TP ON TP.proyecto=T.Id_proyecto
                WHERE TP.jurado ='$DNI'
                AND T.Id_proyecto = '$archivo'";
            $respuesta=mysqli_query(conexionBD::conexion(),$consulta);
            return $respuesta;
        }

        static public function contarRevision($DNI,$archivo){
            
            $consulta="SELECT COUNT(trabajo_revisado) AS 'revision', estado_revision FROM revision WHERE DNI_jurado='$DNI' AND trabajo_revisado=$archivo";
            $res=mysqli_query(conexionBD::conexion(),$consulta);
            return $res->fetch_array(MYSQLI_ASSOC);
        }
/*==================*/
        static public function TesisSustentacion($DNI){
            $consulta="SELECT TP.jurado,T.autor, T.Id_proyecto, T.titulo, T.fecha_presentacion, T.archivo, T.tipo, Concat(TE.Nombre, ' ', TE.Apellidos) as 'tesista', TP.tipo_jurado
                FROM trabajo_investigacion T
                INNER JOIN tipo_jurado TP ON TP.proyecto=T.Id_proyecto
                INNER JOIN tesista TE ON TE.DNI=T.autor
                WHERE TP.jurado ='$DNI'
                AND TP.tipo_jurado!='SUPLENTE'
                AND T.tipo='Sustentacion'
                AND TE.Estado='Activo'";
            $respuesta=mysqli_query(conexionBD::conexion(),$consulta);
            return $respuesta;
        }

        static public function Verificartesiss($archivo){
            
            $consulta="SELECT ID_sustentacion FROM sustentacion WHERE proyecto=$archivo;";
            $res=mysqli_query(conexionBD::conexion(),$consulta);
            return $res->fetch_array(MYSQLI_ASSOC);
        }

        static public function contarRevisionSust($DNI,$id){
            
            $consulta="SELECT COUNT(calificacion) AS 'revision', calificacion FROM sustentacion_jurado WHERE DNI_jurado='$DNI' AND ID_sustentacion=$id";
            $res=mysqli_query(conexionBD::conexion(),$consulta);
            return $res->fetch_array(MYSQLI_ASSOC);
        }

        static public function RevisarTesisSust($idArchivo,$DNI,$calificacion,$sustentacion){
            $consulta="INSERT INTO sustentacion_jurado VALUES('$sustentacion','$DNI','$calificacion')";
            $respuesta=mysqli_query(conexionBD::conexion(),$consulta);
            return $respuesta;
        }

        static public function contarFecha($archivo){
            
            $consulta="SELECT COUNT(proyecto) AS 'revision', estado FROM sustentacion WHERE proyecto=$archivo;";
            $res=mysqli_query(conexionBD::conexion(),$consulta);
            return $res->fetch_array(MYSQLI_ASSOC);
        }


        


        static public function contarRevision2($archivo){
            
            $consulta="SELECT COUNT(trabajo_revisado) AS 'revision' FROM revision WHERE trabajo_revisado=$archivo";
            $res=mysqli_query(conexionBD::conexion(),$consulta);
            return $res->fetch_array(MYSQLI_ASSOC);
        }

        static public function RevisarTesisSustentacion($id,$DNI,$nota){
            $consulta="INSERT INTO sustentacion_jurado VALUES($id, '$DNI','$nota')";
            $respuesta=mysqli_query(conexionBD::conexion(),$consulta);
            return $respuesta;
        }

        static public function verTesisFinal($DNI){
            $consulta="SELECT T.autor,T.estado, TP.jurado, T.Id_proyecto, T.titulo, T.fecha_presentacion, T.archivo, T.tipo, Concat(TE.Nombre, ' ', TE.Apellidos) as 'tesista'
                FROM trabajo_investigacion T
                INNER JOIN tipo_jurado TP ON TP.proyecto=T.Id_proyecto
                INNER JOIN tesista TE ON TE.DNI=T.autor
                WHERE TP.jurado ='$DNI'
                AND TP.tipo_jurado='PRESIDENTE'";
            $respuesta=mysqli_query(conexionBD::conexion(),$consulta);
            return $respuesta;
        }

        static public function Fecha_Sustentacion($idArchivo,$DNI,$lugar,$fecha,$hora){
            $consulta="INSERT INTO sustentacion VALUES(NULL, '$lugar','$fecha','$hora','Pendiente',0,'$idArchivo')";
            $respuesta=mysqli_query(conexionBD::conexion(),$consulta);
            return $respuesta;
        }

        

        

        
        static public function contarRevisionSust2($id){
            
            $consulta="SELECT COUNT(calificacion) AS 'revision' FROM sustentacion_jurado WHERE ID_sustentacion=$id";
            $res=mysqli_query(conexionBD::conexion(),$consulta);
            return $res->fetch_array(MYSQLI_ASSOC);
        }

        static public function CalificarTesisP_M($id,$DNI,$estado){
            $consulta="UPDATE trabajo_investigacion SET estado = '$estado' WHERE ID_proyecto = $id AND autor = '$DNI'";
            $respuesta=mysqli_query(conexionBD::conexion(),$consulta);
            return $respuesta;
        }

        static public function CalificarTesisS_M($idArchivo,$Idsus,$nota,$estado){
            $consulta="UPDATE sustentacion SET estado = '$estado', calificacion=$nota WHERE ID_sustentacion = $Idsus AND proyecto=$idArchivo";
            $respuesta=mysqli_query(conexionBD::conexion(),$consulta);
            return $respuesta;
        }

        static public function verFecha($id){
            
            $consulta="SELECT ID_sustentacion, lugar, fecha_sustentacion, hora, proyecto, calificacion FROM sustentacion WHERE ID_sustentacion=$id";
            $res=mysqli_query(conexionBD::conexion(),$consulta);
            return $res->fetch_array(MYSQLI_ASSOC);
        }
    } 
?>