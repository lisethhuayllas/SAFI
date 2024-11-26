window.onload= ()=>{
    cargaDatosIniciales('mostrar_todos_tesistas=true');
}

//ELEMENTOS A USAR
const html=document.querySelector(".pagina_html");
const alertas= Swal.mixin({
    toast: true,
    position: 'bottom-end',
    showConfirmButton: false,
    timer: 3000
});

const contenedorGeneral= document.querySelector(".contenedor-general");
const spanCoincidencias=document.querySelector("#coincidencias");
const spanTotal=document.querySelector("#total");
const inputBusqueda=document.querySelector(".input_busqueda");

const botonMostrarTodos=document.querySelector("#mostrar_todos_a");
const botonMostrarSistemas=document.querySelector("#mostrar_sistemas_a");
const botonMostrarAmbiental=document.querySelector("#mostrar_ambiental_a");
const botonMostrarAgroindustrial=document.querySelector("#mostrar_agroindustrial_a");
const botonAñadir=document.querySelector("#boton_añadir");

const contenidoTabla=document.querySelector("#contenido_tabla");

const botonMostrarMas=document.querySelector(".boton_mostrar");
const botonEditar=document.querySelector(".boton_editar");
const botonEliminar=document.querySelector(".boton_eliminar");

let arrayBotones=[botonMostrarTodos,botonMostrarSistemas,botonMostrarAmbiental,botonMostrarAgroindustrial];

//BUSQUEDA DE TESISTAS
inputBusqueda.addEventListener("keyup",()=>{
    botonMostrarTodos.focus();
    inputBusqueda.focus();

    const DNI=inputBusqueda.value;
    const ajax = new XMLHttpRequest();

    ajax.open('POST', '../controladores/administrador/tesistas_controlador.php', true);
    ajax.setRequestHeader("content-type","application/x-www-form-urlencoded");
    ajax.send('busqueda_DNI=true&DNI='+DNI);

    ajax.onreadystatechange = function (){
        if(this.readyState == 4 && this.status == 200){
            respuestaRecuperada=JSON.parse(this.responseText);

            contenidoTabla.innerHTML=respuestaRecuperada[0];
            spanCoincidencias.innerHTML=respuestaRecuperada[1];
        }
    }

});

botonMostrarTodos.style.setProperty("font-weight","bold");
botonMostrarTodos.style.setProperty("border-bottom","3px solid #009685");

//COLORES EN EL ENFOQUE DE BOTONES
arrayBotones.forEach(boton => {
    boton.addEventListener("focus",()=>{
        arrayBotones.forEach(seccion => {
            if(seccion == boton){
                seccion.style.setProperty("font-weight","bold");
                seccion.style.setProperty("border-bottom","3px solid #009685");
            }else{
                seccion.style.removeProperty("font-weight");
                seccion.style.removeProperty("border-bottom");
            }
        })
    });
});

//FUNCIONALIDAD DE LOS BOTONES DE VISUALIZACIÓN
arrayBotones.forEach(boton => {
    boton.addEventListener("click",()=>{
        inputBusqueda.value='';
        let datos='';
        
        if(boton==botonMostrarTodos){
            datos='mostrar_tesistas_carrera=true&carrera=Todos';

        }else if(boton==botonMostrarSistemas){
            datos='mostrar_tesistas_carrera=true&carrera=Ingeniería de sistemas';

        }else if(boton==botonMostrarAmbiental){
            datos='mostrar_tesistas_carrera=true&carrera=Ingeniería ambiental';

        }else if(boton==botonMostrarAgroindustrial){
            datos='mostrar_tesistas_carrera=true&carrera=Ingeniería agroindustrial';
        }

        cargaDatosIniciales(datos);
    });
});

//AGREGAR MAS TESISTAS
botonAñadir.addEventListener("click",()=>{
    añadirTesista();
});

/*FUNCIONES*/

//Función que carga la tabla de tesistas completos
let totalTesistas=0;

function cargaDatosIniciales(datos) {   
    const ajax = new XMLHttpRequest();

    ajax.open('POST', '../controladores/administrador/tesistas_controlador.php', true);
    ajax.setRequestHeader("content-type","application/x-www-form-urlencoded");
    ajax.send(datos);

    ajax.onreadystatechange = function (){
        if(this.readyState == 4 && this.status == 200){
            respuestaRecuperada=JSON.parse(this.responseText);
            
            if(datos=='mostrar_todos_tesistas=true'){
                totalTesistas=respuestaRecuperada[1];
            };

            spanCoincidencias.innerHTML=respuestaRecuperada[1];
            spanTotal.innerHTML=totalTesistas;
            contenidoTabla.innerHTML=respuestaRecuperada[0];
        }
    }
}

