//CAPTURA DE ELEMENTOS INPUT DEL FORMULARIO
const formulario_login=document.querySelector(".formulario-login");
const input_DNI=document.querySelector("#input-usuario");
const input_contrasenia=document.querySelector("#input-contrasenia");

//VALIDACIONES DEL FORMULARIO
const REGEX_DNI = /^[0-9]+$/;

formulario_login.addEventListener("submit",(e)=>{
    e.preventDefault();

    let valor_DNI=input_DNI.value;
    let valor_contrasenia=input_contrasenia.value.replace(/ /g,'');

    if(!REGEX_DNI.test(valor_DNI) || valor_DNI.length!=8){
        alertas.fire({
            icon: 'error',
            title: 'Número de DNI no válido'
        });

    }else if(valor_contrasenia.length<8 || valor_contrasenia.length>32){
        alertas.fire({
            icon: 'error',
            title: 'La contraseña debe tener 8 caracteres como mínimo'
        });

    }else{
        const destino='controladores/index_controlador.php';
        const datos='input-DNI='+ valor_DNI +'& input-contrasenia='+ valor_contrasenia;
        let comunicacion_AJAX=conexionAjax(destino,datos);

        if(comunicacion_AJAX=="Contraseña incorrecta"){
            alertas.fire({
                icon: 'error',
                title: 'La contraseña ingresada es incorrecta'
            });

        }else if(comunicacion_AJAX=="Usuario no registrado"){
            alertas.fire({
                icon: 'error',
                title: 'Usuario no registrado en el sistema'
            });
        
        }else{
            location.replace(comunicacion_AJAX); 
        }
    }
});

//VALIDACIONES PARA EL CAMBIO DE CONTRASEÑA

const recuperar_contraseña= document.querySelector("#olvide-contrasenia-a").addEventListener("click",(e)=>{
    e.preventDefault();

    Swal.fire({
        title: 'INGRESA TU NUMERO DE DNI',
        input: 'text',
        inputAttributes: {
            autocapitalize: 'off',
            maxlength:8
        },
        showCancelButton: true,
        confirmButtonText: 'ACEPTAR',
        cancelButtonText: 'CANCELAR',
        cancelButtonColor: '#dc3545',
        showLoaderOnConfirm: true,
        inputValidator: (DNI) => {
            if(DNI.length==0){

                return 'Ingrese su número de DNI';

            }else if (!REGEX_DNI.test(DNI)) {

                return 'El DNI debe estar compuesto solo por números';
    
            }else if(DNI.length<8 || DNI.length!=8){

                return 'El DNI debe estar compuesto por 8 dígitos';

            }else{
                const destino='controladores/index_controlador.php';
                const datos='DNI-recuperacion='+ DNI +'& recuperacion=true';
                let comunicacion_AJAX=conexionAjax(destino,datos);

                if(comunicacion_AJAX=="Usuario no registrado"){
                    return "Usuario no registrado en el sistema";

                }else{
                    let datos=JSON.parse(comunicacion_AJAX);
                    let correo=datos[0];
                    let rol=datos[1];

                    let token=genera_token();

                    const destino_recuperacion='controladores/recuperar_contrasenia.php';
                    const datos_recuperacion='correo-recuperacion='+ correo +'& token='+token;
                    
                    conexionAjax(destino_recuperacion,datos_recuperacion);
                    
                    Swal.fire({
                        title: 'INGRESA EL CÓDIGO',
                        text: "Ingresa el código de verificación que enviamos a tu correo",
                        input: 'text',
                        inputAttributes: {
                            autocapitalize: 'off',
                            maxlength:12
                        },
                        showCancelButton: true,
                        confirmButtonText: 'ACEPTAR',
                        cancelButtonText: 'CANCELAR',
                        cancelButtonColor: '#dc3545',
                        showLoaderOnConfirm: true,
                        inputValidator: (codigo) => {
                            if(codigo!=token){
                                return "El código no coincide con el enviado a tu correo"

                            }else{
                                Swal.fire({
                                    title: 'INGRESA TU NUEVA CONTRASEÑA',
                                    input: 'password',
                                    inputAttributes: {
                                        autocapitalize: 'off',
                                        maxlength:32
                                    },
                                    showCancelButton: true,
                                    confirmButtonText: 'ACEPTAR',
                                    cancelButtonText: 'CANCELAR',
                                    cancelButtonColor: '#dc3545',
                                    showLoaderOnConfirm: true,
                                    inputValidator: (contrasenia) => {
                                        if(contrasenia.replace(/ /g,'').length<8 || contrasenia.replace(/ /g,'').length>32){
                                            return "La contraseña debe tener 8 caracteres como mínimo";

                                        }else{
                                            alertas.fire({
                                                icon: 'success',
                                                title: 'Contraseña cambiada correctamente'
                                            });

                                            const destino_recuperacion='controladores/index_controlador.php';
                                            const datos_recuperacion='usuario-recuperacion='+ DNI +'& rol-recuperacion='+ rol +'& contrasenia-recuperacion='+contrasenia;
                                            
                                            conexionAjax(destino_recuperacion,datos_recuperacion);
                                        }
                                    }
                                });
                            }
                        }
                    });
                }

            }
        }
    });
});

//ALERTAS
const alertas= Swal.mixin({
    toast: true,
    position: 'bottom-end',
    showConfirmButton: false,
    timer: 3000
});

//FUNCIONES
function conexionAjax(destino,datos){
    const ajax = new XMLHttpRequest;
    const URL= destino;

    ajax.open('POST',URL,false);
    ajax.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    ajax.send(datos);

    return ajax.responseText;
}

function genera_token(){
    let caracteres = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
    let token="";

    for(let i=0;i<12;i++){
        token+=caracteres[Math.floor(Math.random()*(caracteres.length-1))];
    }

    return token;
}