<?php

# modelo que se va encargar de consultar los datos del json de tareas

// guardar tarea, listar todas las tareas, editar tarea (JSON)

class TaskModel {
    public $id_task;
    public $title;
    public $description;
    public $date;
    public $status;
    public $id_employee;

    //atributo estatico para manejar la ruta del archivo json
    private static $file_path = '../data/tasks.json';

    public function __construct($id_task, $title, $description, $id_employee) 
    {
        $this->id_task = $id_task;
        $this->title = $title;
        $this->description = $description;
        $this->date = date('Y-m-d H:i:s'); // fecha actual
        $this->status = 'pendiente'; // estado inicial
        $this->id_employee = $id_employee;
    }

    //metodo para obtener todas las tareas del archivo json
    public static function all()
    {
        if(file_exists(self::$file_path)) {
            //obteniendo el archivo json
            $data_json = file_get_contents(self::$file_path);
            //print_r($data_json);

            //json_decode() = convierte tu json a un arreglo de php = json_encode() = convierte un arreglo de php a json
            return json_decode($data_json, true); //true para que lo convierta en un array asociativo
        }

        return []; //retornar un array vacio si no existe el archivo
    }

    //metodo que va a cargar el json y lo va actualizar
    public static function loadJSON($array_tasks) {

    }

    //metodo para guardar una tarea
    public function save(){

        $list_tasks = self::all(); //devuelve el arreglo de las tareas que hay en el json

        //agregando un nuevo elemento (tarea)
        //array_push($list_tasks, []);

        $list_tasks[] = [
            "id_task" => $this->id_task,
            "title" => $this->title,
            "description" => $this->description,
            "date" => $this->date,
            "status" => $this->status,
            "id_employee" => $this->id_employee
        ];

        //metodo que nos ayude actualizar el JSON
        //codificar el arreglo de PHP a un formato de tipo JSON
        $data_json = json_encode($list_tasks, JSON_PRETTY_PRINT);
        file_put_contents(self::$file_path, $data_json);
        return "Se ha guardado correctamente la tarea con el id: $this->id_task";
    }
}