//Función que crea un elemento DIV para el modal
function creaDiv(clase){
    const div=document.createElement("div");
    div.className=clase;
    div.id=clase;

    return div;
}

//Función para el botón añadir
function añadirTesista(){
    const ajax = new XMLHttpRequest();

    ajax.open('POST', '../controladores/administrador/tesistas_controlador.php', true);
    ajax.setRequestHeader("content-type","application/x-www-form-urlencoded");
    ajax.send('mostrar_modal_añadir_tesista=true');

    ajax.onreadystatechange = function (){
        if(this.readyState == 4 && this.status == 200){
            html.style.setProperty('overflow-y','hidden');

            contenedorGeneral.appendChild(creaDiv("seccion-modal"));
            const ventanaModal=contenedorGeneral.children.namedItem('seccion-modal');

            ventanaModal.innerHTML=this.responseText;

            const formulario=ventanaModal.children.namedItem('contenedor_formulario').children.namedItem('formulario_datos');
            const selectEscuelaProfesional=formulario[4];
            const selectAsesor=formulario[7];
            const botonGuardar=formulario.children.namedItem('seccion_guardar').children.namedItem('boton_guardar');

            selectEscuelaProfesional.addEventListener("change",(e)=>{
                const escuelaProfesional=e.target.value;
                
                rellenarSelectAsesores(escuelaProfesional,selectAsesor);
            });

            botonGuardar.addEventListener('click',(e)=>{
                e.preventDefault();

                verificarDatosRepetidos(elementosModal().DNI, "Añadir")
                    .then(errores=>{
                        if(validarCamposDeModal() && errores.length == 0){
                            añadirTesistaII();
                        }
                    });
            });

        }
    }  
}

function añadirTesistaII(){
    const ajax = new XMLHttpRequest();
    let datos='guardar_informacion_añadida=true&nombre=' + elementosModal().nombre + '&apellidos=' + elementosModal().apellidos + "&DNI="+ elementosModal().DNI;
    datos+= "&codigo=" + elementosModal().codigo + "&escuela="+ elementosModal().escuela + "&correo=" + elementosModal().correo + "&celular=";
    datos+= elementosModal().celular + "&asesor=" + elementosModal().asesor;

    ajax.open('POST', '../controladores/administrador/tesistas_controlador.php', true);
    ajax.setRequestHeader("content-type","application/x-www-form-urlencoded");
    ajax.send(datos);

    ajax.onreadystatechange = function (){
        if(this.readyState == 4 && this.status == 200){
            alertas.fire({
                icon: 'success',
                title: 'Tesista registrado correctamente'
            });

            desactivaModal();
            cargaDatosIniciales('mostrar_tesistas_carrera=true&carrera=Todos');

            totalTesistas+=1;
        }
    }
}

//Función para rellenar la etiqueta select con los asesores de una carrera profesional
function rellenarSelectAsesores(escuelaProfesional,etiquetaSelect){
    const ajax = new XMLHttpRequest();

    ajax.open('POST', '../controladores/administrador/tesistas_controlador.php', true);
    ajax.setRequestHeader("content-type","application/x-www-form-urlencoded");
    ajax.send('rellenar_asesores=true&escuela_profesional=' + escuelaProfesional);

    ajax.onreadystatechange = function (){
        if(this.readyState == 4 && this.status == 200){
            etiquetaSelect.innerHTML='<option selected disabled>Seleccione el asesor</option>' + this.responseText;
        }
    }
}

