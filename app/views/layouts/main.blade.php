<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Proyecto arquitectos</title>
  {{ HTML::style('packages/bootstrap/css/bootstrap.css') }}
  {{ HTML::style('packages/bootstrap/css/bootstrap.min.css') }}
  {{ HTML::style('packages/bootstrap/css/datepicker3.css') }}
  {{ HTML::style('css/main.css')}}
  {{ HTML::script('packages/js/jquery-2.1.1.js') }}
  {{ HTML::script('packages/bootstrap/js/bootstrap-datepicker.js') }}
</head>
<body>
  <div class="navbar navbar-fixed-top">
    <div id="tabhead">
      <div class="megamenu_container">
          <ul class="megamenu"> 
            @include('layouts.menu') 
        </ul>
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
    $('#organization').click(function() {
      $( "#options" ).toggle();
    });
  });
  </script>
</body>
</html>