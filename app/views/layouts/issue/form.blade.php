@if(Auth::user()->rol=='Administrator')

  <div id="story_details" style="display: none;" >
    <table id="add_story_table">
      <tbody>
        <tr>
          <td>Detalle:</td>
          <td>
            <textarea id="detail" rows="10" cols="40" name="detail" maxlength="5000"></textarea>
          </td>
        </tr>
        <tr>
          <td>Etiquetas:</td>
          <td>
            <div class="tag_holder">
              <input style="display: none;" name="labels" id="id_tags" type="text">
              <ul class="tagit ui-widget ui-widget-content ui-corner-all">
                <li class="tagit-new">
                  <input aria-haspopup="true" aria-autocomplete="list" role="textbox" autocomplete="off" class="ui-widget-content ui-autocomplete-input" type="text">
                </li>
              </ul>
            </div>
          </td>
        </tr>
        <tr>
          <td>Puntos:&nbsp;</td>
          <td>
            <input name="points" id="points" type="text" />
          </td>
        </tr>
        <tr>
          <td>Categoría:&nbsp;</td>
          <td>
            <select name="categoryid" id="categoryid">
              <option value="0">----</option>
              @foreach ($categories as $category)
                @if($category->id == $idCategory)
                  <option value="{{ $category->id }}" selected>{{ $category->name }} </option>
                @else
                  <option value="{{ $category->id }}" >{{ $category->name }} </option>
                @endif
              @endforeach
            </select>   
            <a class="add_category_link" href="#">Agregar categoría</a>
            <input name="category_name" class="category_name" maxlength="25" style="display:none" type="text">
          </td>
        </tr>
        <tr>
          <td>Iteración:&nbsp;</td>
          <td>
            <select name="iterationid" id="iterationid">
              @foreach ($iterations as $iteration)
                <option value="{{ $iteration->id }}">{{ $project->name }} / {{$iteration->name}} </option>
              @endforeach
            </select>
          </td>
        </tr>
      </tbody>
    </table>
    <div class="buttonHolder">
      {{ HTML::link('/iterations/' . $iteration->id,  'Cancelar', array('class'=>"btn btn-danger btn-sm")  ) }} 
    </div>
  </div>
@endif

<script type="text/javascript">
$(document).ready(function() { 
  $('#addStoryForm').submit(function(event){  
     var summary = $('#summary').val();
     var detail = $('#detail').val();
     
//     var radio = $('input[name=points]:checked'); 
     var radio = $('#points').val();
     if(summary == '' ||  detail == '' || radio ==''){
       jQuery('.remove-error-issue').remove();

       var main = '<h class="remove-error-issue"><strong>Error! </strong> Existieron errores<h>';

       var insert = '<ul class="remove-error-issue alert alert-error">';

       if(summary == ''){
        insert += '<li>'+ 'El resumen del ahistoria es obligatorio'+'</li>';
       }

       if(detail == ''){
        insert += '<li>'+ 'El detalle de la historia es obligatorio'+'</li>';
       }

       if(radio ==''){
        insert += '<li>'+ 'Los puntos para la historia es obligatorio'+'</li>';
       }
       
       insert += '<ul>';
       $("#mainError").css("visibility", "visible");
       $('#mainError').append(main);
       $('#issueError').append(insert);
       return false;
     }else{
      return true; 
     }
     
  });   
});

</script>

<script type="text/javascript">
  
  $(function() {
    
    $( "#points" ).keyup(function () { 
      $(this).val($(this).val().replace(/[^0-9]/g,''));
    });
  });
</script>