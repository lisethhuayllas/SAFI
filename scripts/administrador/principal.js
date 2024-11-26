const aResoluciones = document.querySelector("#a-resoluciones");
const textoResoluciones = document.querySelector("#texto-resoluciones");
const iResoluciones = document.querySelector("#i-resoluciones");

const aTrabajosInvestigacion = document.querySelector("#a-trabajos-investigacion");
const textoTrabajosInvestigacion = document.querySelector("#texto-trabajos-investigacion");
const iTrabajosInvestigacion = document.querySelector("#i-trabajos-investigacion");

const aTesistas = document.querySelector("#a-tesistas");
const textoTesistas = document.querySelector("#texto-tesistas");
const iTesistas = document.querySelector("#i-tesistas");

const aAsesores = document.querySelector("#a-asesores");
const textoAsesores = document.querySelector("#texto-asesores");
const iAsesores = document.querySelector("#i-asesores");

const aJurados = document.querySelector("#a-jurados");
const textoJurados = document.querySelector("#texto-jurados");
const iJurados = document.querySelector("#i-jurados");

const opcionesMenu=[aResoluciones ,aTrabajosInvestigacion, aTesistas,aAsesores,aJurados];
const textosBotones={"resoluciones": textoResoluciones,"trabajos-investigacion": textoTrabajosInvestigacion,"tesistas":textoTesistas, "asesores":textoAsesores, "jurados":textoJurados};
const iconosBotones={"resoluciones":iResoluciones,"trabajos-investigacion": iTrabajosInvestigacion, "tesistas":iTesistas, "asesores": iAsesores, "jurados": iJurados};

nombreModulo=location.search.replace("?modulo=", "");

if(nombreModulo=='' || (nombreModulo!='resoluciones' && nombreModulo!='trabajos-investigacion' && nombreModulo!='tesistas' && nombreModulo!='asesores' && nombreModulo!='jurados')){
    nombreModulo = 'trabajos-investigacion';
}

opcionesMenu.forEach(opcion => {
    idOpcion=opcion.id.replace("a-","");

    if(idOpcion == nombreModulo){
        opcion.style.setProperty("background-color","#F4F8FF");
        textosBotones[idOpcion].style.setProperty("color", "#1A75D6");
        iconosBotones[idOpcion].style.setProperty("color","#1A75D6");
    }
});