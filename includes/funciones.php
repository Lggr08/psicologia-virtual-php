<?php
/*
 * includes/funciones.php
 * -------------------------------------------------------------
 * AQUÍ VIVEN LOS "AYUDANTES" DEL SITIO.
 *
 * Una función es una mini-receta con nombre. La escribimos UNA vez y la
 * podemos usar muchas veces, desde cualquier página, solo diciendo su nombre.
 *
 * Varias de estas funciones son COMPONENTES FRONT-END: piezas de pantalla
 * que se reutilizan (la tarjeta de servicio, el enlace del menú y los
 * mensajes de alerta).
 */

// Le decimos a PHP en qué zona horaria estamos, para que "hoy" sea la fecha de Colombia.
date_default_timezone_set('America/Bogota');

/**
 * e()  =  "escapar" el texto.
 * Cambia símbolos especiales (< > " ') por texto inofensivo.
 * Así, si alguien escribe código malicioso en el formulario, el navegador
 * lo muestra como texto normal y NO lo ejecuta. Es una medida de seguridad.
 */
function e($texto)
{
    return htmlspecialchars((string) $texto, ENT_QUOTES, 'UTF-8');
}

/**
 * Trae la lista de servicios desde el archivo datos/servicios.php.
 */
function cargar_servicios()
{
    return require __DIR__ . '/../datos/servicios.php';
}

/**
 * Busca UN servicio por su número (id). Si no existe, devuelve null (nada).
 */
function buscar_servicio($id, $servicios)
{
    foreach ($servicios as $servicio) {          // revisa uno por uno...
        if ($servicio['id'] === $id) {           // ...¿es el que busco?
            return $servicio;                    // ¡sí! lo entrego
        }
    }
    return null;                                 // no lo encontré
}

/**
 * Saca la lista de categorías sin repetir (Individual, Programas, etc.).
 */
function categorias_disponibles($servicios)
{
    return array_values(array_unique(array_column($servicios, 'categoria')));
}

/**
 * Convierte 80000 en "$ 80.000 COP". Si no hay precio (null) avisa que se cotiza.
 */
function formatear_precio($valor)
{
    if ($valor === null) {
        return 'Cotización a la medida';
    }
    return '$ ' . number_format($valor, 0, ',', '.') . ' COP';
}

/**
 * Dice en qué página estamos (para pintar de otro color el menú activo).
 * Cuando estamos en un servicio individual, marcamos "Servicios" en el menú.
 */
function pagina_actual()
{
    $pagina = basename($_SERVER['PHP_SELF']);
    return ($pagina === 'servicio.php') ? 'servicios.php' : $pagina;
}

/* =================================================================
 * COMPONENTES (piezas de pantalla reutilizables)
 * ================================================================= */

/**
 * COMPONENTE: enlace del menú.
 * Si el enlace apunta a la página donde estamos, se marca como "activo".
 */
function enlace_menu($archivo, $texto)
{
    $activo = (pagina_actual() === $archivo) ? ' class="activo" aria-current="page"' : '';
    echo '<a href="' . e($archivo) . '"' . $activo . '>' . e($texto) . '</a>';
}

/**
 * COMPONENTE: tarjeta de servicio.
 * Recibe los datos de UN servicio y dibuja su tarjeta.
 * Se usa en la página de inicio, en el catálogo y en "servicios relacionados".
 */
function tarjeta_servicio($servicio)
{
    ?>
    <article class="tarjeta">
        <div class="tarjeta-icono" aria-hidden="true"><?= e($servicio['icono']) ?></div>
        <span class="etiqueta"><?= e($servicio['categoria']) ?></span>
        <h3><?= e($servicio['nombre']) ?></h3>
        <p><?= e($servicio['resumen']) ?></p>
        <ul class="datos-rapidos">
            <li><span aria-hidden="true">⏱️</span> <?= e($servicio['duracion']) ?></li>
            <li><span aria-hidden="true">💻</span> <?= e($servicio['modalidad']) ?></li>
        </ul>
        <p class="precio"><?= e(formatear_precio($servicio['precio'])) ?></p>
        <a class="boton boton-secundario" href="servicio.php?id=<?= (int) $servicio['id'] ?>">
            Ver detalles<span class="solo-lectores"> de <?= e($servicio['nombre']) ?></span>
        </a>
    </article>
    <?php
}

/**
 * COMPONENTE: mensaje de alerta (de error o de éxito).
 * $tipo   = 'error' o 'exito'
 * $titulo = frase principal
 * $lista  = (opcional) lista de detalles, por ejemplo los errores del formulario
 */
function mensaje_alerta($tipo, $titulo, $lista = [])
{
    ?>
    <div class="alerta alerta-<?= e($tipo) ?>" role="<?= $tipo === 'error' ? 'alert' : 'status' ?>">
        <strong><?= e($titulo) ?></strong>
        <?php if (!empty($lista)) : ?>
            <ul>
                <?php foreach ($lista as $item) : ?>
                    <li><?= e($item) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
    <?php
}
