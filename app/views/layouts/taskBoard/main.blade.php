<html>
    <head>
        <title>AngelPrime to-do List</title>

  {{ HTML::style('packages/bootstrap/css/bootstrap.css') }}
  {{ HTML::style('packages/bootstrap/css/bootstrap.min.css') }}
  {{ HTML::style('packages/bootstrap/css/datepicker3.css') }}
  {{ HTML::style('css/main.css')}}
  {{ HTML::script('packages/js/jquery.min.js') }}
  {{ HTML::script('packages/js/jquery.ui.min.js') }}
  {{ HTML::style('css/todo.css')}}
  {{ HTML::script('packages/js/todo.js') }}
  {{ HTML::script('packages/bootstrap/js/bootstrap.min.js') }}
  {{ HTML::script('packages/bootstrap/js/bootstrap-datepicker.js') }}

</head>

    </head>

    <body class="well">
        <div id="container">

            <div id="header"> To Do List </div>

            <div class="task-list task-container" id="pending">
                <h3>Pendiente</h3>
                <!--<div class="todo-task">
                    <div class="task-header">Sample Header</div>
                    <div class="task-date">25/06/1992</div>
                    <div class="task-description">Lorem Ipsum Dolor Sit Amet</div>
                </div>-->
            </div>

            <div class="task-list task-container" id="inProgress">
                <h3>En progreso</h3>
            </div>

            <div class="task-list task-container" id="completed">
                <h3>Completada</h3>
            </div>

            <div class="task-list">
                <h3>Agregar nueva tarea</h3>
                <form id="todo-form">
                    <input type="text" placeholder="Title" />
                    <textarea placeholder="Description"></textarea>
                    <input type="text" id="datepicker" placeholder="Due Date (dd/mm/yyyy)" />
                    <input type="button" class="btn btn-primary" value="Agregar tarea" onclick="todo.add();" />
                </form>

                <input type="button" class="btn btn-primary" value="Limpiar" onclick="todo.clear();" />

                <div id="delete-div">
                    Mover aqui para eliminar
                </div>
            </div>

            <div style="clear:both;"></div>
            <script type="text/javascript">
                $( "#datepicker" ).datepicker();
                $( "#datepicker" ).datepicker("option", "dateFormat", "dd/mm/yy");

                $(".task-container").droppable();
                $(".todo-task").draggable({ revert: "valid", revertDuration:200 });
                todo.init();
            </script>

        </div>
    </body>
</html>