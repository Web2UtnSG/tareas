<?php 
function getDB(){
    $db = new PDO('mysql:host=localhost;dbname=db_tareas;charset=utf8', 'root', '1234');
    return $db;
}
function getTareas(){
    $db = getDB();
    $sentencia = $db->prepare("select * from tareas");
    $sentencia->execute();
    $tareas = $sentencia->fetchAll(PDO::FETCH_OBJ);
    return $tareas;
}

function addTarea($titulo, $descripcion, $prioridad){
    $db = getDB();
    $sentencia = $db->prepare("insert into tareas(titulo, descripcion, prioridad) values(?, ?, ?)");
    $sentencia->execute([$titulo, $descripcion, $prioridad]);

    return $db->lastInsertId();
}

function deleteTarea($id){
    $db = getDB();

    $sentencia = $db->prepare("delete from tareas where id = ?");
    $sentencia->execute([$id]);
}
function completeTarea($id){
     $db = getDB();

    $sentencia = $db->prepare("update tareas set finalizado = 1 where id = ?");
    $sentencia->execute([$id]);
}