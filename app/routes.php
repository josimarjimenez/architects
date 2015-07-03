<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::get('iterations/{id}/finalize', function(){
	//die('2323223');
});

Route::group(array('before' => 'auth'), function()
{
	Route::controller('organization', 'OrganizationsController');
	Route::controller('states','ScrumStatesController');
	Route::resource('projects', 'ProjectsController');
	//Route::resource('users', 'UsersController');
	Route::resource('materials', 'MaterialsController');
	Route::resource('teams', 'TeamsController');
	Route::resource('taskBoard', 'TaskBoardController'); 
	Route::resource('issue', 'IssueController');
	Route::resource('iterations', 'IterationsController');
	//Route::resource('task', 'TaskController');
	Route::resource('personalType', 'PersonalTypeController');

});

Route::group(['prefix' => 'messages'], function () {
    Route::get('/', ['as' => 'messages', 'uses' => 'MessagesController@index']);
    Route::get('create', ['as' => 'messages.create', 'uses' => 'MessagesController@create']);
    Route::post('/', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
    Route::get('{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
    Route::put('{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);
});

Route::get('users/delete', function(){ 
	if(Request::ajax()){ 
		$id = Input::get("id");
		$user = User::findOrFail($id); 
		$organizations = sizeof(Organization::where('usersid','=', $id)->get());
		if($organizations>= 1){
			return Response::json(array('succes'=>'false', 
				'message'=>'No se puede borrar el registro. <br />El usuario es propietario de una organización'));
		}
		
		if($user->delete()){
			return Response::json(array('succes'=>'true', 
				'message'=>'Usuario eliminado exitosamente', 'gr'=>$user->organization()));

		}else{
			return Response::json(array('succes'=>'false', 
				'message'=>'Error, claves foráneas'));
		}
	} 
}); 

Route::controller('projects', 'ProjectsController');
Route::controller('users', 'UsersController');
Route::get('/', 'UsersController@getLogin');
Route::post('update/{id}', 'UsersController@update');


Route::get('edit/{id}', 'GraphicsController@iterationSummary');

Route::get('grafica/{id}', 'GraphicsController@iterationSummary');

Route::get('graphic/{id}', 'GraphicsSummaryController@summary');

Route::get('graphic_spending/{id}', 'GraphicsSpendingController@summary');

Route::get('graphictest/{id}', 'GraphicsTestController@summary');

Route::get('graphic_bar_task/{id}', 'GraphicsTaskController@bar_task');

Route::get('graphic_bar_time/{id}', 'GraphicsIterationController@bar_time');

Route::get('graphic_bar_budget/{id}', 'GraphicsIterationController@bar_budget');

Route::get('graphic_line_time/{id}', 'GraphicsIterationController@line_time');

Route::get('graphic_line_budget/{id}', 'GraphicsIterationController@line_budget');

Route::post('task', function(){ 
	if(Request::ajax()){ 
		$task = new Task; 
		$task->name = Input::get("name");
		$task->summary = Input::get("summary");
		$task->points  = Input::get("points");
		$task->timeEstimated = Input::get("timeEstimated");
		$task->timeRemaining = Input::get("timeEstimated");
		$task->timeReal = 0;
		$task->scrumid = 1; //estado todo ...quemado por código
		$task->issueid = Input::get("issueid"); 
		$task->userid =  Input::get("selAssignee");
        unset($task->username);
		$task->save();

		$issue = Issue::findOrFail($task->issueid);
		$iteration = $issue->iterations;
		$iteration->estimatedTime = $iteration->estimatedTime + $task->timeEstimated;
		$iteration->save();

		if($task){  
			$user = User::findOrFail($task->userid);
			$username = $user->name.' '.$user->lastname;
			return Response::json(array(
                    'success' => true,
                    'message' => 'Tarea registrada',
                    'task' =>  $task,
                    'username' => $username
            ));
		}else{
			 return Response::json(array(
                'success' => false,
                'errors' => 'Error al grabar'
            )); 
		}
	}
});
//get specific task
Route::get('tareas/getTask', function(){ 
	if(Request::ajax()){ 
		$id = Input::get("id");
		$task = Task::findOrFail($id);

		//obtener los responsables de la tarea
		$issue = Issue::findOrFail($task->issueid);
		$iteration = Iterations::findOrFail($issue->iterationid);
		$project = Project::findOrFail($iteration->projectid);
		//echo $project->id;
		//die() ;
		//$team = Teams::where('projectid','=',$project->id)->get()->first();
		$team = $project->team;

		$members = DB::table('memberof')->where('teamid','=', $team->id)->get();
		$users = array();
		foreach($members as $member){
			$users[] = User::findOrFail($member->usersid);
		}
		return Response::json(array('task'=>$task, 'users'=>$users));
	}
});

//get all task
Route::get('tareas/taskAll', function(){ 
	if(Request::ajax()){ 
		$id = Input::get("id");
		$idUser = Input::get("idUser");
		$tasks = Task::where('issueid','=', $id)->get();

		$userLoggedIn = User::findOrFail($idUser);
		 
		 
		if($userLoggedIn->rol != 'Administrator'){
			$tasks = Task::where('issueid','=', $id)
    					->where('userid', '=', $userLoggedIn->id)
						->get();
		}

		foreach ($tasks as $task) {

			if($task->userid !=null){
				$user = User::findOrFail($task->userid);
				$task->username = $user->name;
			}
		}
		return Response::json(array('tasks'=>$tasks));
	}
});

//udpate STATE task
Route::get('tareas/updateTaks', function(){ 
	if(Request::ajax()){ 
		$id = Input::get("id");
		$state = Input::get("state");
		$task = Task::findOrFail($id);
		
		switch($state){
			case "todo":
				$task->scrumid = 1; 
			break;
			case "haciendo":
				$task->scrumid = 2;
			break;
			case "hecho":
				$task->scrumid = 3;
			break;
		}
		$task->save();
		return Response::json(array('succes'=>'1'));
	}
});

//editar tarea
Route::post('tareas/editTask', function(){ 
	if(Request::ajax()){ 
		$id = Input::get("id");
		$task = Task::findOrFail($id);
		$task->name = Input::get("name"); 
		$task->summary = Input::get("summary");
		$task->points = Input::get("points");
		$task->timeEstimated = Input::get("timeEstimated");
		if(Input::get("canRegisterSpent")==0){
			$timeReal = $task->timeReal;
			$task->timeReal = $timeReal + Input::get("timeReal"); 
			$task->timeRemaining = $task->timeEstimated - $task->timeReal;
		}
		
		$task->userid =  Input::get("selAssignee");
		$task->save(); 
		$final="no";  

		$issue = Issue::findOrFail($task->issueid);
		$iteration = $issue->iterations;

		
		//$iteration = $issue->iteration;
		$iteration->realTime = $iteration->realTime + Input::get("timeReal"); 
		$iteration->save();
 
		//validar si existen ingresados gastos(material, personal, adicionales)
		
		if(Input::get("canRegisterSpent")==1){
			//vincular materiales a tarea
			$idsMaterial =  Input::get("listaIDS_M");
			$ids = explode(" ", $idsMaterial);
			$totalMaterial=0;
			if(!empty($idsMaterial)){
				foreach ($ids as $id) {
					if($id==''){
						continue;
					}

					$cantidad 	=  Input::get("cuM_".$id); 
					$total  	=  Input::get("toM_".$id);
					$totalMaterial += $total;
					$task->materials()->attach([$id => ['quantity'=>$cantidad, 'total'=>$total]]);
				}
			}
			
			//vincular personal a tarea
			$idsPersonal =  Input::get("listaIDS_P");
		 	$ids = explode(" ", $idsPersonal);
			$totalPersonal=0;
			if(!empty($idsPersonal)){
				
				foreach ($ids as $id) {
					if($id==''){
						continue;
					}
					$cantidad 	=  Input::get("cuP_".$id); 
					$hours 		=  Input::get("chP_".$id);
					$total  	=  Input::get("toP_".$id); 
					$totalPersonal += $total;

					$task->typePersonal()->attach([$id => ['quantity'=>$cantidad, 'hours'=> $hours,'total'=>$total]]);
				}
			}


			//obtener los gastos adicionales de la tarea
			$gastos = AdditionalCost::where('taskid','=', $id)->get();
			$totalSpent=0;
			if(count($gastos)>0){
				foreach ($gastos as $gasto) {
					$totalSpent += $gasto->total;
				}
			}

			//actualizar la iteracion y el proyecto
			$totalTask = $totalMaterial + $totalPersonal + $totalSpent; 
			$issue = Issue::findOrFail($task->issueid);
			$iteration = Iterations::findOrFail($issue->iterationid);
			$project = Project::findOrFail($iteration->projectid);
			//iteracion
			$iteration->realBudget = $iteration->realBudget + $totalTask;
			$iteration->save();

			//proyecto
			$project->budgetReal = $project->budgetReal +$totalTask;
			$project->save();
			$final="yes";

			//actualizar a finalizado la tarea
			$task->closed='SI';
			$task->save(); 
		}
		$user = User::findOrFail($task->userid);
		return Response::json(
			array('succes'=>'1', 
				  'task'=>$task, 
				  'user'=>$user,
				  'final'=>$final));
	}
});

/**
* grabar un gasto adicional de la tarea 
**/
Route::get('tareas/delete', function(){ 
	if(Request::ajax()){  
		$id = Input::get("id");
		if( !empty( Input::get("id") ) ) {
			$task = Task::find($id);
			$issue = $task->issue;
			$iteration = $issue->iterations;

			$iteration->realTime =  $iteration->realTime - $task->timeReal;
			$iteration->estimatedTime = $iteration->estimatedTime - $task->timeEstimated;
			$iteration->save();

			$task->delete();
		}
		return Response::json( array('succes'=>'1') );
	}
});

/**
* grabar un gasto adicional de la tarea 
**/
Route::get('aditionalCost/save', function(){ 
	if(Request::ajax()){  
		$aditionalCost = "";
		if(!empty(Input::get("description")) && Input::get("total")){
			$aditionalCost = new AdditionalCost;
			$aditionalCost->description = Input::get("description"); 
			$aditionalCost->total = Input::get("total");
			$aditionalCost->taskid = Input::get("taskid"); ; 
			$aditionalCost->save(); 
		}
		return Response::json(array('succes'=>'', 'aditionalCost'=>$aditionalCost));
	}
});



/**
* grabar un gasto adicional de la tarea 
**/
Route::get('aditionalCost/delete', function(){ 
	if(Request::ajax()){  
		$id = Input::get("id");
		if( !empty( Input::get("id") ) ) {
			$additionalCost = AdditionalCost::find($id);
			$additionalCost->delete();  
		}
		return Response::json( array('succes'=>'1') );
	}
});



/**
 * 
 */
Route::get('ajax/getProject', function(){ 
	if(Request::ajax()){ 
		$id = Input::get("id");
		$project = Project::findOrFail($id); 
		return Response::json(array('project'=>$project, 'iterations'=>$project->iterations));
	}
});

