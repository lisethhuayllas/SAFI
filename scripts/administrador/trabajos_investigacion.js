window.onload = () =>{
    mostrarDatosTabla();
}

const inputBusqueda=document.querySelector(".input-busqueda");
const contenidoTabla=document.querySelector("#contenido_tabla");

inputBusqueda.addEventListener("keyup",()=>{
    buscarTrabajoInvestigacion();
});

function mostrarDatosTabla(){
    const ajax = new XMLHttpRequest();

    ajax.open('POST', '../controladores/administrador/trabajos_investigacion_controlador.php', true);
    ajax.setRequestHeader("content-type","application/x-www-form-urlencoded");
    ajax.send('mostrar_trabajos_investigacion=true');

    ajax.onreadystatechange = function (){
        if(this.readyState == 4 && this.status == 200){
            contenidoTabla.innerHTML=this.responseText;
        }
    }
}

function buscarTrabajoInvestigacion(){
    const texto=inputBusqueda.value;
    const ajax = new XMLHttpRequest();

    ajax.open('POST', '../controladores/administrador/trabajos_investigacion_controlador.php', true);
    ajax.setRequestHeader("content-type","application/x-www-form-urlencoded");
    ajax.send('buscar_trabajos_investigacion=true&texto='+texto);

    ajax.onreadystatechange = function (){
        if(this.readyState == 4 && this.status == 200){
            contenidoTabla.innerHTML = this.responseText;
        }
    }
}

function abrirPDF(idTrabajo, titulo){
    const ajax = new XMLHttpRequest();
    ajax.open('POST', '../controladores/administrador/trabajos_investigacion_controlador.php', true);
    ajax.setRequestHeader("content-type","application/x-www-form-urlencoded");
    ajax.responseType = 'arraybuffer';
    ajax.send('mostrar_PDF_trabajo_investigacion=true&idTrabajo=' + idTrabajo);

    ajax.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const datosBinarios = new Uint8Array(this.response);
            const formatoPDF = base64js.fromByteArray(datosBinarios);
            const pdfWindow = window.open();
            pdfWindow.document.write('<iframe src="data:application/pdf;base64,' + formatoPDF + '" frameborder="0" style="border:0; top:0px; left:0px; bottom:0px; right:0px; width:100%; height:100%; position: absolute;" allowfullscreen></iframe>');
            pdfWindow.document.title = `${titulo}`;
        }
    };
}

function mostrarModalProyectoSustentado(IDproyecto){
    Swal.fire({
        title: '¿ESTÁS SEGURO?',
        icon: 'warning',
        text: 'El estado de sustentación del proyecto pasará a ser: "Sustentado"',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, guardar',
        cancelButtonText: 'Cancelar'

    }).then((result) => {
        if (result.isConfirmed) {
            const ajax = new XMLHttpRequest();

            ajax.open('POST', '../controladores/administrador/trabajos_investigacion_controlador.php', true);
            ajax.setRequestHeader("content-type","application/x-www-form-urlencoded");
            ajax.send('cambiar_estado_proyecto=true&IDproyecto=' + IDproyecto + '&estado=Sustentado');

            ajax.onreadystatechange = function (){
                if(this.readyState == 4 && this.status == 200){
                    mostrarDatosTabla();
                }
            }
        }
    })
}

function mostrarModalProyectoPendiente(IDproyecto){
    Swal.fire({
        title: '¿ESTÁS SEGURO?',
        icon: 'warning',
        text: 'El estado de sustentación del proyecto pasará a ser: "Pendiente"',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, guardar',
        cancelButtonText: 'Cancelar'

    }).then((result) => {
        if (result.isConfirmed) {
            const ajax = new XMLHttpRequest();

            ajax.open('POST', '../controladores/administrador/trabajos_investigacion_controlador.php', true);
            ajax.setRequestHeader("content-type","application/x-www-form-urlencoded");
            ajax.send('cambiar_estado_proyecto=true&IDproyecto=' + IDproyecto + '&estado=Pendiente');

            ajax.onreadystatechange = function (){
                if(this.readyState == 4 && this.status == 200){
                    mostrarDatosTabla();
                }
            }
        }
    })
}