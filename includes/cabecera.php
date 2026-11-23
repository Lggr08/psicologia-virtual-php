<?php
/*
 * includes/cabecera.php
 * -------------------------------------------------------------
 * COMPONENTE: CABECERA (la parte de ARRIBA de todas las páginas).
 *
 * Contiene: el inicio del documento HTML, el <head> (título y estilos),
 * el logo y el menú de navegación.
 *
 * Cada página la "pega" arriba con:  require __DIR__ . '/includes/cabecera.php';
 * Así el menú se escribe UNA sola vez y aparece en todas las páginas.
 *
 * La página que la llama puede definir antes la variable $titulo_pagina
 * para cambiar el título que se ve en la pestaña del navegador.
 */
require_once __DIR__ . '/funciones.php';

if (!isset($titulo_pagina)) {
    $titulo_pagina = 'Servicios de psicología virtual';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($titulo_pagina) ?> | Ánimo Virtual</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <a class="salto" href="#contenido">Saltar al contenido</a>

    <header class="cabecera">
        <div class="contenedor cabecera-interna">
            <a class="marca" href="index.php">
                <span class="marca-logo" aria-hidden="true">🌿</span> Ánimo Virtual
            </a>
            <nav class="menu" aria-label="Menú principal">
                <?php
                enlace_menu('index.php', 'Inicio');
                enlace_menu('servicios.php', 'Servicios');
                enlace_menu('cita.php', 'Pedir cita');
                ?>
            </nav>
        </div>
    </header>

    <main id="contenido">
