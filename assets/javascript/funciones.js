function inicio(){
    document.getElementById("CerrarBloque").addEventListener("click",aparecerBloqueDeConfirmacion);
    document.getElementById("aparecer").addEventListener("click",aparecerBloqueDeConfirmacion);
    document.getElementById("editar").addEventListener("click",aparecerBloqueEditar);
    document.getElementById("CerrarEditar").addEventListener("click",aparecerBloqueEditar);
    
    function aparecerBloqueDeConfirmacion(){
        let bloq = document.getElementById("bloqueDeConfirmacion");
        if(bloq.style.display=="none"){
            bloq.style.display="block";
        }else{
            bloq.style.display="none";
        }
    }
    function aparecerBloqueEditar(){
        let bloq = document.getElementById("cambiarDatos");
        if(bloq.style.display=="none"){
            bloq.style.display="flex";
        }else{
            bloq.style.display="none";
        }
    }
}
window.onload = inicio;