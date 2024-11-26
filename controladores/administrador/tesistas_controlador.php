<?php
    require_once('../../modelos/administrador/tesistas_modelo.php');

    class tesistasControlador{

        static private function mostrarTesistasEnTabla($carrera,$modoBusqueda){
            if($modoBusqueda=='Botón'){
                $datos=tesistasModelo::recuperaTesistas($carrera);

            }else if($modoBusqueda=='Input'){
                $DNI_busqueda=$carrera;
                $datos=tesistasModelo::recuperaTesistasInput($DNI_busqueda);
            }
            
            $arrayDatos=[];
            
            $columnasTabla='';

            for($i=0; $i<mysqli_num_rows($datos) ;$i++){
                $datosPersonales=mysqli_fetch_array($datos);

                $DNI=$datosPersonales['DNI'];
                $nombreCompleto=$datosPersonales['nombre_completo'];
                $escuela=$datosPersonales['escuela'];
                $asesor=$datosPersonales['asesor'];

                $columnasTabla = $columnasTabla .
                    "<tr>
                        <td>$nombreCompleto</td>
                        <td>$escuela</td>
                        <td>$asesor</td>
                        <td>
                            <button class='boton_mostrar' id='mostrar_detalles_$DNI' onclick=detallesTesista('$DNI')>
                                <i class='fa-solid fa-eye'></i>
                            </button>
                            
                            <button class='boton_editar' id='editar_informacion_$DNI' onclick=editarInformacionTesista('$DNI')>
                                <i class='fa-solid fa-pen-to-square'></i>
                            </button>
                        </td>
                    </tr>";
            }

            $arrayDatos=[$columnasTabla,mysqli_num_rows($datos)];
            return $arrayDatos;
        }

        static private function mostrarModalAñadirTesista(){
            $contenidoFormulario='';
            $contenidoFormulario= $contenidoFormulario .
                "<div class='contenedor_formulario' id='contenedor_formulario'>
                    <div class='cabecera_formulario'>
                        <span>AÑADIR NUEVO TESISTA</span>
                        
                        <div class='contenedor_boton'>
                            <button id='boton-cerrar' onclick=desactivaModal()>
                                <i class='fa-solid fa-xmark'></i>
                            </button>
                        </div>
                    </div>
                    
                    <form class='formulario_datos' id='formulario_datos'>
                        <div class='seccion_input'>
                            <label for='input_nombre'>NOMBRE</label>
                            <input class='input_nombre' id='input_nombre' placeholder='Ingrese el nombre del tesista' maxlength='45'>
                        </div>

                        <div class='seccion_input input_izquierda'>
                            <label for='input_apellidos'>APELLIDOS</label>
                            <input class='input_apellidos' id='input_apellidos' placeholder='Ingrese los apellidos del tesista' maxlength='50'>
                        </div>

                        <div class='seccion_input'>
                            <label for='input_DNI'>DNI</label>
                            <input class='input_DNI' id='input_DNI' placeholder='Ingrese el número de DNI del tesista' maxlength='8'>
                        </div>

                        <div class='seccion_input input_izquierda'>
                            <label for='input_codigo'>CÓDIGO DE ESTUDIANTE</label>
                            <input class='input_codigo' id='input_codigo' placeholder='Ingrese el código de estudiante del tesista' maxlength='10'>
                        </div>

                        <div class='seccion_input'>
                            <label for='input_escuela'>ESCUELA PROFESIONAL</label>
                            <select class='input_escuela' id='input_escuela'>
                                <option disabled='disabled' selected>Seleccione la escuela profesional</option>
                                <option id=1>Ingeniería de sistemas</option>
                                <option id=2>Ingeniería ambiental</option>
                                <option id=3>Ingeniería agroindustrial</option>
                            </select>
                        </div>

                        <div class='seccion_input input_izquierda'>
                            <label for='input_correo'>CORREO</label>
                            <input class='input_correo' id='input_correo' placeholder='Ingrese el correo del tesista' maxlength='45'>
                        </div>

                        <div class='seccion_input'>
                            <label for='input_celular'>NRO. CELULAR</label>
                            <input class='input_celular' id='input_celular' placeholder='Ingrese el número de celular del tesista' maxlength='9'>
                        </div>

                        <div class='input_izquierda'>
                            <label for='input_asesor'>NOMBRE DE ASESOR</label>
                            <select class='input_asesor' id='input_asesor'>
                                <option disabled='disabled' selected>Seleccione el asesor</option>
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

        static public function rellenaAsesores($escuelaProfesional){
            $datosTesista=tesistasModelo::recuperaAsesoresEscuela($escuelaProfesional);
            
            $contenidoOpciones='';

            for($i=0; $i<mysqli_num_rows($datosTesista); $i++){
                $datos=mysqli_fetch_assoc($datosTesista);

                $contenidoOpciones= $contenidoOpciones .
                "<option value=$datos[DNI]>$datos[datos_asesor]</option>";
            }

            return $contenidoOpciones;
        }

        static public function mostrarModalDetallesTesista($DNI){
            $datosTesista=tesistasModelo::recuperaDetallesTesista($DNI);
            $datos=mysqli_fetch_assoc($datosTesista);
            
            $contenidoFormulario='';
            $contenidoFormulario= $contenidoFormulario .
                "<div class='contenedor_formulario'>
                    <div class='cabecera_formulario'>
                        <span>DETALLES DEL TESISTA</span>
                        
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
                            <label for='input_codigo'>CÓDIGO DE ESTUDIANTE</label>
                            <input class='input_codigo' id='input_codigo' value='$datos[codigo]' disabled>
                        </div>

                        <div class='seccion_input'>
                            <label for='input_escuela'>ESCUELA PROFESIONAL</label>
                            <input class='input_escuela' id='input_escuela' value='$datos[escuela]' disabled>
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
                            <label for='input_asesor'>NOMBRE DE ASESOR</label>
                            <input class='input_asesor' id='input_asesor' value='$datos[asesor]' disabled>
                        </div>
                    </form>
                </div>";
                
            return $contenidoFormulario;
        }

        static public function mostrarModalEditarInformacionTesista($DNI){
            $datosTesista=tesistasModelo::recuperaDetallesTesista($DNI);
            $datos=mysqli_fetch_assoc($datosTesista);

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
                        <span>EDITAR INFORMACIÓN DEL TESISTA</span>
                        
                        <div class='contenedor_boton'>
                            <button id='boton-cerrar' onclick=desactivaModal()>
                                <i class='fa-solid fa-xmark'></i>
                            </button>
                        </div>
                    </div>
                    
                    <form class='formulario_datos' id='formulario_datos'>
                        <div class='seccion_input' id='seccion_input'>
                            <label for='input_nombre'>NOMBRE</label>
                            <input class='input_nombre' id='input_nombre' value='$datos[nombre]' maxlength=45>
                        </div>

                        <div class='seccion_input input_izquierda' id='seccion_input'> 
                            <label for='input_apellidos'>APELLIDOS</label>
                            <input class='input_apellidos' id='input_apellidos' value='$datos[apellidos]' maxlength=50>
                        </div>

                        <div class='seccion_input' id='seccion_input'>
                            <label for='input_DNI'>DNI</label>
                            <input class='input_DNI' id='input_DNI' value='$datos[DNI]' maxlength=8>
                        </div>

                        <div class='seccion_input input_izquierda' id='seccion_input'>
                            <label for='input_codigo'>CÓDIGO DE ESTUDIANTE</label>
                            <input class='input_codigo' id='input_codigo' value='$datos[codigo]' maxlength=10>
                        </div>

                        <div class='seccion_input' id='seccion_input'>
                            <label for='input_escuela'>ESCUELA PROFESIONAL</label>
                            <select class='input_escuela' id='input_escuela'>
                                $opcionesEscuela;
                            </select>
                        </div>

                        <div class='seccion_input input_izquierda' id='seccion_input'>
                            <label for='input_correo'>CORREO</label>
                            <input class='input_correo' id='input_correo' value='$datos[correo]' maxlength=45>
                        </div>

                        <div class='seccion_input' id='seccion_input'>
                            <label for='input_celular'>NRO. CELULAR</label>
                            <input class='input_celular' id='input_celular' value='$datos[celular]' maxlength=9>
                        </div>

                        <div class='input_izquierda' id='seccion_input'>
                            <label for='input_asesor'>NOMBRE DE ASESOR</label>
                            <select class='input_asesor' id='input_asesor'>
                                <option selected='true' value=$datos[DNI_asesor]>$datos[asesor]</option>
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
            if(isset($_POST['busqueda_DNI'])){
                $DNI = $_POST['DNI'];

                print_r (json_encode(tesistasControlador::mostrarTesistasEnTabla($DNI,'Input')));
                unset($_POST['busqueda_DNI'], $_POST['DNI']);

            }else if(isset($_POST['mostrar_modal_añadir_tesista'])){
                echo (tesistasControlador::mostrarModalAñadirTesista());
                unset($_POST['mostrar_modal_añadir_tesista']);

            }else if(isset($_POST['guardar_informacion_añadida'])){
                $DNI =$_POST['DNI'];
                $contraseña=password_hash('safiunajma',PASSWORD_DEFAULT);
                $nombre =$_POST['nombre']; 
                $apellidos =$_POST['apellidos'];
                $codigo =$_POST['codigo']; 
                
                if($_POST['escuela'] == 'Ingeniería de sistemas'){
                    $escuela =1;

                }else if($_POST['escuela'] == 'Ingeniería ambiental'){
                    $escuela =2;

                }else if($_POST['escuela'] == 'Ingeniería agroindustrial'){
                    $escuela =3;
                    
                }

                $correo =$_POST['correo']; 
                $celular =$_POST['celular'];
                $asesor =$_POST['asesor'];

                echo (tesistasModelo::añadirTesista($DNI,$contraseña,$nombre,$apellidos,$codigo,$correo,$celular,$escuela,$asesor));

                unset($_POST['guardar_informacion_añadida'], $_POST['DNI'], $_POST['nombre'], $_POST['apellidos']);
                unset($_POST['codigo'], $_POST['escuela'], $_POST['correo'], $_POST['celular'], $_POST['asesor']);

            }else if(isset($_POST['rellenar_asesores'])){
                $escuela = $_POST['escuela_profesional'];

                echo (tesistasControlador::rellenaAsesores($escuela));

                unset($_POST['rellenar_asesores'], $_POST['escuela_profesional']);

            }else if(isset($_POST['mostrar_tesistas_carrera'])){
                $carrera = $_POST['carrera'];

                print_r (json_encode(tesistasControlador::mostrarTesistasEnTabla($carrera,'Botón')));
                
                unset($_POST['mostrar_tesistas_carrera']);

            }else if(isset($_POST['mostrar_todos_tesistas'])){
                print_r (json_encode(tesistasControlador::mostrarTesistasEnTabla('Todos','Botón')));
                
                unset($_POST['mostrar_todos_tesistas']);

            }else if(isset($_POST['mostrar_modal_detalles_tesista'])){
                $DNI = $_POST['DNI'];

                echo (tesistasControlador::mostrarModalDetallesTesista($DNI));
                
                unset($_POST['mostrar_modal_detalles_tesista'], $_POST['DNI']);

            }else if(isset($_POST['modal_editar_informacion_tesista'])){
                $DNI = $_POST['DNI'];

                echo (tesistasControlador::mostrarModalEditarInformacionTesista($DNI));
                
                unset($_POST['modal_editar_informacion_tesista'], $_POST['DNI']);

            }else if(isset($_POST['guardar_informacion_editada'])){
                $nombre =$_POST['nombre']; 
                $apellidos =$_POST['apellidos'];
                $DNIviejo =$_POST['DNIviejo']; 
                $DNInuevo =$_POST['DNInuevo'];
                $codigo =$_POST['codigo']; 
                $correo =$_POST['correo']; 
                $celular =$_POST['celular'];
                $asesor =$_POST['asesor'];

                if($_POST['escuela'] == 'Ingeniería de sistemas'){
                    $escuela =1;

                }else if($_POST['escuela'] == 'Ingeniería ambiental'){
                    $escuela =2;

                }else if($_POST['escuela'] == 'Ingeniería agroindustrial'){
                    $escuela =3;
                    
                }

                tesistasModelo::actualizaInformacionTesista($nombre,$apellidos,$DNIviejo,$DNInuevo,$codigo,$escuela,$correo,$celular,$asesor);
                
                unset($_POST['guardar_informacion_editada'], $_POST['nombre'], $_POST['apellidos'], $_POST['DNI'], $_POST['codigo']);
                unset($_POST['escuela'], $_POST['correo'], $_POST['celular'], $_POST['asesor']);

            }else if(isset($_POST['verificar_datos_repetidos'])){
                $DNI_viejo = $_POST['DNI_viejo'];
                $DNI_nuevo = $_POST['DNI_nuevo'];
                $codigo = $_POST['codigo'];
                $correo = $_POST['correo'];
                $celular = $_POST['celular'];

                if($_POST['accion'] == 'Añadir'){
                    echo tesistasModelo::verificaDatosRepetidos($DNI_viejo,$DNI_nuevo, $codigo, $correo, $celular , "Añadir");

                }elseif($_POST['accion']){
                    echo tesistasModelo::verificaDatosRepetidos($DNI_viejo,$DNI_nuevo, $codigo, $correo, $celular , "Editar");

                }
                
                unset($_POST['verificar_datos_repetidos'], $_POST['DNI_viejo'], $_POST['DNI_nuevo'], $_POST['codigo']);    
                unset($_POST['correo'], $_POST['celular']);
            }
        }
    }

    tesistasControlador::verificaPost();
?>