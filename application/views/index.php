<?php $this->load->view('head') ?>

<!-- Sección con el contenido principal de la página -->
<small class="text-primary"> Sección inicial </small>
<br><br>
<div class="form-group row">
    <div class="form-group col-sm-5">
        <div class="input-group mb-3">
            <label class="col-sm-12">Ingrese el número de página a buscar</label>
            <input type="number" class="form-control" min="1" max="25" id="pag" placeholder="1">
            <div class="input-group-append">
                <input class="btn btn-primary" type="button" value="Buscar datos" onclick="buscarPagina()">
            </div>
        </div>
    </div>
    <div class="col-sm-2"></div>
    <div class="form-group col-sm-5">
        <div class="input-group mb-3">
            <label class="col-sm-12">Buscar por nombres o apellidos</label>
            <input type="text" class="form-control" id="clave" placeholder="Ingrese palabra clave">
            <div class="input-group-append">
                <input class="btn btn-success" type="button" value="Filtrar datos" onclick="filtroDatos()">
            </div>
        </div>
    </div>
</div>
<small class="text-primary" id="npag">Página actual: 1</small>
<table class="filtab table table-hover" id="tabla_jug">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Talla</th>
            <th>Pulgadas</th>
            <th>Posición</th>
            <th>Libras (peso)</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($jugadores['data'] as $jug) : ?>
            <tr>
                <td><?php echo $jug['id'] ?></td>
                <td><?php echo $jug['first_name'] ?></td>
                <td><?php echo $jug['last_name'] ?></td>
                <td><?php echo $jug['height_feet'] ?></td>
                <td><?php echo $jug['height_inches'] ?></td>
                <td><?php echo $jug['position'] ?></td>
                <td><?php echo $jug['weight_pounds'] ?></td>
                <td><button type="button" class="btn btn-warning btn-xs" onclick="verDatos(<?php echo $jug['id'] ?>)">Ver datos</button></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>


<?php $this->load->view('script') ?>
<?php $this->load->view('modal') ?>