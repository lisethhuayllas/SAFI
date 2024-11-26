window.onload = () =>{
    llenadoDatosInicial();
}

const html=document.querySelector(".pagina_html");
const contenedorGeneral= document.querySelector(".contenedor-general");
let ventanaModal;
const inputBusqueda=document.querySelector(".input-busqueda");
const botonCargar = document.querySelector("#botonCargar");
const contenidoTabla=document.querySelector("#contenido_tabla");

//CAPTURA DE EVENTOS
inputBusqueda.addEventListener("keyup",()=>{
    buscarNumeroResolucion();
});

botonCargar.addEventListener("click", ()=>{
    html.style.setProperty('overflow-y','hidden');
    mostrarModalCarga();
})

//FUNCIONES
function llenadoDatosInicial(){
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

function buscarNumeroResolucion(){
    const numeroResolucion=inputBusqueda.value;
    const ajax = new XMLHttpRequest();

    ajax.open('POST', '../controladores/administrador/resoluciones_controlador.php', true);
    ajax.setRequestHeader("content-type","application/x-www-form-urlencoded");
    ajax.send('busqueda_numero_resolucion=true&numero_resolucion='+numeroResolucion);

    ajax.onreadystatechange = function (){
        if(this.readyState == 4 && this.status == 200){
            contenidoTabla.innerHTML = this.responseText;
        }
    }
}

function mostrarModalCarga(){
    const ajax = new XMLHttpRequest();
    ajax.open('POST', '../vistas/administrador/modal_cargar_resoluciones.php', true);
    ajax.setRequestHeader("content-type","application/x-www-form-urlencoded");
    ajax.send();

    ajax.onreadystatechange = function (){
        if(this.readyState == 4 && this.status == 200){
            contenedorGeneral.appendChild(creaDiv("seccion-modal"));
            ventanaModal=contenedorGeneral.children.namedItem('seccion-modal');
            ventanaModal.innerHTML= this.responseText;

            let script = ventanaModal.getElementsByTagName('script');
            for (let n = 0; n < script.length; n++){
                eval(script[n].innerHTML);
            }
        }
    }
}

function mostrarModalEditar(numeroResolucion, tipoResolucion){
    const ajax = new XMLHttpRequest();
    ajax.open('POST', '../vistas/administrador/modal_editar_resoluciones.php', true);
    ajax.setRequestHeader("content-type","application/x-www-form-urlencoded");
    ajax.send('numero=' + numeroResolucion + '&tipo=' + tipoResolucion);

    ajax.onreadystatechange = function (){
        if(this.readyState == 4 && this.status == 200){
            contenedorGeneral.appendChild(creaDiv("seccion-modal"));
            ventanaModal=contenedorGeneral.children.namedItem('seccion-modal');
            ventanaModal.innerHTML= this.responseText;

            let script = ventanaModal.getElementsByTagName('script');
            for (let n = 0; n < script.length; n++){
                eval(script[n].innerHTML);
            }
        }
    }
}

function mostrarPDF(numeroResolucion){
    const ajax = new XMLHttpRequest();
    ajax.open('POST', '../controladores/administrador/resoluciones_controlador.php', true);
    ajax.setRequestHeader("content-type","application/x-www-form-urlencoded");
    ajax.responseType = 'arraybuffer';
    ajax.send('mostrar_archivo_PDF=true&numero=' + numeroResolucion);

    ajax.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const datosBinarios = new Uint8Array(this.response);
            const formatoPDF = base64js.fromByteArray(datosBinarios);
            const pdfWindow = window.open();
            pdfWindow.document.write('<iframe src="data:application/pdf;base64,' + formatoPDF + '" frameborder="0" style="border:0; top:0px; left:0px; bottom:0px; right:0px; width:100%; height:100%; position: absolute;" allowfullscreen></iframe>');
            pdfWindow.document.title = `Resolución Nº ${numeroResolucion}-CFI-UNAJMA`;
        }
    };
}

function creaDiv(clase){
    const div=document.createElement("div");
    div.className=clase;
    div.id=clase;

    return div;
}