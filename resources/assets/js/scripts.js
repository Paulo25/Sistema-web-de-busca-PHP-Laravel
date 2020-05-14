
        function buscar(palavra){

          var page = "{{Route('busca')}}";
          $.ajax({
              type: "GET",
              dataType: "html",
              url: page,
              beforeSend: function(){
                  $("#dados").html("carregando...");
              },
              data: {palavra: palavra},
              success: function(msg){
                  $("#dados").html(msg);
              }
          });

      }
      
      $("#buscar").click(function(){
          buscar($("#palavra").val())
      });