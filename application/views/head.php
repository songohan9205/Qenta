<!-- Cabecera con los llamados a las hojas de estilo -->

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Prueba Técnica</title>
  <link rel="shortcut icon" href="<?php echo site_url(); ?>theme/images/logo.jpg" />
  <link rel="stylesheet" href="<?php echo site_url(); ?>theme/css/style.css">
  <link rel="stylesheet" href="<?php echo site_url(); ?>theme/css/style_custom.css">
  <link rel="stylesheet" href="<?php echo site_url(); ?>theme/font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo site_url(); ?>theme/DataTables/datatables.min.css">
</head>

<!-- Apertura de la plantilla HTML -->
<body class="wrapper">
  <div class="card st_card">
    <div class="card-body">
      <div class="btn-group st_btn" role="group">
        <button type="button" class="btn btn-secondary" onclick="location.href='<?php echo base_url(); ?>'">Ir a Inicio</button>
        <button type="button" class="btn btn-secondary" onclick="location.href='<?php echo base_url(); ?>welcome/rutas?enlace=ejercicio1'">Ejercicio teórico 1</button>
        <button type="button" class="btn btn-secondary" onclick="location.href='<?php echo base_url(); ?>welcome/rutas?enlace=ejercicio2'">Ejercicio teórico 2</button>
        <a href="<?php echo base_url() ?>theme/Documentos/PruebaTeorica.pdf" target="_blank"><button type="button" class="btn btn-secondary">Respuestas</button></a>
      </div>
      <h2 class="subtitulo">PRUEBA TÉCNICA QENTA</h2>