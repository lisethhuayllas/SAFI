<?php
    session_start();
    require_once('../../modelos/administrador/resoluciones_modelo.php');

    class resolucionesControlador{
        static public function mostrarResoluciones($tipoBusqueda, $numeroResolucion){
            if($tipoBusqueda == "automatico"){
                $respuesta= resolucionesModelo::recuperaDatosResoluciones("Sin filtro", "");
            
            }else{
                $respuesta= resolucionesModelo::recuperaDatosResoluciones("Con filtro", $numeroResolucion);
            }
            
            $contenidoTabla="";

            for($i=0; $i<mysqli_num_rows($respuesta); $i++){
                $datos=mysqli_fetch_assoc($respuesta);
                $numero=$datos['numero'];
                $tipo=$datos['tipo'];
                $fechaCarga=$datos['fecha'];

                $contenidoTabla = $contenidoTabla .
                    "<tr>
                        <td>$numero</td>
                        <td>$tipo</td>
                        <td>$fechaCarga</td>
                        <td>
                            <button class='boton_mostrar' onclick='mostrarPDF(`$numero`)'>
                                <i class='fa-solid fa-eye'></i>
                            </button>

                            <button class='boton_editar' onclick='mostrarModalEditar(`$numero`, `$tipo`)'>
                                <i class='fa-solid fa-pen-to-square'></i>
                            </button>
                        </td>
                    </tr>";
            }

            return $contenidoTabla;
        }

        static public function cargarResolucion($numeroResolucion, $tipoResolucion, $archivo, $autor){
            resolucionesModelo::agregarResolucion($numeroResolucion, $tipoResolucion, $archivo, $autor);
        
        }

        static public function editarResolucion($numeroResolucion, $numeroResolucionNuevo, $tipoResolucion, $archivo, $autor, $archivoModificado){
            resolucionesModelo::editarResolucion($numeroResolucion, $numeroResolucionNuevo, $tipoResolucion, $archivo, $autor, $archivoModificado);
        }

        static public function validarExistenciaResolucion($numeroResolucion){
            $coincidencias = resolucionesModelo::buscarResolucionValidar($numeroResolucion);
            
            if($coincidencias == 0){
                return false;
            }

            return true;
        }

        static public function validarExistenciaResolucionEditando($numeroResolucion, $numeroResolucionNuevo){
            $coincidencias = resolucionesModelo::buscarResolucionValidarEditando($numeroResolucion, $numeroResolucionNuevo);
            
            if($coincidencias == 0){
                return false;
            }

            return true;
        }

        static public function mostrarPDF($numeroResolucion){
            $respuesta = resolucionesModelo::recuperarPDF($numeroResolucion);
            $archivo = mysqli_fetch_array($respuesta)[0];
            return $archivo;
        }

        static public function controladorPOST(){
            if(isset($_POST['mostrar_resoluciones'])){
                echo resolucionesControlador::mostrarResoluciones("automatico", "");

            }else if(isset($_POST['busqueda_numero_resolucion'])){
                $numeroResolucion= $_POST['numero_resolucion'];
                echo resolucionesControlador::mostrarResoluciones("buscador" , $numeroResolucion);

                unset($_POST['busqueda_numero_resolucion'], $_POST['numero_resolucion']);
            
            }else if(isset($_POST['validar_existencia_resolucion'])){
                $numeroResolucion = $_POST['numero'];
                echo resolucionesControlador::validarExistenciaResolucion($numeroResolucion);

                unset($_POST['validar_existencia_resolucion'], $_POST['numero']);

            }else if(isset($_POST['cargar_resolucion'])){
                $numeroResolucion = $_POST['numero'];
                $tipoResolucion = $_POST['tipo'];
                $archivo = file_get_contents($_FILES['archivo']['tmp_name']);
                $DNIadministrador= $_SESSION['DNI-usuario'];

                resolucionesControlador::cargarResolucion($numeroResolucion, $tipoResolucion, $archivo, $DNIadministrador);
            
                unset($_POST['cargar_resolucion'], $_POST['numero'], $_POST['tipo'], $_FILES['archivo']);

            }else if(isset($_POST['validar_existencia_resolucion_editando'])){
                $numeroResolucion = $_POST['numero'];
                $numeroResolucionNuevo = $_POST['numero_nuevo'];

                echo resolucionesControlador::validarExistenciaResolucionEditando($numeroResolucion, $numeroResolucionNuevo);

                unset($_POST['validar_existencia_resolucion_editando'], $_POST['numero'], $_POST['numero_nuevo']);
            
            }else if(isset($_POST['editar_resolucion']) && isset($_POST['archivo_no_modificado'])){
                $numeroResolucion = $_POST['numero'];
                $numeroResolucionNuevo = $_POST['numero_nuevo'];
                $tipoResolucion = $_POST['tipo'];
                $DNIadministrador= $_SESSION['DNI-usuario'];

                resolucionesControlador::editarResolucion($numeroResolucion, $numeroResolucionNuevo, $tipoResolucion, "", $DNIadministrador, false);

                unset($_POST['editar_resolucion'], $_POST['archivo_no_modificado'], $_POST['numero'], $_POST['numero_nuevo'], $_POST['tipo']);
            
            }else if(isset($_POST['editar_resolucion']) && isset($_POST['archivo_modificado'])){
                $numeroResolucion = $_POST['numero'];
                $numeroResolucionNuevo = $_POST['numero_nuevo'];
                $tipoResolucion = $_POST['tipo'];
                $archivo = file_get_contents($_FILES['archivo']['tmp_name']);
                $DNIadministrador= $_SESSION['DNI-usuario'];

                resolucionesControlador::editarResolucion($numeroResolucion, $numeroResolucionNuevo, $tipoResolucion, $archivo, $DNIadministrador, true);

                unset($_POST['editar_resolucion'], $_POST['archivo_modificado'], $_POST['numero'], $_POST['numero_nuevo'], $_POST['tipo'], $_FILES['archivo']);
            
            }else if(isset($_POST['mostrar_archivo_PDF'])){
                $numeroResolucion = $_POST['numero'];
                echo resolucionesControlador::mostrarPDF($numeroResolucion);

                unset($_POST['mostrar_archivo_PDF'], $_POST['numero']);
            }
        }
    }

    resolucionesControlador::controladorPOST();
?>