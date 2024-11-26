<?php
    require_once('../../modelos/administrador/trabajos_investigacion_modelo.php');

    class trabajosInvestigacionControlador{
        static public function recuperaTrabajosInvestigacion($tipoBusqueda, $textoBusqueda){
            if($tipoBusqueda == "Todos"){
                $respuesta=trabajosInvestigacionModelo::recuperaTrabajosInvestigacion();
            
            }else{
                $respuesta=trabajosInvestigacionModelo::buscaTrabajosInvestigacion($textoBusqueda);
            }
            
            $contenidoTabla="";

            for($i=0; $i<mysqli_num_rows($respuesta); $i++){
                $datos=mysqli_fetch_assoc($respuesta);
                $ID=$datos['ID_proyecto'];
                $titulo=$datos['titulo'];
                $autor=$datos['autor'];
                $estado=$datos['estado'];

                $contenidoTabla = $contenidoTabla .
                    "<tr>
                        <td>$titulo</td>
                        <td>$autor</td>
                        <td>
                            <button class='boton_mostrar' onclick='abrirPDF($ID,`$titulo`)'><i class='fa-solid fa-eye'></i></button>
                        </td>";
                    $estado == "Pendiente" ? 
                            $contenidoTabla = $contenidoTabla.
                            "<td>
                            <button class='boton_proyecto_sustentado' onclick='mostrarModalProyectoSustentado($ID)'><i class='fa-solid fa-check'></i></i></button>
                            </td>
                            </tr>" 
                            // <button class='boton_editar_jurados' onclick='abrirPDF($ID,`$titulo`)' style='margin-right: 10px;'><i class='fa-solid fa-people-roof icono'></i></button>
                        : 
                        $contenidoTabla = $contenidoTabla.
                        "<td>
                        <button class='boton_proyecto_pendiente' onclick='mostrarModalProyectoPendiente($ID)'><i class='fa-solid fa-xmark'></i></button>
                        </td>
                        </tr>";
                        // <button class='boton_editar_jurados' onclick='abrirPDF($ID,`$titulo`)' style='margin-right: 10px;'><i class='fa-solid fa-people-roof icono'></i></button>
            }

            return $contenidoTabla;
        }

        static public function mostrarPDFTrabajoInvestigacion($IDtrabajo){
            $respuesta = trabajosInvestigacionModelo::recuperaPDFTrabajoInvestigacion($IDtrabajo);
            $archivo = mysqli_fetch_array($respuesta)[0];
            return $archivo;
        }

        static public function controladorPOST(){
            if(isset($_POST['mostrar_trabajos_investigacion'])){
                echo trabajosInvestigacionControlador::recuperaTrabajosInvestigacion("Todos","");
                
                unset($_POST['mostrar_trabajos_investigacion']);

            }else if(isset($_POST['buscar_trabajos_investigacion'])){
                $textoBusqueda = $_POST['texto'];

                echo trabajosInvestigacionControlador::recuperaTrabajosInvestigacion("Texto", $textoBusqueda);
                unset($_POST['buscar_trabajos_investigacion'] , $_POST['texto']);
            
            }else if(isset($_POST['mostrar_PDF_trabajo_investigacion'])){
                $IDtrabajo = $_POST['idTrabajo'];

                echo trabajosInvestigacionControlador::mostrarPDFTrabajoInvestigacion($IDtrabajo);
                unset($_POST['mostrar_PDF_trabajo_investigacion'] , $_POST['idTrabajo']);
            
            }else if(isset($_POST['cambiar_estado_proyecto'])){
                $IDproyecto = $_POST['IDproyecto'];
                $nuevoEstado = $_POST['estado'];
                trabajosInvestigacionModelo::cambiarEstadoProyecto($IDproyecto, $nuevoEstado);
            }
        }
    }

    trabajosInvestigacionControlador::controladorPOST();
?>