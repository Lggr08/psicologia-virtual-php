<?php
/*
 * servicio.php  —  DETALLE DE UN SERVICIO
 * -------------------------------------------------------------
 * Muestra TODA la información de un solo servicio.
 * Se abre así:  servicio.php?id=3   (el número es el id del servicio)
 *
 * Pasos:
 *  1. Leer el id que viene en la dirección ($_GET).
 *  2. Buscar ese servicio en la lista.
 *  3. Si existe lo mostramos; si no, mostramos un aviso de "no encontrado".
 */
require_once __DIR__ . '/includes/funciones.php';

$servicios = cargar_servicios();

// filter_input revisa que el id sea un número entero. Si no lo es, devuelve null o false.
$id       = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$servicio = $id ? buscar_servicio($id, $servicios) : null;

if ($servicio === null) {
    http_response_code(404);                       // 404 = "no encontrado" (el código estándar de la web)
    $titulo_pagina = 'Servicio no encontrado';
} else {
    $titulo_pagina = $servicio['nombre'];
}

require __DIR__ . '/includes/cabecera.php';
?>

<section class="seccion">
    <div class="contenedor">

<?php if ($servicio === null) : ?>

        <?php mensaje_alerta('error', 'No encontramos ese servicio.'); ?>
        <p><a class="boton" href="servicios.php">Volver al catálogo</a></p>

<?php else : ?>

        <p class="migas"><a href="servicios.php">← Todos los servicios</a></p>

        <article class="detalle">
            <header class="detalle-cabecera">
                <div class="detalle-icono" aria-hidden="true"><?= e($servicio['icono']) ?></div>
                <div>
                    <span class="etiqueta"><?= e($servicio['categoria']) ?></span>
                    <h1><?= e($servicio['nombre']) ?></h1>
                </div>
            </header>

            <p class="lead"><?= e($servicio['descripcion']) ?></p>

            <!-- COMPONENTE: cuadros con los datos rápidos -->
            <dl class="datos-grid">
                <div class="dato"><dt>Duración</dt><dd><?= e($servicio['duracion']) ?></dd></div>
                <div class="dato"><dt>Modalidad</dt><dd><?= e($servicio['modalidad']) ?></dd></div>
                <div class="dato"><dt>Dirigido a</dt><dd><?= e($servicio['para_quien']) ?></dd></div>
                <div class="dato"><dt>Valor de ejemplo</dt><dd><?= e(formatear_precio($servicio['precio'])) ?></dd></div>
            </dl>

            <h2>¿Qué incluye?</h2>
            <ul class="lista-check">
                <?php foreach ($servicio['incluye'] as $item) : ?>
                    <li><?= e($item) ?></li>
                <?php endforeach; ?>
            </ul>

            <p class="botones">
                <!-- Llevamos el id del servicio al formulario para que ya venga elegido -->
                <a class="boton" href="cita.php?servicio=<?= (int) $servicio['id'] ?>">Solicitar este servicio</a>
                <a class="boton boton-secundario" href="servicios.php">Ver otros servicios</a>
            </p>
        </article>

        <?php
        // Servicios relacionados: los de la misma categoría, sin contar este mismo.
        $relacionados = array_filter($servicios, function ($otro) use ($servicio) {
            return $otro['categoria'] === $servicio['categoria'] && $otro['id'] !== $servicio['id'];
        });
        ?>
        <?php if (!empty($relacionados)) : ?>
            <h2 class="separado">También te puede interesar</h2>
            <div class="tarjetas">
                <?php foreach ($relacionados as $otro) : ?>
                    <?php tarjeta_servicio($otro); ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

<?php endif; ?>

    </div>
</section>

<?php require __DIR__ . '/includes/pie.php'; ?>
