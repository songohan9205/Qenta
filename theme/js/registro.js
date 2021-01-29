//Funciones necesarias al cargar la página (DataTable)
$(document).ready(function () {
    $(".filtab").DataTable(param_lang());

    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust()
            .responsive.recalc();
    });
});

//Función para validar si un campo viene nulo o no
function validarCampo(value) {
    if (value === null || value === "undefined" || value === "") {
        return false;
    }
    return true;
}

//Función con los parámetros de la tabla
function param_lang() {
    var params = {
        language: {
            lengthMenu: "Mostrar _MENU_ por página",
            zeroRecords: "No hay resultados",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "No hay resultados",
            infoFiltered: "(filtrando sobre _MAX_ registros)",
            search: "buscar",
            paginate: {
                first: "Primer",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            }
        },
        pageLength: 25,
        "bPaginate": false,
    };
    return params;
}

//Función que carga el mensaje mientras se buscan datos
function buscando() {
    swal.fire({
        title: "Buscando información...",
        text: "Por favor no actualice ni cierre la página",
        allowOutsideClick: false,
        allowEscapeKey: false,
        customClass: "swal-wide",
    });
    swal.showLoading();
}

//Función que carga el mensaje cuando no se han ingresado datos a la búsqueda
function error(titulo, texto, cierre) {
    Swal.fire({
        type: "error",
        title: titulo,
        text: texto,
        footer: "",
        customClass: "swal-wide",
    })
}

//Función que carga el mensaje cuando la búsqueda no arroja resultados
function vacio(titulo, texto) {
    Swal.fire({
        type: "error",
        title: titulo,
        text: texto,
        footer: "",
        customClass: "swal-wide",
    }).then((result) => {
        onClose: location.reload();
    });
}

//Función que crea la tabla al realizar la búsqueda por página o filtro de información
function generarTabla(datos, etiqueta) {
    $('#npag').text(etiqueta);
    $('#tabla_jug').DataTable().destroy();
    $('#tabla_jug').empty();
    $('#tabla_jug').html(
        '<thead>' +
        '<tr>' +
        '<th>ID</th>' +
        '<th>Nombre</th>' +
        '<th>Apellido</th>' +
        '<th>Talla</th>' +
        '<th>Pulgadas</th>' +
        '<th>Posición</th>' +
        '<th>Libras (peso)</th>' +
        '<th> </th>' +
        '</tr>' +
        '</thead>'
    );
    $("#tabla_jug").DataTable({
        data: datos['jugadores']['data'],
        columns: [
            { "name": "prueba", "data": "id" },
            { "data": "first_name" },
            { "data": "last_name" },
            { "data": "height_feet" },
            { "data": "height_inches" },
            { "data": "position" },
            { "data": "weight_pounds" },
            {
                "data": "id", render: function (data, type, full) {
                    return '<button type="button" class="btn btn-warning btn-xs" onclick="verDatos(' + data + ')">Ver datos</button></td>'
                }
            },
        ],
        "language": {
            "lengthMenu": "Mostrar _MENU_ por página",
            "zeroRecords": "No hay resultados",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "infoEmpty": "No hay resultados",
            "infoFiltered": "(filtrando sobre _MAX_ registros)",
            "search": "buscar",
            "paginate": {
                "first": "Primer",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        },
        "pageLength": 25,
        "bPaginate": false,
    });
}

//Función que ejecuta la búsqueda por página
function buscarPagina() {
    let pag = $('#pag').val();
    if (!validarCampo(pag)) {
        error('Campo vacío!', 'Debe ingresar un número de página', '');
        return false;
    }

    buscando();
    $.ajax({
        type: "POST",
        url: "welcome/buscarPagina",
        data: {
            pagina: pag
        },
        cache: false,
        success: function (result) {
            swal.close();
            dat = JSON.parse(result);
            if (dat['jugadores']['data'].length < 1) {
                vacio('¡Número de página vacío!', 'Intente con otro número de página, el ingresado no cuenta con información');
            }
            else {
                $('#clave').val('');
                generarTabla(dat, 'Página actual: ' + pag)
            }
        },
        error: function (request, status, error) {
            console.log(request.responseText);
        },
    });
}

//Función que consulta los datos del jugador por el ID y los carga en ventana modal
function verDatos(id) {
    buscando();
    let jugador = id;
    $.ajax({
        type: "POST",
        url: "welcome/datosJugador",
        data: {
            jugId: jugador,
        },
        cache: false,
        success: function (result) {
            swal.close();
            dat = JSON.parse(result);
            $('#modalJugador').modal('show');
            $('#nombre').text(dat['jugadores']['first_name'])
            $('#apellido').text(dat['jugadores']['last_name'])
            $('#talla').text(dat['jugadores']['height_feet'])
            $('#pulgadas').text(dat['jugadores']['height_inches'])
            $('#posicion').text(dat['jugadores']['position'])
            $('#libras').text(dat['jugadores']['weight_pounds'])
            $('#libras').text(dat['jugadores']['weight_pounds'])
            $('#nomEquipo').text(dat['jugadores']['team']['full_name'])
            $('#ciudad').text(dat['jugadores']['team']['city'])
            $('#conferencia').text(dat['jugadores']['team']['conference'])
            $('#division').text(dat['jugadores']['team']['division'])
            $('#abreviatura').text(dat['jugadores']['team']['abbreviation'])

        },
        error: function (request, status, error) {
            console.log(request.responseText);
        },
    });
}

//Función para el filtro de datos por nombre o apellido
function filtroDatos() {
    let clave = $('#clave').val();
    if (!validarCampo(clave)) {
        error('Campo vacío!', 'Debe ingresar una palabra para filtrar los datos', '');
        return false;
    }

    buscando();    
    $.ajax({
        type: "POST",
        url: "welcome/filtroDatos",
        data: {
            palabra: clave
        },
        cache: false,
        success: function (result) {
            swal.close();
            dat = JSON.parse(result);
            if (dat['jugadores']['data'].length < 1) {    
                vacio('¡No se encuentran coincidencias!', 'Intente con otra palabra');
            }
            else {
                $('#pag').val('');
                generarTabla(dat, 'Búsqueda por palabra clave: ' + clave)
            }
        },
        error: function (request, status, error) {
            console.log(request.responseText);
        },
    });
}