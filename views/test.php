<?php

require_once '../models/TaskModel.php'; //importando el modelo

//TaskModel::all(); //llamando al metodo estatico all para obtener todas las tareas

$tarea2 = new TaskModel(2, "Marvin Solorzano", "Prueba de PHP.......", 2);
echo $tarea2 -> save(); //guardando la tarea
