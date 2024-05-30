<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tareas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .finalizado {
            text-decoration: line-through;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Tareas</h1>
        <?php
        require_once 'db.php';

        function listarTareas()
        {
            $tareas = getTareas();
        ?>
            <ul class="list-group">
                <?php foreach ($tareas as $tarea) :
                    $classes = $tarea->finalizado ? 'finalizado' : '';
                ?>
                    <li class="list-group-item d-flex justify-content-between">

                        <span class="<?= $classes ?>">
                            <span class="badge text-bg-primary rounded-pill"><?= $tarea->prioridad ?></span>
                            <?= $tarea->titulo ?>
                        </span>
                        <div>
                            <a class="btn btn-danger" href="index.php?delete=<?= $tarea->id ?>">Eliminar</a> 
                            <?php if (!$tarea->finalizado) : ?>
                                | <a class="btn btn-info" href="index.php?complete=<?= $tarea->id ?>">Finalizar</a>
                            <?php endif; ?>
                        </div>

                    </li>
                <?php endforeach; ?>
            </ul>

        <?php
        }

        listarTareas();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo = $_POST['titulo'];
            $descripcion = $_POST['descripcion'];
            $prioridad = $_POST['prioridad'];

            addTarea($titulo, $descripcion, $prioridad);

            header('Location: index.php');
        }
        if (isset($_GET['delete'])) {
            deleteTarea($_GET['delete']);
            header('Location: index.php');
        }

        if (isset($_GET['complete'])) {
            completeTarea($_GET['complete']);
            header('Location: index.php');
        }

        ?>
        <form action="index.php" method="post">
            <div>
                <label for="titulo" class="form-label">Titulo</label>
                <input type="text" name="titulo" id="titulo" class="form-control">
            </div>
            <div>
                <label for="descripcion" class="form-label">Descripcion</label>
                <input type="text" name="descripcion" id="descripcion" class="form-control">
            </div>
            <div>
                <label for="prioridad" class="form-label">Prioridad</label>
                <select name="prioridad" id="prioridad" class="form-control">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Agregar</button>
        </form>
    </div>
</body>

</html>