//Función que valida los campos de texto del modal
function validarCamposDeModal(){
    const REGEXpalabras= /^[ÑÁÉÍÓÚA-Z][a-zñáéíóú]+(\s+[ÑÁÉÍÓÚA-Z]?[a-zñáéíóú]+)*$/;
    const REGEXnumeros = /^[0-9]+$/;
    const REGEX_correo= /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;

    let errores='';

    if(!REGEXpalabras.test(elementosModal().nombre)){
        errores+='Nombre no válido';

    }else if(!REGEXpalabras.test(elementosModal().apellidos)){
        errores+='Apellidos no válidos';

    }else if(!REGEXnumeros.test(elementosModal().DNI)){
        errores+='DNI no válido';

    }else if(elementosModal().DNI.length!=8){
        errores+='El DNI debe tener 8 caracteres';

    }else if(!REGEXnumeros.test(elementosModal().codigo)){
        errores+='Código de estudiante no válido';

    }else if(elementosModal().codigo.length!=10){
        errores+='El código de estudiante debe tener 10 caracteres';

    }else if(elementosModal().escuela != 'Ingeniería de sistemas' && elementosModal().escuela != 'Ingeniería ambiental' && elementosModal().escuela != 'Ingeniería agroindustrial'){
        errores+='Seleccione una escuela profesional';

    }else if(!REGEX_correo.test(elementosModal().correo)){
        errores+='Correo no válido';

    }else if(!REGEXnumeros.test(elementosModal().celular)){
        errores+='Número de celular no válido';

    }else if(elementosModal().celular.length!=9){
        errores+='El numero de celular debe tener 9 caracteres';

    }else if(elementosModal().asesor == 'Seleccione el asesor'){       
        errores+='Seleccione el asesor';
    }

    if(errores.length!=0){
        alertas.fire({
            icon: 'error',
            title: errores
        });
    }

    return errores.length==0 ? true : false;
}

//Función que verifica que los datos importantes aún no estén registrados en la BD
const verificarDatosRepetidos = (DNI_viejo, accion) => new Promise((resolve) =>{
    const ajax = new XMLHttpRequest();
    let mensaje= 'verificar_datos_repetidos=true&DNI_viejo=' + DNI_viejo + "&DNI_nuevo=" + elementosModal().DNI + "&codigo=" + elementosModal().codigo;
    mensaje+= "&correo=" + elementosModal().correo + "&celular=" + elementosModal().celular + "&accion=" + accion;

    ajax.open('POST', '../controladores/administrador/tesistas_controlador.php', true);
    ajax.setRequestHeader("content-type","application/x-www-form-urlencoded");
    ajax.send(mensaje);

    ajax.onreadystatechange = function (){
        if(this.readyState == 4 && this.status == 200){
            let textoError='';

            if(this.responseText == 'DNI existe'){
                textoError+='El número de DNI ya se encuentra registrado';
            
            }else if(this.responseText == 'Código existe'){
                textoError+='El código de estudiante ya se encuentra registrado';
            
            }else if(this.responseText == 'Correo existe'){
                textoError+='El correo ya se encuentra registrado';
            
            }else if(this.responseText == 'Celular existe'){
                textoError+='El número de celular ya se encuentra registrado';

            }

            if(textoError.length!=0){
                alertas.fire({
                    icon: 'error',
                    title: textoError
                });
            }

            resolve(textoError);
        }
    }
});

//Función que muestra los detalles de un tesista
function detallesTesista(DNI_tesista){
    const ajax = new XMLHttpRequest();

    ajax.open('POST', '../controladores/administrador/tesistas_controlador.php', true);
    ajax.setRequestHeader("content-type","application/x-www-form-urlencoded");
    ajax.send('mostrar_modal_detalles_tesista=true&DNI=' + DNI_tesista);

    ajax.onreadystatechange = function (){
        if(this.readyState == 4 && this.status == 200){
            html.style.setProperty('overflow-y','hidden');

            contenedorGeneral.appendChild(creaDiv("seccion-modal"));
            const ventanaModal=contenedorGeneral.children.namedItem('seccion-modal');

            ventanaModal.innerHTML=this.responseText;
        }
    }
}

