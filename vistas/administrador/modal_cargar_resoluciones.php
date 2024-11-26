<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../vistas/estilos/administrador/modal_cargar_resoluciones.css">
</head>
<body>
    <div class='contenedor_formulario' id='contenedor-formulario'>
        <div class='cabecera_formulario'>
            <span>CARGAR NUEVA RESOLUCIÓN</span>
            
            <div class='contenedor_boton'>
                <button id='boton-cerrar'>
                    <i class='fa-solid fa-xmark'></i>
                </button>
            </div>
        </div>
        
        <form class='formulario_datos' id='formulario-datos'>
            <div class='seccion_input'>
                <label for='input_numero'>NÚMERO</label>
                <input class='input_numero' id='input-numero' placeholder='Ej. 084-2022' maxlength='8'>
            </div>

            <div class='input_izquierda'>
                <label for='input_tipo'>TIPO</label>
                <select id='select-tipo'>
                    <option disabled selected>Seleccione el tipo de resolución</option>
                    <option>Designación de asesor</option>
                    <option>Designación de jurado</option>
                    <option>Aprobación de proyecto</option>
                    <option>Aprobación de acta de sustentación</option>
                </select>
            </div>

            <div class='seccion-formulario-archivo'>
                <label>ARCHIVO</label>
                <div class="formulario-archivo" id="formulario-archivo">
                    <input id="input-archivo" type="file" multiple hidden></input>
                    <i class="fa-solid fa-file-arrow-up"></i>
                    <span>Seleccionar archivo a cargar</span>
                </div>

                <div class="contenedor-carga"></div>
            </div>
            
            <div class='seccion_guardar' id='seccion_guardar'>
                <button id='boton-guardar' type='submit'>
                    GUARDAR<i class='fa-solid fa-floppy-disk'></i>
                </button>
            </div>
        </form>
    </div>

    <!-- SCRIPT -->
    <script>
        const html=document.querySelector(".pagina_html");
        const contenidoTabla=document.querySelector("#contenido_tabla");
        const contenedorFormulario= document.querySelector("#contenedor-formulario");
        const botonCerrar= document.querySelector("#boton-cerrar");
        const formulario= document.querySelector("#formulario-datos");
        const seccionFormularioArchivo= document.querySelector(".seccion-formulario-archivo");
        const formularioArchivo= document.querySelector("#formulario-archivo");

        const numeroResolucion = document.querySelector('#input-numero');
        const tipoResolucion = document.querySelector('#select-tipo');
        const inputArchivo= document.querySelector("#input-archivo");
        
        const contenedorCarga= document.querySelector(".contenedor-carga");
        const botonGuardar= document.querySelector("#boton-guardar");

        const alertas= Swal.mixin({
            toast: true,
            position: 'bottom-end',
            showConfirmButton: false,
            timer: 3000
        });

        botonCerrar.addEventListener("click", ()=>{
            desactivaModal();
        })

        formularioArchivo.addEventListener("click", ()=>{
            inputArchivo.click();
        })

        inputArchivo.addEventListener("change", ({target})=>{
            validacionesArchivo(target);
        })

        botonGuardar.addEventListener("click", (e)=>{
            e.preventDefault();

            if(validarCamposFormulario()){
                validarExistenciaResolucion(numeroResolucion.value);
            }
        })

        function validarCamposFormulario(){
            const REGEXnumeroResolucion = /^\d{3}-\d{4}$/;
            const opcionesSelect = ['Designación de asesor', 'Designación de jurado', 'Aprobación de proyecto', 'Aprobación de acta de sustentación'];
            let errores = '';

            if(!REGEXnumeroResolucion.test(numeroResolucion.value)){
                errores+= 'Número de resolución no válido';

            }else if(!opcionesSelect.includes(tipoResolucion.value)){
                errores+= 'Selecciona el tipo de resolución';

            }else if(inputArchivo.files.length<1){
                errores+= 'Selecciona un archivo';
            }

            if(errores.length>0){
                alertas.fire({
                    icon: 'error',
                    title: errores
                });

                return false;
            }

            return true;
        }

        function validacionesArchivo(target){
            let errores = '';
            let archivo = target.files[0];

            if(target.files.length>1){
                errores += 'Solo puedes subir un archivo';
                inputArchivo.value = '';

            }else if(archivo && archivo.type == "application/pdf"){
                let nombreArchivo = archivo.name;
                let tamañoArchivo = archivo.size;

                if(tamañoArchivo > 5 * Math.pow(1024,2)){
                    errores += 'El archivo debe pesar a lo más 5MB';
                    seccionCargaEstiloOriginal();
                    
                }else{
                    contenedorFormulario.style.height = '600px';
                    formulario.style.gridTemplateRows= "100px 300px auto";
                    botonGuardar.style.marginTop = "20px";

                    if(nombreArchivo.length>80){
                        let nombreAcortado=nombreArchivo.split(".");
                        nombreArchivo = nombreAcortado[0].substr(0,80) + "... ." + nombreAcortado[1];
                    }

                    if(tamañoArchivo<Math.pow(1024,2)){
                        tamañoArchivo = (tamañoArchivo/1024).toFixed(0) + "KB";
                    }else{
                        tamañoArchivo = (tamañoArchivo/Math.pow(1024,2)).toFixed(2) + "MB";
                    }

                    let contenidoArchivoCargado = 
                    `<div class="seccion-cargado">
                        <i class="fa-solid fa-file-pdf"></i>
                        <div class="detalles-archivo-cargado">
                            <div class="datos-archivo-cargado">
                                <span class="nombre-archivo">${nombreArchivo}</span>
                                <span class="peso-archivo">${tamañoArchivo}</span>
                            </div>
                        </div>
                    </div>`;

                    contenedorCarga.innerHTML = contenidoArchivoCargado;
                }

            }else{
                errores += 'El archivo seleccionado no es un PDF';
                seccionCargaEstiloOriginal();
            }

            if(errores.length>0){
                alertas.fire({
                    icon: 'error',
                    title: errores
                });
            }
        }

        function seccionCargaEstiloOriginal(){
            contenedorFormulario.style.height = '540px';
            formulario.style.gridTemplateRows= "100px 200px auto";
            botonGuardar.style.marginTop = "40px";

            if(inputArchivo.children.length > 1){
                seccionFormularioArchivo.removeChild(seccionFormularioArchivo.lastChild);
            }

            contenedorCarga.innerHTML = '';
            inputArchivo.value = '';
        }

        function validarExistenciaResolucion(numeroResolucion){
            const ajax = new XMLHttpRequest();

            ajax.open('POST', '../controladores/administrador/resoluciones_controlador.php', true);
            ajax.setRequestHeader("content-type","application/x-www-form-urlencoded");
            ajax.send("validar_existencia_resolucion=true&numero=" + numeroResolucion);
            
            ajax.onreadystatechange = function (){
                if(this.readyState == 4 && this.status == 200){
                    if(this.responseText){
                        alertas.fire({
                            icon: 'error',
                            title: 'Ya existe una resolución con el mismo número'
                        });

                    }else{
                        let nombreArchivo = inputArchivo.files[0].name;
                        subirArchivo(nombreArchivo);
                    }
                }
            }
        }

        function subirArchivo(nombreArchivo){
            if(nombreArchivo.length>80){
                let nombreAcortado=nombreArchivo.split(".");
                nombreArchivo = nombreAcortado[0].substr(0,80) + "... ." + nombreAcortado[1];
            }
            
            const ajax = new XMLHttpRequest();

            ajax.open('POST', '../controladores/administrador/resoluciones_controlador.php', true);
            ajax.upload.addEventListener("progress", ({loaded,total})=>{
                let cantidadCargada = Math.floor((loaded/total) * 100);
                let cantidadTotal = Math.floor(total/1000);
                
                let contenidoCargaArchivo = 
                `<div class="seccion-carga">
                    <i class="fa-solid fa-file-pdf"></i>
                    <div class="detalles-carga">
                        <div class="datos-archivo">
                            <span class="nombre-archivo">${nombreArchivo}</span>
                            <span class="porcentaje-carga">${cantidadCargada}%</span>
                        </div>

                        <div class="barra-progreso">
                            <div class="progreso" style="width:${cantidadCargada}%"></div>
                        </div>
                    </div>
                </div>`;   
                
                contenedorCarga.innerHTML = contenidoCargaArchivo;
            })

            let datos = new FormData();
            
            datos.append('cargar_resolucion', 'true');
            datos.append('numero', numeroResolucion.value);
            datos.append('tipo', tipoResolucion.value);
            datos.append('archivo', inputArchivo.files[0]);

            ajax.send(datos);
            
            ajax.onreadystatechange = function (){
                if(this.readyState == 4 && this.status == 200){
                    alertas.fire({
                        icon: 'success',
                        title: 'Resolución cargada correctamente'
                    });

                    desactivaModal();
                    recargaTablaResoluciones();
                }
            }
        }

        function desactivaModal(){
            const ventanaModal=contenedorGeneral.children.namedItem('seccion-modal');
            contenedorGeneral.removeChild(ventanaModal);

            html.style.setProperty('overflow-y','scroll');
        }

        function recargaTablaResoluciones(){
            const ajax = new XMLHttpRequest();

            ajax.open('POST', '../controladores/administrador/resoluciones_controlador.php', true);
            ajax.setRequestHeader("content-type","application/x-www-form-urlencoded");
            ajax.send('mostrar_resoluciones=true');

            ajax.onreadystatechange = function (){
                if(this.readyState == 4 && this.status == 200){
                    contenidoTabla.innerHTML=this.responseText;
                }
            }
        }

    </script>
</body>
</html>