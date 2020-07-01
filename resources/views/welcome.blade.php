<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CBN</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

        <!-- Styles -->
        <style>
            body {
                font-family: "Lato", sans-serif;
            }

            .main-head{
                height: 150px;
                background: #FFF;
            }

            .sidenav {
                height: 100%;
                background-color: #000;
                overflow-x: hidden;
                padding-top: 20px;
            }


            .main {
                padding: 0px 10px;
            }

            @media screen and (max-height: 450px) {
                .sidenav {padding-top: 15px;}
            }

            @media screen and (max-width: 450px) {
                .login-form{
                    margin-top: 10%;
                }
            }

            @media screen and (min-width: 768px){
                .main{
                    margin-left: 60%; 
                }

                .sidenav{
                    width: 60%;
                    position: fixed;
                    z-index: 1;
                    top: 0;
                    left: 0;
                }

                .login-form{
                    margin-top: 45%;
                }

            }

            .login-main-text{
                margin-top: 20%;
                padding: 60px;
                color: #fff;
            }

            .login-main-text h3{
                font-weight: 300;
            }

            .btn-black{
                background-color: #000 !important;
                color: #fff;
            }            
            .btn-black:hover{
                background-color: #000 !important;
                color: #fff;
            }
        </style>
    </head>
    <body>
        <div class="sidenav">
         <div class="login-main-text">
            <h3>CBN<br> Cerveceria Boliviana Nacional</h3>
            <p>Sistema de consulta de deuda...
         </div>
        </div>
      <div class="main">
         <div class="col-md-12 col-sm-12">
            <div class="login-form">
                
                  
                  <div class="form-group">
                     <label>CLIENTE:</label>
                     <select name="cliente" id="cliente" class="form-control cliente" required=""></select>

                  </div>
                  <div class="form-group">
                     <label>CODIGO DE CLIENTE:</label>
                     <input type="text" name="codigo" id="codigo" class="form-control" placeholder="Ingrese su codigo..." required="">
                  </div>

                  {{-- <button type="submit" class="btn btn-black btn_consulta">Consultar</button> --}}
                   <a href="#" class="btn btn-black btn_consulta">  <i class="fa fa-cog pull-right"></i> Consultar </a>
                              
            </div>
         </div>
      </div>

      <div class="modal fade modal_generico" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Resultado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body contenido_generico">
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              </div>
            </div>
          </div>
        </div>
        


<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    
    <script type="text/javascript">


$('#cliente').select2({
    placeholder: 'Seleccione un cliente...',
    minimumInputLength: 3,
    language: {
      noResults: function() { return "No hay resultado";},
      searching: function() { return "Buscando.."; },
      inputTooShort: function() { return "Por favor ingrese 3 o mas caracteres"; }
    },
    ajax: {
        url: "{{ route('cliente.finder')}}",
        dataType: 'json',
        data: function (params) {
            return {
                q: $.trim(params.term),
                type: 'public'
            };
        },
        processResults: function (data) {
            return {
                results: data

            };
            console.log(1);
        },
        cache: true
    }
});




var btn_consulta = $(".btn_consulta");
  btn_consulta.on("click",function(){
    var cliente = $("#cliente").val();
    var codigo = $("#codigo").val();
     frm_consulta(cliente,codigo);
  });

  var modal=$(".modal_generico");
  var modalContent = $(".contenido_generico");


  var frm_consulta = function(cl,co){
    $.ajax({
      type: "GET",
      cache: false,
      dataType: "html",
      url: "{{ route('envases.consulta')}}",
      data: {
        cliente: cl,
        codigo: co
      },
      success: function(dataResult)
      {

        console.log(dataResult);
        modalContent.empty().html(dataResult);                        
        modal.modal('show');

      }
    });
  };


    </script>
    </body>
</html>
