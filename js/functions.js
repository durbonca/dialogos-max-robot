        $(document).ready(function(){
            var p={};
            setInterval(function(){ 
                VerLista();
                VerChat();
            }, 1000);

            var vtn = $(window).height();
            vtn = (vtn * 85) / 100;
            $("#ListaDialogos").css({"height": vtn + 'px'});

            var vtn_crearFrases = $(window).height();
            vtn_crearFrases = (vtn * 30) / 100;
            $("#crear_frases").css({"height": vtn_crearFrases + 'px'});

            var vtn_chatbox = $(window).height();
            vtn_chatbox = (vtn * 80) / 100;
            $("#chatbox").css({"height": vtn_chatbox + 'px'});


            $("#botonchat").click(()=>{
                p = {
                        mensaje: $("#mensaje").val(),
                        btn:'Enviar'
                    };
                    VerChat(p);
            })

            function VerLista(){
                $.ajax({
                    async:true,
                    type:"POST",
                    cache: false,
                    success: function (data) {
                        $("#ListaDialogos").html(data);
                    },
                    error: function() {
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
                    success: function (data) {
                        $("#chatbox").html(data);
                    },
                    error: function() {
                        $("#chatbox").html("<center><h1>Error al Cargar Lista</h1><center>");
                    },
                    url: './lista_chat.php'
                });
            }

        }); 