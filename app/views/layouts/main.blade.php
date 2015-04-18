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
  {{ HTML::style('css/main.css')}}
  {{ HTML::style('css/todo.css')}}
  {{ HTML::script('packages/js/jquery-2.1.1.js') }}
  {{ HTML::script('packages/js/jquery.ui.min.js') }}
  {{ HTML::script('packages/js/dialogs.js') }}
  {{ HTML::script('packages/js/todo.js') }}
  {{ HTML::script('packages/bootstrap/js/bootstrap-datepicker.js') }}
  {{ HTML::script('packages/bootstrap/js/bootstrap-modal.js') }}
</head>
<body>
  <div class="navbar navbar-fixed-top">
    <div id="tabhead">
      <div class="megamenu_container">
        <div id="logo">PROJARQ<label>MANAGEMENT</label></div>
        <nav id="menu">
            <ul class="megamenu"> 
              @include('layouts.menu') 
          </ul>
         </nav>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="container narrow_body" id="body">
      @if(Session::has('message'))
      <p class="alert">{{ Session::get('message') }}</p>
      @endif
      {{ $content }}
    </div>
  </div>
  <script type="text/javascript">
  jQuery(document).ready(function($) {
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
  });
  </script>
</body>
</html>