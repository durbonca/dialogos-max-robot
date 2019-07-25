 
$(document).ready(function(){
            
    var p={};
    setInterval(function(){ 
        VerLista(p);
        VerChat(p);
    }, 1000);

    var vtn = $(window).height();
    vtn = (vtn * 90) / 100;
    $("#ListaDialogos").css({"height": vtn + 'px'});
    
    var vtn_crearFrases = $(window).height();
    vtn_crearFrases = (vtn * 30) / 100;
    $("#crear_frases").css({"height": vtn_crearFrases + 'px'});

    var vtn_chatbox = $(window).height();
    vtn_chatbox = (vtn * 80) / 100;
    $("#chatbox").css({"height": vtn_chatbox + 'px'});

    alfinal();

    $("#activar").on("click",()=>{
        alert("hola");
    });

    $("#botonchat").click(()=>{
        p = {
            mensaje: $("#mensaje").val(),
            btn:'Enviar'
        };
        VerChat(p);
        alfinal();
        $("#mensaje").val("");
    })

    function alfinal(){
        var altura = 20000;
        $("#chatbox").animate({scrollTop:altura+"px"});
        
    }

    function VerLista(p){
        $.ajax({
            async:true,
            type:"POST",
            data:p,
            cache: false,
            success: (data)=> {
                $("#ListaDialogos").html(data);
            },
            error: () =>{
                $("#ListaDialogos").html("<center><h1>Error al Cargar Lista</h1><center>");
            },
            url: './lista_dialogos.php'
        });
    }

    function VerChat(p){
        $.ajax({
            async:true,
            type:"POST",
            data:p,
            cache: false,
            success: (data) => {
                $("#chatbox").html(data);
            },
            error: () => {
                $("#chatbox").html("<center><h1>Error al Cargar Lista</h1><center>");
            },
            url: './lista_chat.php'
        });
    }
    
}); 