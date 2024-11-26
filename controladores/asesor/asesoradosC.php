<?php
require_once('../../modelos/asesor/asesoradosM.php');

class asesoradosControlador
{
    static private function mostrarAsesoradosC()
    {
        $datos = asesoradosModelo::mostrarAsesoradosM();
        $arrayDatos = [];

        $columnasTabla = '';

        for ($i = 0; $i < mysqli_num_rows($datos); $i++) {
            $datosPersonales = mysqli_fetch_array($datos);

            $DNI = $datosPersonales['DNI'];
            $nombreCompleto = $datosPersonales['asesorado'];
            $escuela = $datosPersonales['escuela'];


            $columnasTabla = $columnasTabla .
                "<tr>
                        <td>$nombreCompleto</td>
                        <td>$escuela</td>
                        
                        <td>
                            <button class='boton_mostrar' id='mostrar_detalles_$DNI' onclick=detallesTesista('$DNI')>
                                <i class='fa-solid fa-eye'></i>
                            </button>
                        </td>
                    </tr>";
        }

        $arrayDatos = [$columnasTabla, mysqli_num_rows($datos)];
        return $arrayDatos;
    }


    static public function mostrar_detalles_asesoradoC($DNI)
    {
        $datosTesista =  asesoradosModelo::mostrar_detalles_asesoradoM($DNI);
        $datos = mysqli_fetch_assoc($datosTesista);

        $contenidoFormulario = '';
        $contenidoFormulario = $contenidoFormulario .
            "<div class='contenedor_formulario'>
                    <div class='cabecera_formulario'>
                        <span>DETALLES DEL ASESORADO:  $datos[nombre] </span>
                        
                        <div class='contenedor_boton'>
                            <button id='boton-cerrar' onclick=desactivaModal()>
                                <i class='fa-solid fa-xmark'></i>
                            </button>
                        </div>
                    </div>
                    
                    <form class='formulario_datos'>
                   
                        <div class='seccion_input'>
                            <label for='input_DNI'>DNI</label>
                            <input class='input_DNI' id='input_DNI' value='$datos[DNI]' disabled>
                        </div>

                        <div class='seccion_input'>
                            <label for='input_codigo'>CÓDIGO DE ESTUDIANTE</label>
                            <input class='input_codigo' id='input_codigo' value='$datos[codigo]' disabled>
                        </div>

                        <div class='seccion_input'>
                        <label for='input_celular'>NRO. CELULAR</label>
                        <input class='input_celular' id='input_celular' value='$datos[celular]' disabled>
                    </div>

                    <div class='seccion_input'>
                            <label for='input_correo'>CORREO</label>
                            <input class='input_correo' id='input_correo' value='$datos[correo]' disabled>
                        </div>
                    </form>
                </div>";

        return $contenidoFormulario;
    }


    static public function verificaPost()
    {
        if (isset($_POST['mostrar_todos_tesistas'])) {
            print_r(json_encode(asesoradosControlador::mostrarAsesoradosC('Todos', 'Botón')));

            unset($_POST['mostrar_todos_tesistas']);
        } else if (isset($_POST['mostrar_modal_detalles_tesista'])) {
            $DNI = $_POST['DNI'];

            echo (asesoradosControlador::mostrar_detalles_asesoradoC($DNI));

            unset($_POST['mostrar_modal_detalles_tesista'], $_POST['DNI']);
        }
    }
}

asesoradosControlador::verificaPost();
