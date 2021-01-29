<?php $this->load->view('head') ?>

<!-- Contenido del ejercicio 1 -->
<small class="text-primary"> Eejrcicio teórico 2</small>
<br><br>
<div class="separator-custom"></div>
<p class="card-description">
Se tiene una X en la esquina superior izquierda de un área de 4x4. Se tiene una matriz con 10 elementos. 
Cada 2 elementos de la matriz corresponden a un movimiento, el primero en el eje horizontal y el segundo en el eje vertical. 
EL número indica las unidades a moverse y el signo la dirección (positivo para derecha o abajo, negativo para izquierda o arriba)<br><br>
Por ejemplo, para la matriz miArreglo=[1,2,-1,1,0,1,2,-1,-1,-2]<br><br>
La X se moverá una unidad a la derecha y dos hacia abajo, luego una unidad a la izquierda y una abajo y así sucesivamente. El programa a escribir debe imprimir la posición final de la X. Para representar los lugares donde la X no se encuentra utilizar la letra O. Si la instrucción obliga a la X a salir del área de 4x4 la X permanecerá en el borde, sin salir. Para el arreglo presentado el resultado se vería así:<br><br>
OXOO<br>
OOOO<br>
OOOO<br>
OOOO<br>
</p>
<div class="separator-custom"></div>

<p class="card-description">
    <b>SOLUCIÓN:</b> 
    <a href="<?php echo base_url() ?>theme/Documentos/Ejercicio2.pdf" target="_blank"><span class="badge badge-pill badge-primary">Ver código ejercicio 2</span></a>
    <br>
    <?php
        $miArreglo = [1, 2, -1, 1, 0, 1, 2, -1, -1, -2];
        $hubc = 0;
        $vubc = 0;
        /* Creación de la matriz */
        for ($i = 0; $i < 4; $i++) {
            $horiz[$i] = 'O';
            for ($j = 0; $j < 4; $j++) {
                $horiz[$i][$j] = 'O';
            }
        }

        /* For para recorrer la posición de la matriz */
        for($k = 0; $k <sizeof($miArreglo); $k++) {
            if($k % 2 == 0) {
                (isset($vubc) ? $horiz[$vubc][$hubc] = 'O': '');
                $hubc = $hubc + $miArreglo[$k];
                ($hubc > $i) ? $hubc = $hubc - $miArreglo[$k] : '' ;
            }
            else {
                $vubc = $vubc + $miArreglo[$k];
                ($vubc >= $i) ? $vubc = $vubc - $miArreglo[$k] : '';
                $horiz[$vubc][$hubc] = 'X';
            }
        }

        /* Impresión de la matriz */
        echo '<br>';
        for ($i = 0; $i < 4; $i++) {            
            for ($j = 0; $j < 4; $j++) {
                echo $horiz[$i][$j].' ';
            }
            echo '<br>';
        }
    ?>
</p>

<?php $this->load->view('script') ?>
<?php $this->load->view('modal') ?>