<?php
/*
 * index.php  —  PÁGINA DE INICIO
 * -------------------------------------------------------------
 * Es la primera página que ve la persona.
 *
 * Aquí PHP hace tres cosas:
 *  1. Define el título de la pestaña ($titulo_pagina).
 *  2. Trae la lista de servicios (cargar_servicios).
 *  3. Muestra los 3 primeros como "servicios destacados" usando un bucle (foreach).
 */
$titulo_pagina = 'Inicio';

require_once __DIR__ . '/includes/funciones.php';

$servicios  = cargar_servicios();
$destacados = array_slice($servicios, 0, 3);   // "array_slice" corta la lista: toma 3 desde la posición 0
$total      = count($servicios);               // "count" cuenta cuántos servicios hay

require __DIR__ . '/includes/cabecera.php';    // pega la CABECERA arriba
?>

<section class="hero">
    <div class="contenedor hero-interna">
        <div class="hero-texto">
            <p class="etiqueta etiqueta-clara">Psicología virtual</p>
            <h1>Cuida tu bienestar emocional, desde donde estés.</h1>
            <p class="hero-subtitulo">
                Conoce nuestros <?= (int) $total ?> servicios de psicología en línea y
                pide tu cita en pocos pasos.
            </p>
            <div class="botones">
                <a class="boton" href="servicios.php">Ver servicios</a>
                <a class="boton boton-secundario" href="cita.php">Pedir una cita</a>
            </div>
        </div>
        <div class="hero-visual" aria-hidden="true">
            <div class="burbuja">💬</div>
            <span class="chip-flotante chip-1">Desde casa</span>
            <span class="chip-flotante chip-2">Confidencial</span>
            <span class="chip-flotante chip-3">Horarios flexibles</span>
        </div>
    </div>
</section>

<section class="seccion">
    <div class="contenedor">
        <h2>Así de fácil funciona</h2>
        <ol class="pasos">
            <li class="paso">
                <span class="paso-numero">1</span>
                <h3>Elige un servicio</h3>
                <p>Mira el catálogo y filtra por categoría para encontrar lo que necesitas.</p>
            </li>
            <li class="paso">
                <span class="paso-numero">2</span>
                <h3>Pide tu cita</h3>
                <p>Llena un formulario corto con tu nombre, correo, fecha y horario preferido.</p>
            </li>
            <li class="paso">
                <span class="paso-numero">3</span>
                <h3>Conéctate</h3>
                <p>Recibe el enlace de la videollamada y asiste desde tu computador o celular.</p>
            </li>
        </ol>
    </div>
</section>

<section class="seccion seccion-clara">
    <div class="contenedor">
        <div class="seccion-encabezado">
            <h2>Servicios destacados</h2>
            <a class="enlace-flecha" href="servicios.php">Ver todos los servicios →</a>
        </div>
        <div class="tarjetas">
            <?php foreach ($destacados as $servicio) : ?>
                <?php tarjeta_servicio($servicio); ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/pie.php'; ?>
