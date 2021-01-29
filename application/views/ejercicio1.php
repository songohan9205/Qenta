<?php $this->load->view('head') ?>

<!-- Contenido del ejercicio 1 -->
<small class="text-primary"> Eejrcicio teórico 1</small>
<br><br>
<div class="separator-custom"></div>
<p class="card-description">
    Escribir un programa que recorra un arreglo y genere un histograma con base a los
    números de este. EL arreglo se llama miArreglo y contiene 10 elementos que
    corresponden a números enteros del 1 a 5. Un histograma representa que tanto un
    elemento aparece en un conjunto de datos (Debe mostrar la frecuencia para todos los
    números del 1 a 5, incluso si no están presentes en el arreglo). Por ejemplo, para el
    arreglo: miArreglo=[1,2,1,3,3,1,2,1,5,1] el histograma se vería así:<br>
    1: *****<br>
    2: **<br>
    3: **<br>
    4: <br>
    5: *<br>
    Observación: Notar espacio entre los “:” y el primer asterisco
    var miArreglo=[1,2,1,3,3,1,2,1,5,1]
</p>
<div class="separator-custom"></div>

<p class="card-description">
    <b>SOLUCIÓN:</b> 
    <a href="<?php echo base_url() ?>theme/Documentos/Ejercicio1.pdf" target="_blank"><span class="badge badge-pill badge-primary">Ver código ejercicio 1</span></a>
    <?php
        $miArreglo = [1, 2, 1, 3, 3, 1, 2, 1, 5, 1];
        $maximo    = max($miArreglo);
        for ($i = 1; $i <= $maximo; $i++) {
            ${'total' . $i} = '';
            for ($j = 0; $j < sizeof($miArreglo); $j++) {
                ($miArreglo[$j] === $i) ?  ${'total' . $i} .= '*' : '';
            }
            echo '<br>' . $i . ': ' . ${'total' . $i};
        }
    ?>
</p>

<?php $this->load->view('script') ?>
<?php $this->load->view('modal') ?>