<?php
    require_once('../../modelos/administrador/asesores_modelo.php');

    class asesoresControlador{

        static private function mostrarAsesoresEnTabla($carrera,$modoBusqueda){
            if($modoBusqueda=='Botón'){
                $datos=asesoresModelo::recuperaAsesores($carrera);

            }else if($modoBusqueda=='Input'){
                $DNI_busqueda=$carrera;
                $datos=asesoresModelo::recuperaAsesoresInput($DNI_busqueda);
            }
            
            $arrayDatos=[];
            
            $columnasTabla='';

            for($i=0; $i<mysqli_num_rows($datos) ;$i++){
                $datosPersonales=mysqli_fetch_array($datos);

                $DNI=$datosPersonales['DNI'];
                $nombreCompleto=$datosPersonales['nombre_completo'];
                $escuela=$datosPersonales['escuela'];
                $asesorados=$datosPersonales['asesorados'];

                $columnasTabla = $columnasTabla .
                    "<tr>
                        <td>$nombreCompleto</td>
                        <td>$escuela</td>
                        <td>$asesorados</td>
                        <td>
                            <button class='boton_mostrar' id='mostrar_detalles_$DNI' onclick=detallesAsesor('$DNI')>
                                <i class='fa-solid fa-eye'></i>
                            </button>
                            
                            <button class='boton_editar' id='editar_informacion_$DNI' onclick=editarInformacionAsesor('$DNI')>
                                <i class='fa-solid fa-pen-to-square'></i>
                            </button>
                        </td>
                    </tr>";
            }

            $arrayDatos=[$columnasTabla,mysqli_num_rows($datos)];
            return $arrayDatos;
        }

        static private function mostrarModalAñadirAsesor(){
            $contenidoFormulario='';
            $contenidoFormulario= $contenidoFormulario .
                "<div class='contenedor_formulario' id='contenedor_formulario'>
                    <div class='cabecera_formulario'>
                        <span>AÑADIR NUEVO ASESOR</span>
                        
                        <div class='contenedor_boton'>
                            <button id='boton-cerrar' onclick=desactivaModal()>
                                <i class='fa-solid fa-xmark'></i>
                            </button>
                        </div>
                    </div>
                    
                    <form class='formulario_datos' id='formulario_datos'>
                        <div class='seccion_input'>
                            <label for='input_nombre'>NOMBRE</label>
                            <input class='input_nombre' id='input_nombre' placeholder='Ingrese el nombre del asesor' maxlength='45'>
                        </div>

                        <div class='seccion_input input_izquierda'>
                            <label for='input_apellidos'>APELLIDOS</label>
                            <input class='input_apellidos' id='input_apellidos' placeholder='Ingrese los apellidos del asesor' maxlength='50'>
                        </div>

                        <div class='seccion_input'>
                            <label for='input_DNI'>DNI</label>
                            <input class='input_DNI' id='input_DNI' placeholder='Ingrese el número de DNI del asesor' maxlength='8'>
                        </div>

                        <div class='seccion_input input_izquierda'>
                            <label for='input_correo'>CORREO</label>
                            <input class='input_correo' id='input_correo' placeholder='Ingrese el correo del asesor' maxlength='50'>
                        </div>

                        <div class='seccion_input'>
                            <label for='input_celular'>NRO. CELULAR</label>
                            <input class='input_celular' id='input_celular' placeholder='Ingrese el número de celular del asesor' maxlength='9'>
                        </div>

                        <div class='seccion_input input_izquierda'>
                            <label for='input_escuela'>ESCUELA PROFESIONAL</label>
                            <select class='input_escuela' id='input_escuela'>
                                <option disabled='disabled' selected>Seleccione la escuela profesional</option>
                                <option id=1>Ingeniería de sistemas</option>
                                <option id=2>Ingeniería ambiental</option>
                                <option id=3>Ingeniería agroindustrial</option>
                            </select>
                        </div>

                        <div class='seccion_input'>
                            <label for='input_tipo_docente'>TIPO DE DOCENTE</label>
                            <select class='input_tipo_docente' id='input_tipo_docente'>
                                <option disabled='disabled' selected>Seleccione el tipo de docente</option>
                                <option>Nombrado</option>
                                <option>Contratado</option>
                            </select>
                        </div>

                        <div class='seccion_guardar' id='seccion_guardar'>
                            <button id='boton_guardar' type='submit'>
                                GUARDAR<i class='fa-solid fa-floppy-disk'></i>
                            </button>
                        </div>
                    </form>
                </div>";
                
            return $contenidoFormulario;
        }

        static public function mostrarModalDetallesAsesor($DNI){
            $datosAsesor=asesoresModelo::recuperaDetallesAsesor($DNI);
            $datos=mysqli_fetch_assoc($datosAsesor);
            
            $contenidoFormulario='';
            $contenidoFormulario= $contenidoFormulario .
                "<div class='contenedor_formulario'>
                    <div class='cabecera_formulario'>
                        <span>DETALLES DEL ASESOR</span>
                        
                        <div class='contenedor_boton'>
                            <button id='boton-cerrar' onclick=desactivaModal()>
                                <i class='fa-solid fa-xmark'></i>
                            </button>
                        </div>
                    </div>
                    
                    <form class='formulario_datos'>
                        <div class='seccion_input'>
                            <label for='input_nombre'>NOMBRE</label>
                            <input class='input_nombre' id='input_nombre' value='$datos[nombre]' disabled>
                        </div>

                        <div class='seccion_input input_izquierda'>
                            <label for='input_apellidos'>APELLIDOS</label>
                            <input class='input_apellidos' id='input_apellidos' value='$datos[apellidos]' disabled>
                        </div>

                        <div class='seccion_input'>
                            <label for='input_DNI'>DNI</label>
                            <input class='input_DNI' id='input_DNI' value='$datos[DNI]' disabled>
                        </div>

                        <div class='seccion_input input_izquierda'>
                        <label for='input_correo'>CORREO</label>
                        <input class='input_correo' id='input_correo' value='$datos[correo]' disabled>
                        </div>

                        <div class='seccion_input'>
                            <label for='input_celular'>NRO. CELULAR</label>
                            <input class='input_celular' id='input_celular' value='$datos[celular]' disabled>
                        </div>

                        <div class='seccion_input input_izquierda'>
                            <label for='input_escuela'>ESCUELA PROFESIONAL</label>
                            <input class='input_escuela' id='input_escuela' value='$datos[escuela]' disabled>
                        </div>

                        <div class='seccion_input'>
                            <label for='input_docente'>TIPO DE DOCENTE</label>
                            <input class='input_docente' id='input_docente' value='$datos[tipo_docente]' disabled>
                        </div>

                        <div class='seccion_input input_izquierda'>
                            <label for='input_cantidad_asesorados'>CANTIDAD DE ASESORADOS</label>
                            <input class='input_cantidad_asesorados' id='input_cantidad_asesorados' value='$datos[asesorados]' disabled>
                        </div>
                    </form>
                </div>";
                
            return $contenidoFormulario;
        }

        static public function mostrarModalEditarInformacionAsesor($DNI){
            $datosAsesor=asesoresModelo::recuperaDetallesAsesor($DNI);
            $datos=mysqli_fetch_assoc($datosAsesor);

            $opcionesEscuela='';
            $opcionesTipoDocente='';

            if($datos['escuela']=='Ingeniería de sistemas'){
                $opcionesEscuela= $opcionesEscuela .'
                    <option selected=true>Ingeniería de sistemas</option>
                    <option>Ingeniería ambiental</option>
                    <option>Ingeniería agroindustrial</option>
                ';

            }else if($datos['escuela']=='Ingeniería ambiental'){
                $opcionesEscuela= $opcionesEscuela .'
                    <option>Ingeniería de sistemas</option>
                    <option selected=true>Ingeniería ambiental</option>
                    <option>Ingeniería agroindustrial</option>
                ';

            }else if($datos['escuela']=='Ingeniería agroindustrial'){
                $opcionesEscuela= $opcionesEscuela .'
                    <option>Ingeniería de sistemas</option>
                    <option>Ingeniería ambiental</option>
                    <option selected=true>Ingeniería agroindustrial</option>
                ';
            }

            if($datos['tipo_docente'] == 'Nombrado'){
                $opcionesTipoDocente= $opcionesTipoDocente .'
                <option selected=true>Nombrado</option>
                <option>Contratado</option>';

            }else if($datos['tipo_docente'] == 'Contratado'){
                $opcionesTipoDocente= $opcionesTipoDocente .'
                <option>Nombrado</option>
                <option selected=true>Contratado</option>';
            }

            $contenidoFormulario='';
            $contenidoFormulario= $contenidoFormulario .
            "<div class='contenedor_formulario' id='contenedor_formulario'>
                    <div class='cabecera_formulario'>
                        <span>EDITAR INFORMACIÓN DEL ASESOR</span>
                        
                        <div class='contenedor_boton'>
                            <button id='boton-cerrar' onclick=desactivaModal()>
                                <i class='fa-solid fa-xmark'></i>
                            </button>
                        </div>
                    </div>
                    
                    <form class='formulario_datos' id='formulario_datos'>
                        <div class='seccion_input'>
                            <label for='input_nombre'>NOMBRE</label>
                            <input class='input_nombre' id='input_nombre' value=$datos[nombre] maxlength='45'>
                        </div>

                        <div class='seccion_input input_izquierda'>
                            <label for='input_apellidos'>APELLIDOS</label>
                            <input class='input_apellidos' id='input_apellidos' value=$datos[apellidos] maxlength='50'>
                        </div>

                        <div class='seccion_input'>
                            <label for='input_DNI'>DNI</label>
                            <input class='input_DNI' id='input_DNI' value=$datos[DNI] maxlength='8'>
                        </div>

                        <div class='seccion_input input_izquierda'>
                            <label for='input_correo'>CORREO</label>
                            <input class='input_correo' id='input_correo' value=$datos[correo] maxlength='50'>
                        </div>

                        <div class='seccion_input'>
                            <label for='input_celular'>NRO. CELULAR</label>
                            <input class='input_celular' id='input_celular' value=$datos[celular] maxlength='9'>
                        </div>

                        <div class='seccion_input input_izquierda'>
                            <label for='input_escuela'>ESCUELA PROFESIONAL</label>
                            <select class='input_escuela' id='input_escuela'>
                                $opcionesEscuela;
                            </select>
                        </div>

                        <div class='seccion_input'>
                            <label for='input_tipo_docente'>TIPO DE DOCENTE</label>
                            <select class='input_tipo_docente' id='input_tipo_docente'>
                                $opcionesTipoDocente;
                            </select>
                        </div>

                        <div class='seccion_guardar' id='seccion_guardar'>
                            <button id='boton_guardar' type='submit'>
                                GUARDAR<i class='fa-solid fa-floppy-disk'></i>
                            </button>
                        </div>
                    </form>
                </div>";
                
            return $contenidoFormulario;
        }

        static public function verificaPost(){
            if(isset($_POST['mostrar_asesores_carrera'])){
                $carrera = $_POST['carrera'];

                print_r (json_encode(asesoresControlador::mostrarAsesoresEnTabla($carrera,'Botón')));
                
                unset($_POST['mostrar_asesores_carrera']);

            }else if(isset($_POST['mostrar_todos_asesores'])){
                print_r (json_encode(asesoresControlador::mostrarAsesoresEnTabla('Todos','Botón')));
                
                unset($_POST['mostrar_todos_asesores']);

            }else if(isset($_POST['busqueda_DNI'])){
                $DNI = $_POST['DNI'];

                print_r (json_encode(asesoresControlador::mostrarAsesoresEnTabla($DNI,'Input')));
                unset($_POST['busqueda_DNI'], $_POST['DNI']);

            }else if(isset($_POST['mostrar_modal_añadir_asesor'])){
                echo (asesoresControlador::mostrarModalAñadirAsesor());
                unset($_POST['mostrar_modal_añadir_asesor']);

            }else if(isset($_POST['verificar_datos_repetidos'])){
                $DNI_viejo = $_POST['DNI_viejo'];
                $DNI_nuevo = $_POST['DNI_nuevo'];
                $correo = $_POST['correo'];
                $celular = $_POST['celular'];

                if($_POST['accion'] == 'Añadir'){
                    echo asesoresModelo::verificaDatosRepetidos($DNI_viejo,$DNI_nuevo, $correo, $celular , "Añadir");

                }elseif($_POST['accion']){
                    echo asesoresModelo::verificaDatosRepetidos($DNI_viejo,$DNI_nuevo, $correo, $celular , "Editar");

                }
                
                unset($_POST['verificar_datos_repetidos'], $_POST['DNI_viejo'], $_POST['DNI_nuevo']);    
                unset($_POST['correo'], $_POST['celular']);
            
            }else if(isset($_POST['guardar_informacion_añadida'])){
                $DNI =$_POST['DNI'];
                $contraseña=password_hash('safiunajma',PASSWORD_DEFAULT);
                $nombre =$_POST['nombre']; 
                $apellidos =$_POST['apellidos'];
                
                if($_POST['escuela'] == 'Ingeniería de sistemas'){
                    $escuela =1;

                }else if($_POST['escuela'] == 'Ingeniería ambiental'){
                    $escuela =2;

                }else if($_POST['escuela'] == 'Ingeniería agroindustrial'){
                    $escuela =3;
                    
                }

                $correo =$_POST['correo']; 
                $celular =$_POST['celular'];
                $tipo_docente =$_POST['tipo_docente'];

                echo (asesoresModelo::añadirAsesor($DNI,$contraseña,$nombre,$apellidos,$correo,$celular,$tipo_docente,$escuela));

                unset($_POST['guardar_informacion_añadida'], $_POST['DNI'], $_POST['nombre'], $_POST['apellidos']);
                unset($_POST['escuela'], $_POST['correo'], $_POST['celular'], $_POST['asesor']);

            }else if(isset($_POST['mostrar_modal_detalles_asesor'])){
                $DNI = $_POST['DNI'];

                echo (asesoresControlador::mostrarModalDetallesAsesor($DNI));
                
                unset($_POST['mostrar_modal_detalles_asesor'], $_POST['DNI']);

            }else if(isset($_POST['modal_editar_informacion_asesor'])){
                $DNI = $_POST['DNI'];

                echo (asesoresControlador::mostrarModalEditarInformacionAsesor($DNI));
                
                unset($_POST['modal_editar_informacion_asesor'], $_POST['DNI']);

            }else if(isset($_POST['guardar_informacion_editada'])){
                $nombre =$_POST['nombre']; 
                $apellidos =$_POST['apellidos'];
                $DNIviejo =$_POST['DNIviejo']; 
                $DNInuevo =$_POST['DNInuevo'];
                $correo =$_POST['correo']; 
                $celular =$_POST['celular'];
                $tipo_docente =$_POST['tipo_docente'];

                if($_POST['escuela'] == 'Ingeniería de sistemas'){
                    $escuela =1;

                }else if($_POST['escuela'] == 'Ingeniería ambiental'){
                    $escuela =2;

                }else if($_POST['escuela'] == 'Ingeniería agroindustrial'){
                    $escuela =3;
                    
                }

                asesoresModelo::actualizaInformacionAsesor($nombre,$apellidos,$DNIviejo,$DNInuevo,$escuela,$correo,$celular,$tipo_docente);
                
                unset($_POST['guardar_informacion_editada'], $_POST['nombre'], $_POST['apellidos'], $_POST['DNIviejo']);
                unset($_POST['DNInuevo'], $_POST['escuela'], $_POST['correo'], $_POST['celular'], $_POST['tipo_docente']);

            }
        }
    }

    asesoresControlador::verificaPost();
?>