//Función para editar la información de un tesista
function editarInformacionTesista(DNI_tesista){
    const ajax = new XMLHttpRequest();

    ajax.open('POST', '../controladores/administrador/tesistas_controlador.php', true);
    ajax.setRequestHeader("content-type","application/x-www-form-urlencoded");
    ajax.send('modal_editar_informacion_tesista=true&DNI=' + DNI_tesista);

    ajax.onreadystatechange = function (){
        if(this.readyState == 4 && this.status == 200){
            html.style.setProperty('overflow-y','hidden');

            contenedorGeneral.appendChild(creaDiv("seccion-modal"));
            const ventanaModal=contenedorGeneral.children.namedItem('seccion-modal');
    
            ventanaModal.innerHTML=this.responseText;

            const formulario=ventanaModal.children.namedItem('contenedor_formulario').children.namedItem('formulario_datos');
            const botonGuardar=formulario.children.namedItem('seccion_guardar').children.namedItem('boton_guardar');
            const selectEscuelaProfesional=formulario[4];
            const selectAsesor=formulario[7];

            selectEscuelaProfesional.addEventListener("change",(e)=>{
                const escuelaProfesional=e.target.value;
                
                rellenarSelectAsesores(escuelaProfesional,selectAsesor);
            });
            
            botonGuardar.addEventListener('click',(e)=>{
                e.preventDefault();
                
                verificarDatosRepetidos(DNI_tesista, "Editar")
                    .then(errores=>{
                        if(validarCamposDeModal() && errores.length == 0){
                            editarInformacionTesistaII(DNI_tesista);
                        }
                    });
            });
        }
    }
}

function editarInformacionTesistaII(DNI_tesista){
    Swal.fire({
        title: '¿ESTÁS SEGURO?',
        icon: 'warning',
        text: 'No podrás recuperar la información cambiada',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, guardar',
        cancelButtonText: 'Cancelar'

    }).then((result) => {
        if (result.isConfirmed) {
            let datos='guardar_informacion_editada=true&nombre=' + elementosModal().nombre + '&apellidos=' + elementosModal().apellidos + "&DNInuevo=" + elementosModal().DNI;
            datos+="&DNIviejo=" + DNI_tesista + "&codigo=" + elementosModal().codigo + "&escuela=" + elementosModal().escuela + "&correo=";
            datos+=elementosModal().correo + "&celular=" + elementosModal().celular + "&asesor=" + elementosModal().asesor;

            const ajax = new XMLHttpRequest;
            ajax.open('POST','../controladores/administrador/tesistas_controlador.php',true);
            ajax.setRequestHeader("content-type", "application/x-www-form-urlencoded");
            ajax.send(datos);

            ajax.onreadystatechange = function(){
                if(this.readyState ==4 && this.status==200){
                    desactivaModal();

                    alertas.fire({
                        icon: 'success',
                        title: 'Guardado correctamente'
                    });
                
                    if(getComputedStyle(botonMostrarTodos).borderBottomColor == 'rgb(32, 201, 151)'){
                        cargaDatosIniciales('mostrar_todos_tesistas=true');
    
                    }else if(getComputedStyle(botonMostrarSistemas).borderBottomColor == 'rgb(32, 201, 151)'){
                        cargaDatosIniciales('mostrar_tesistas_carrera=true&carrera=Ingeniería de sistemas');
    
                    }else if(getComputedStyle(botonMostrarAmbiental).borderBottomColor == 'rgb(32, 201, 151)'){
                        cargaDatosIniciales('mostrar_tesistas_carrera=true&carrera=Ingeniería ambiental');

                    }else if(getComputedStyle(botonMostrarAgroindustrial).borderBottomColor == 'rgb(32, 201, 151)'){
                        cargaDatosIniciales('mostrar_tesistas_carrera=true&carrera=Ingeniería agroindustrial');
                        
                    }
                }
            }
        }
    })
}

//Función para eliminar a un tesista
function eliminarTesista(DNI){
    Swal.fire({
        title: '¿DESEA ELIMINAR AL TESISTA?',
        text: "No podrás recuperar su información después",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    });
}

//Función para desactivar el modal
function desactivaModal(){
    const ventanaModal=contenedorGeneral.children.namedItem('seccion-modal');
    contenedorGeneral.removeChild(ventanaModal);

    html.style.setProperty('overflow-y','scroll');
}

//Función que devuelve los valores de los inputs del modal
function elementosModal(){
    let ventanaModal=contenedorGeneral.children.namedItem('seccion-modal');
    let formulario=ventanaModal.children.namedItem('contenedor_formulario').children.namedItem('formulario_datos');

    let nombre =formulario[0].value;
    let apellidos =formulario[1].value;
    let DNI =formulario[2].value;
    let codigo =formulario[3].value;
    let escuela =formulario[4].value;
    let correo =formulario[5].value;
    let celular =formulario[6].value;
    let asesor =formulario[7].value;

    return {ventanaModal: ventanaModal, formulario: formulario, nombre: nombre, apellidos: apellidos, DNI: DNI, codigo: codigo, escuela: escuela, correo: correo, celular: celular, asesor: asesor};
}