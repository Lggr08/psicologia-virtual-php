<?php
/*
 * servicios.php  —  CATÁLOGO DE SERVICIOS (con filtro por categoría)
 * -------------------------------------------------------------
 * Esta página muestra todas las tarjetas de servicios.
 * Si en la dirección viene  ?categoria=Individual  solo muestra esa categoría.
 *
 * Idea clave: la dirección (URL) puede llevar "recados" para PHP.
 * PHP los lee con la variable especial  $_GET.
 */
$titulo_pagina = 'Servicios';

require_once __DIR__ . '/includes/funciones.php';

$servicios  = cargar_servicios();
$categorias = categorias_disponibles($servicios);

// 1. Leemos el recado de la dirección. Si no viene nada, usamos '' (vacío = todos).
$categoria_elegida = $_GET['categoria'] ?? '';

// 2. SEGURIDAD: solo aceptamos categorías que existen en nuestra lista.
//    Si alguien escribe una inventada en la dirección, la ignoramos.
if (!in_array($categoria_elegida, $categorias, true)) {
    $categoria_elegida = '';
}

// 3. Filtramos: nos quedamos solo con los servicios de esa categoría.
if ($categoria_elegida !== '') {
    $mostrados = array_filter($servicios, function ($servicio) use ($categoria_elegida) {
        return $servicio['categoria'] === $categoria_elegida;
    });
} else {
    $mostrados = $servicios;
}

// 4. Contamos cuántos servicios tiene cada categoría (para mostrarlo en los botones).
$conteo = array_count_values(array_column($servicios, 'categoria'));

require __DIR__ . '/includes/cabecera.php';
?>

<section class="seccion">
    <div class="contenedor">
        <h1>Nuestros servicios</h1>
        <p class="lead">Todos se hacen en línea. Elige una categoría para ver menos opciones.</p>

        <!-- COMPONENTE: filtro de categorías -->
        <nav class="filtros" aria-label="Filtrar por categoría">
            <a class="chip<?= $categoria_elegida === '' ? ' activo' : '' ?>" href="servicios.php">
                Todos (<?= count($servicios) ?>)
            </a>
            <?php foreach ($categorias as $categoria) : ?>
                <a class="chip<?= $categoria_elegida === $categoria ? ' activo' : '' ?>"
                   href="servicios.php?<?= e(http_build_query(['categoria' => $categoria])) ?>">
                    <?= e($categoria) ?> (<?= (int) $conteo[$categoria] ?>)
                </a>
            <?php endforeach; ?>
        </nav>

        <p class="resultado" aria-live="polite">
            <?php if ($categoria_elegida === '') : ?>
                Mostrando los <?= count($mostrados) ?> servicios.
            <?php else : ?>
                Mostrando <?= count($mostrados) ?>
                <?= count($mostrados) === 1 ? 'servicio' : 'servicios' ?>
                en la categoría <strong><?= e($categoria_elegida) ?></strong>.
            <?php endif; ?>
        </p>

        <div class="tarjetas">
            <?php foreach ($mostrados as $servicio) : ?>
                <?php tarjeta_servicio($servicio); ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/pie.php'; ?>
