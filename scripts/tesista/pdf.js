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