<?php
    require_once('../../modelos/administrador/jurados_modelo.php');

    class juradosControlador{

        static private function mostrarJuradosEnTabla($carrera,$modoBusqueda){
            if($modoBusqueda=='Botón'){
                $datos=juradosModelo::recuperaJurados($carrera);

            }else if($modoBusqueda=='Input'){
                $DNI_busqueda=$carrera;
                $datos=juradosModelo::recuperaJuradosInput($DNI_busqueda);
            }
            
            $arrayDatos=[];
            
            $columnasTabla='';

            for($i=0; $i<mysqli_num_rows($datos) ;$i++){
                $datosPersonales=mysqli_fetch_array($datos);

                $DNI=$datosPersonales['DNI'];
                $nombreCompleto=$datosPersonales['nombre_completo'];
                $escuela=$datosPersonales['escuela'];
                $trabajosPorRevisar=$datosPersonales['trabajos_a_revisar'];

                $columnasTabla = $columnasTabla .
                    "<tr>
                        <td>$nombreCompleto</td>
                        <td>$escuela</td>
                        <td>$trabajosPorRevisar</td>
                        <td>
                            <button class='boton_mostrar' id='mostrar_detalles_$DNI' onclick=detallesJurado('$DNI')>
                                <i class='fa-solid fa-eye'></i>
                            </button>
                            
                            <button class='boton_editar' id='editar_informacion_$DNI' onclick=editarInformacionJurado('$DNI')>
                                <i class='fa-solid fa-pen-to-square'></i>
                            </button>
                        </td>
                    </tr>";
            }

            $arrayDatos=[$columnasTabla,mysqli_num_rows($datos)];
            return $arrayDatos;
        }

        static private function mostrarModalAñadirJurado(){
            $contenidoFormulario='';
            $contenidoFormulario= $contenidoFormulario .
                "<div class='contenedor_formulario' id='contenedor_formulario'>
                    <div class='cabecera_formulario'>
                        <span>AÑADIR NUEVO JURADO</span>
                        
                        <div class='contenedor_boton'>
                            <button id='boton-cerrar' onclick=desactivaModal()>
                                <i class='fa-solid fa-xmark'></i>
                            </button>
                        </div>
                    </div>
                    
                    <form class='formulario_datos' id='formulario_datos'>
                        <div class='seccion_input'>
                            <label for='input_nombre'>NOMBRE</label>
                            <input class='input_nombre' id='input_nombre' placeholder='Ingrese el nombre del jurado' maxlength='45'>
                        </div>

                        <div class='seccion_input input_izquierda'>
                            <label for='input_apellidos'>APELLIDOS</label>
                            <input class='input_apellidos' id='input_apellidos' placeholder='Ingrese los apellidos del jurado' maxlength='50'>
                        </div>

                        <div class='seccion_input'>
                            <label for='input_DNI'>DNI</label>
                            <input class='input_DNI' id='input_DNI' placeholder='Ingrese el número de DNI del jurado' maxlength='8'>
                        </div>

                        <div class='seccion_input input_izquierda'>
                            <label for='input_correo'>CORREO</label>
                            <input class='input_correo' id='input_correo' placeholder='Ingrese el correo del jurado' maxlength='45'>
                        </div>

                        <div class='seccion_input'>
                            <label for='input_celular'>NRO. CELULAR</label>
                            <input class='input_celular' id='input_celular' placeholder='Ingrese el número de celular del jurado' maxlength='9'>
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

                        <div class='seccion_guardar' id='seccion_guardar'>
                            <button id='boton_guardar' type='submit'>
                                GUARDAR<i class='fa-solid fa-floppy-disk'></i>
                            </button>
                        </div>
                    </form>
                </div>";
                
            return $contenidoFormulario;
        }

        static public function mostrarModalDetallesJurado($DNI){
            $datosJurado=juradosModelo::recuperaDetallesJurado($DNI);
            $datos=mysqli_fetch_assoc($datosJurado);
            
            $contenidoFormulario='';
            $contenidoFormulario= $contenidoFormulario .
                "<div class='contenedor_formulario'>
                    <div class='cabecera_formulario'>
                        <span>DETALLES DEL JURADO</span>
                        
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
                            <label for='input_revisiones_asignadas'>REVISIONES ASIGNADAS</label>
                            <input class='input_revisiones_asignadas' id='input_revisiones_asignadas' value='$datos[trabajos_a_revisar]' disabled>
                        </div>
                    </form>
                </div>";
                
            return $contenidoFormulario;
        }

        static public function mostrarModalEditarInformacionJurado($DNI){
            $datosJurado=juradosModelo::recuperaDetallesJurado($DNI);
            $datos=mysqli_fetch_assoc($datosJurado);

            $opcionesEscuela='';

            if($datos['escuela']=='Ingeniería de sistemas'){
                $opcionesEscuela= $opcionesEscuela .'
                    <option selected=true>Ingeniería de sistemas</option>
                    <option>Ingeniería ambiental</option>
                    <option>Ingeniería agroindustrial</option>
                ';

            }else if($datos['escuela']=='Ingeniería ambiental'){
                $opcionesEscuela= $opcionesEscuela .'
                    <option>Ingeniería de sistemas</option>
                    <option  selected=true>Ingeniería ambiental</option>
                    <option>Ingeniería agroindustrial</option>
                ';

            }else if($datos['escuela']=='Ingeniería agroindustrial'){
                $opcionesEscuela= $opcionesEscuela .'
                    <option>Ingeniería de sistemas</option>
                    <option>Ingeniería ambiental</option>
                    <option selected=true>Ingeniería agroindustrial</option>
                ';
            }
            
            $contenidoFormulario='';
            $contenidoFormulario= $contenidoFormulario .
                "<div class='contenedor_formulario' id='contenedor_formulario'>
                    <div class='cabecera_formulario'>
                        <span>EDITAR INFORMACIÓN DEL JURADO</span>
                        
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
                            <input class='input_correo' id='input_correo' value=$datos[correo] maxlength='45'>
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
            if(isset($_POST['mostrar_jurados_carrera'])){
                $carrera = $_POST['carrera'];

                print_r (json_encode(juradosControlador::mostrarJuradosEnTabla($carrera,'Botón')));
                
                unset($_POST['mostrar_jurados_carrera']);

            }else if(isset($_POST['mostrar_todos_jurados'])){
                print_r (json_encode(juradosControlador::mostrarJuradosEnTabla('Todos','Botón')));
                
                unset($_POST['mostrar_todos_jurados']);

            }if(isset($_POST['busqueda_DNI'])){
                $DNI = $_POST['DNI'];

                print_r (json_encode(JuradosControlador::mostrarJuradosEnTabla($DNI,'Input')));
                unset($_POST['busqueda_DNI'], $_POST['DNI']);

            }
            else if(isset($_POST['mostrar_modal_añadir_jurado'])){
                echo (juradosControlador::mostrarModalAñadirJurado());
                unset($_POST['mostrar_modal_añadir_jurado']);

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

                echo (juradosModelo::añadirJurado($DNI,$contraseña,$nombre,$apellidos,$correo,$celular,$escuela));

                unset($_POST['guardar_informacion_añadida'], $_POST['DNI'], $_POST['nombre'], $_POST['apellidos']);
                unset($_POST['escuela'], $_POST['correo'], $_POST['celular']);

            }else if(isset($_POST['mostrar_jurados_carrera'])){
                $carrera = $_POST['carrera'];

                print_r (json_encode(juradosControlador::mostrarJuradosEnTabla($carrera,'Botón')));
                
                unset($_POST['mostrar_jurados_carrera']);

            }else if(isset($_POST['mostrar_modal_detalles_jurado'])){
                $DNI = $_POST['DNI'];

                echo (juradosControlador::mostrarModalDetallesJurado($DNI));
                
                unset($_POST['mostrar_modal_detalles_jurado'], $_POST['DNI']);

            }else if(isset($_POST['modal_editar_informacion_jurado'])){
                $DNI = $_POST['DNI'];

                echo (juradosControlador::mostrarModalEditarInformacionJurado($DNI));
                
                unset($_POST['modal_editar_informacion_jurado'], $_POST['DNI']);

            }else if(isset($_POST['guardar_informacion_editada'])){
                $nombre =$_POST['nombre']; 
                $apellidos =$_POST['apellidos'];
                $DNIviejo =$_POST['DNIviejo']; 
                $DNInuevo =$_POST['DNInuevo'];
                $correo =$_POST['correo']; 
                $celular =$_POST['celular'];

                if($_POST['escuela'] == 'Ingeniería de sistemas'){
                    $escuela =1;

                }else if($_POST['escuela'] == 'Ingeniería ambiental'){
                    $escuela =2;

                }else if($_POST['escuela'] == 'Ingeniería agroindustrial'){
                    $escuela =3;
                    
                }

                juradosModelo::actualizaInformacionJurado($nombre,$apellidos,$DNIviejo,$DNInuevo,$escuela,$correo,$celular);
                
                unset($_POST['guardar_informacion_editada'], $_POST['nombre'], $_POST['apellidos'], $_POST['DNI']);
                unset($_POST['escuela'], $_POST['correo'], $_POST['celular']);

            }else if(isset($_POST['verificar_datos_repetidos'])){
                $DNI_viejo = $_POST['DNI_viejo'];
                $DNI_nuevo = $_POST['DNI_nuevo'];
                $correo = $_POST['correo'];
                $celular = $_POST['celular'];

                if($_POST['accion'] == 'Añadir'){
                    echo juradosModelo::verificaDatosRepetidos($DNI_viejo,$DNI_nuevo, $correo, $celular , "Añadir");

                }elseif($_POST['accion']){
                    echo juradosModelo::verificaDatosRepetidos($DNI_viejo,$DNI_nuevo, $correo, $celular , "Editar");

                }
                
                unset($_POST['verificar_datos_repetidos'], $_POST['DNI_viejo'], $_POST['DNI_nuevo']);    
                unset($_POST['correo'], $_POST['celular']);
            }
        }
    }

    juradosControlador::verificaPost();
?>