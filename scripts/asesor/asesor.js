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


const botonMostrarTodos=document.querySelector("#mostrar_todos_a");


const contenidoTabla=document.querySelector("#contenido_tabla");

const botonMostrarMas=document.querySelector(".boton_mostrar");







/*FUNCIONES*/

//Función que carga la tabla de tesistas completos
let totalTesistas=0;

function cargaDatosIniciales(datos) {   
    const ajax = new XMLHttpRequest();

    ajax.open('POST', '../controladores/asesor/asesoradosC.php', true);
    ajax.setRequestHeader("content-type","application/x-www-form-urlencoded");
    ajax.send(datos);

    ajax.onreadystatechange = function (){
        if(this.readyState == 4 && this.status == 200){
            respuestaRecuperada=JSON.parse(this.responseText);
            
            if(datos=='mostrar_todos_tesistas=true'){
                totalTesistas=respuestaRecuperada[1];
            };

            
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




//Función que muestra los detalles de un tesista
function detallesTesista(DNI_tesista){
    const ajax = new XMLHttpRequest();

    ajax.open('POST', '../controladores/asesor/asesoradosC.php', true);
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