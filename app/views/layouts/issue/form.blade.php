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
      <td id="points_section">
        <ul>
          <li>
            <label for="id_points_1">
              <input type="radio" name="points" value="0" id="id_points_1"> 0
            </label>
          </li>
          <li>
            <label for="id_points_2">
              <input id="id_points_2" value="0.5" name="points" type="radio"> 0.5
            </label>
          </li>
          <li>
            <label for="id_points_3">
              <input id="id_points_3" value="1" name="points" type="radio"> 1
            </label>
          </li>
          <li>
            <label for="id_points_4">
              <input id="id_points_4" value="2" name="points" type="radio"> 2
            </label>
          </li>
          <li>
            <label for="id_points_5">
              <input id="id_points_5" value="3" name="points" type="radio"> 3
            </label>
          </li>
          <li>
            <label for="id_points_6">
              <input id="id_points_6" value="5" name="points" type="radio"> 5
            </label>
          </li>
          <li>
            <label for="id_points_7">
              <input id="id_points_7" value="8" name="points" type="radio"> 8
            </label>
          </li>
          <li>
            <label for="id_points_8">
              <input id="id_points_8" value="13" name="points" type="radio"> 13
            </label>
          </li>
          <li>
            <label for="id_points_9">
              <input id="id_points_9" value="20" name="points" type="radio"> 20
            </label>
          </li>
        </ul>
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
</div>
<script type="text/javascript">
$(document).ready(function() { 
  $('#addStoryForm').submit(function(event){  
     var summary = $('#summary').val();
     var detail = $('#detail').val();
     var radio = $('input[name=points]:checked'); 
     if(summary == '' ||  detail == '' || !radio.val()){
       return false;
     }
     return true;
  });   
});

</script>