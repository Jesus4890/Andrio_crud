<!DOCTYPE html>
<html>

<?php
    require_once "../src/master_page_top.php";

    $query = mysqli_query($conn,"SELECT id,nombre,apellido FROM socio");
    global $menu;
    $menu="";
    while($row = mysqli_fetch_array($query)){
        $menu.= "<option value=".$row['id'].">". $row['nombre']." ".$row['apellido'] . "</option>";
    }

    $query_consola = mysqli_query($conn,"SELECT id,id_tipo,serial FROM consola");
    global $menu_consola;
    $menu_consola="";
    while($row = mysqli_fetch_array($query_consola)){
        $nombreConsola = "";
        if($row['id_tipo'] == "1"){
            $nombreConsola = "Xbox One";
        }else if($row['id_tipo'] == "2"){
            $nombreConsola = "Nintendo Switch";
        }else if($row['id_tipo'] == "3"){
            $nombreConsola = "Play Station 4";
        }
        $menu_consola.= "<option value=".$row['id'].">". $nombreConsola." - ".$row['serial'] . "</option>";
    }

    $query_juego = mysqli_query($conn,"SELECT id,titulo FROM juego");
    global $menu_juego;
    $menu_juego="";
    while($row = mysqli_fetch_array($query_juego)){
        $menu_juego.= "<option value=".$row['id'].">".$row['titulo'] . "</option>";
    }
?>

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Renta</h3>   <!-- Titulo de la pagina-->
        </div>
        <form class="login100-form validate-form" action="../src/agregar_renta.php" method="POST">
            <div class="card-body">
                <div class="row">   <!-- Grupo de hora y fecha -->
                    <div class="col-lg-6p">
                        <div class="col-12">
                            <label for="R_hora">Hora:</label>
                            <input type="time" class="form-control" id="R_hora" name="R_hora" placeholder="">
                        </div>
                    </div>
                    <div class="col-lg-6p">
                        <div class="col-12">
                            <label for="R_fecha">Fecha:</label>
                            <input type="date" class="form-control" id="R_fecha" name="R_fecha" placeholder="">
                        </div>
                    </div>
                </div>
                <div class="row">   <!-- Lista de socios -->
                    <div class="col-lg-6p">
                        <label>Socio:</label>
                        <select class="custom-select" id="socio" name="socio" >
                            <?php
                                echo $menu;
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row">   <!-- Lista de consolas -->
                    <div class="col-lg-6p">
                        <label>Consola:</label>
                        <select class="custom-select" id="consola" name="consola">
                            <?php

                                echo $menu_consola;

                            ?>
                        </select>
                    </div>
                </div>
                <div class="row">  <!-- Lista de juegos -->
                    <div class="col-lg-6p">
                        <label>Juego:</label>
                        <select class="custom-select" id="juego" name="juego" >
                            <?php

                                echo $menu_juego;

                            ?>
                        </select>
                    </div>
                </div>
                <div class="row"> <!-- grupo de accesarios -->
                    <div class="col-lg-6p">
                        <div class="col-6">
                            <label for="R_controles">Controles:</label>
                            <input type="number" class="form-control" id="R_controles" name="R_controles" min="0" >
                        </div>
                    </div>
                    <div class="col-lg-6p">
                        <div class="col-6">
                            <label for="R_audifonos">Audifonos:</label>
                            <input type="number" class="form-control" id="R_audifonos" name="R_audifonos" min="0">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="button" id="btnCancelar" class="btn btn-danger">Cancelar</button>
            </div>
        </form>
    </div>

<?php
    require_once "../src/master_page_bottom.php";
?>
<script>
    document.getElementById('btnCancelar').addEventListener('click', function(evt) {
        history.back()
    });
</script>
</html>