<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>Proyecto arquitectos</title>
  <link href='http://fonts.googleapis.com/css?family=Inconsolata' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
  {{ HTML::style('packages/bootstrap/css/bootstrap.css') }}
  {{ HTML::style('packages/bootstrap/css/bootstrap.min.css') }}
  {{ HTML::style('packages/bootstrap/css/datepicker3.css') }}
  {{ HTML::style('packages/bootstrap/css/slidebars.css') }}
  {{ HTML::style('css/main.css')}}
  {{ HTML::style('css/todo.css')}}
  {{ HTML::script('packages/js/jquery-2.1.1.js') }}
  {{ HTML::script('packages/js/jquery.ui.min.js') }}
  {{ HTML::script('packages/js/jquery.dataTables.min.js') }}
  {{ HTML::script('packages/js/dataTables.bootstrap.js') }}
  {{ HTML::script('packages/js/jquery.ui.touch-punch.js') }}
  {{ HTML::script('packages/js/dialogs.js') }}
  {{ HTML::script('packages/js/todo.js') }}
  {{ HTML::script('packages/js/jquery.PrintArea.js') }}
  {{ HTML::script('packages/js/bootstrap-alert.js') }}
  {{ HTML::script('packages/js/jquery.bootstrap-growl.js') }}
  {{ HTML::script('packages/bootstrap/js/bootstrap.js') }}
  {{ HTML::script('packages/bootstrap/js/bootstrap-datepicker.js') }}
  {{ HTML::script('packages/bootstrap/js/bootstrap-modal.js') }}
  {{ HTML::script('packages/bootstrap/js/slidebars.js') }}
</head>
<body>
  <div class="navbar navbar-fixed-top">
    <div id="tabhead">
      <div class="megamenu_container ">
       <div id="logo">PROJARQ<label>MANAGEMENT</label></div>
         <div class="sb-toggle-left navbar-left">
            <div class="navicon-line"></div>
            <div class="navicon-line"></div>
            <div class="navicon-line"></div>
          </div>
        <nav id="menu" class="sb-slide sb-left">
            <ul class="megamenu"> 
              @include('layouts.menu') 
          </ul>
         </nav>
      </div>
    </div>
  </div>
 
  <div id="sb-site">
    <div class="container">
      <div class="container narrow_body" id="body">
        @if(Session::has('message'))
          <div class="alert alert-success">  
            <a class="close" data-dismiss="alert">×</a>  
            <strong>Correcto! </strong>{{ Session::get('message') }}  
          </div>  
        @else
          @if(Session::has('error'))
            <div class="alert alert-error">  
              <a class="close" data-dismiss="alert">×</a>  
              <strong>Error! </strong>{{ Session::get('error') }}
            </div>  
          @endif
        @endif
        {{ $content }}
      </div>
    </div>
  </div>

 </div>
  <div class="sb-slidebar sb-left">
      <ul class="menuResp"> 
        @include('layouts.menuResponsive') 
      </ul>
  </div> 
  <script type="text/javascript">
  jQuery(document).ready(function($) {
    //menu para moviles
    $.slidebars();
    var width = $( window ).width(); 
    $('.sb-toggle-left').click(function() {
        $('.options').css('display', 'block');
      });
   if(width < 490){
 
      $( ".navbar-left" ).css('display', 'block');
      $( "nav#menu" ).css('display', 'none');
      $( ".subPerfil" ).css('display', 'none');      
      $( ".organizacionSub" ).css('display', 'none');
      $( ".proyectoSub" ).css('display', 'none');


      $('#perfilLink').click(function() {
        $('.subPerfil').toggle(); 
      });
      $('#organizationResp').click(function() {
        $('.organizacionSub').toggle(); 
      });
      $('#proyectosResp').click(function() {
        $('.proyectoSub').toggle(); 
      });
      
      //eliminar menu 
      $('#menu').empty();

      
    }else{ 
      //$("#sb-site").css('padding-top', '60px');
      $( "#options" ).css('display', 'none');
      $( "#perfil" ).css('display', 'none');
      $('#organization').click(function() {
        $( "#subMenuProject" ).css('display','none');
        $( "#options" ).toggle(); 
      });
      $('#perfilID').click(function() {
        $( "#perfil" ).toggle();
      });
      
      $(document).mouseup(function (e){
        var container = $("#options");
        if (!container.is(e.target) 
            && container.has(e.target).length === 0) {
            container.hide();
        }

        var container1 = $("#subMenuProject");
        if (!container1.is(e.target) 
            && container1.has(e.target).length === 0) {
            container1.hide();
        }

        var container2 = $("#perfil");
         if (!container2.is(e.target) 
            && container2.has(e.target).length === 0) {
            container2.hide();
        }
      });
    }
    
  });
  </script>
</body>
</html>