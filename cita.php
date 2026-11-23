<?php
/*
 * cita.php  —  FORMULARIO PARA PEDIR UNA CITA
 * -------------------------------------------------------------
 * Esta página hace DOS cosas, según cómo se abra:
 *
 *  - Si la persona la ABRE (método GET): muestra el formulario vacío.
 *  - Si la persona ENVÍA el formulario (método POST): PHP recibe los datos
 *    en la variable especial $_POST, los REVISA (validación) y responde:
 *       · si hay errores  → los muestra y deja los datos escritos para corregir;
 *       · si todo está bien → muestra un mensaje de confirmación.
 *
 * IMPORTANTE: en este proyecto de práctica la solicitud NO se guarda ni se envía
 * a nadie. Para guardarla se usaría una base de datos (por ejemplo MySQL).
 */
$titulo_pagina = 'Pedir cita';

require_once __DIR__ . '/includes/funciones.php';

$servicios = cargar_servicios();
$horarios  = ['Mañana', 'Tarde', 'Noche'];   // las únicas opciones permitidas
$errores   = [];                             // aquí iremos anotando los problemas
$enviado   = false;                          // ¿el formulario se envió bien?

// Valores iniciales de los campos. Si venimos de una página de servicio,
// el servicio ya viene elegido gracias a  ?servicio=3  en la dirección.
$datos = [
    'nombre'   => '',
    'correo'   => '',
    'servicio' => (int) ($_GET['servicio'] ?? 0),
    'fecha'    => '',
    'horario'  => '',
    'motivo'   => '',
    'acepta'   => '',
];

// ¿La persona presionó el botón "Enviar solicitud"? Entonces el método es POST.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 1. Recogemos lo que escribió. trim() quita espacios sobrantes al inicio y al final.
    $datos['nombre']   = trim($_POST['nombre'] ?? '');
    $datos['correo']   = trim($_POST['correo'] ?? '');
    $datos['servicio'] = (int) ($_POST['servicio'] ?? 0);
    $datos['fecha']    = trim($_POST['fecha'] ?? '');
    $datos['horario']  = $_POST['horario'] ?? '';
    $datos['motivo']   = trim($_POST['motivo'] ?? '');
    $datos['acepta']   = isset($_POST['acepta']) ? '1' : '';

    // 2. VALIDAMOS: revisamos cada campo y anotamos un error si algo está mal.
    if (mb_strlen($datos['nombre']) < 3) {
        $errores[] = 'Escribe tu nombre completo (mínimo 3 letras).';
    }

    if (!filter_var($datos['correo'], FILTER_VALIDATE_EMAIL)) {
        $errores[] = 'Escribe un correo válido, por ejemplo: nombre@correo.com.';
    }

    $servicio_elegido = buscar_servicio($datos['servicio'], $servicios);
    if ($servicio_elegido === null) {
        $errores[] = 'Elige un servicio de la lista.';
    }

    // La fecha debe existir de verdad (no 31 de febrero) y no puede ser pasada.
    $fecha = DateTime::createFromFormat('!Y-m-d', $datos['fecha']);
    if (!$fecha || $fecha->format('Y-m-d') !== $datos['fecha']) {
        $errores[] = 'Elige una fecha para tu cita.';
    } elseif ($fecha < new DateTime('today')) {
        $errores[] = 'La fecha no puede ser anterior a hoy.';
    }

    if (!in_array($datos['horario'], $horarios, true)) {
        $errores[] = 'Elige un horario: mañana, tarde o noche.';
    }

    if (mb_strlen($datos['motivo']) > 300) {
        $errores[] = 'El motivo es muy largo (máximo 300 caracteres).';
    }

    if ($datos['acepta'] !== '1') {
        $errores[] = 'Debes autorizar el tratamiento de tus datos personales.';
    }

    // 3. Si la lista de errores quedó vacía, ¡todo está bien!
    if (empty($errores)) {
        $enviado = true;
    }
}

require __DIR__ . '/includes/cabecera.php';
?>

<section class="seccion">
    <div class="contenedor contenedor-angosto">
        <h1>Pedir una cita</h1>

<?php if ($enviado) : ?>

        <?php mensaje_alerta('exito', '¡Listo, ' . $datos['nombre'] . '! Recibimos tu solicitud.'); ?>

        <div class="resumen">
            <h2>Resumen de tu solicitud</h2>
            <dl>
                <dt>Servicio</dt><dd><?= e($servicio_elegido['nombre']) ?></dd>
                <dt>Fecha preferida</dt><dd><?= e($fecha->format('d/m/Y')) ?></dd>
                <dt>Horario</dt><dd><?= e($datos['horario']) ?></dd>
                <dt>Correo de contacto</dt><dd><?= e($datos['correo']) ?></dd>
            </dl>
            <p class="nota">
                Esto es un proyecto de práctica: tu solicitud no se guarda ni se envía a nadie.
                En un sitio real, aquí llegaría un correo de confirmación.
            </p>
            <p class="botones">
                <a class="boton" href="servicios.php">Seguir viendo servicios</a>
                <a class="boton boton-secundario" href="cita.php">Hacer otra solicitud</a>
            </p>
        </div>

<?php else : ?>

        <p class="lead">Llena el formulario y te contactaremos para confirmar el horario. Los campos con * son obligatorios.</p>

        <?php if (!empty($errores)) : ?>
            <?php mensaje_alerta('error', 'Revisa estos datos antes de enviar:', $errores); ?>
        <?php endif; ?>

        <!-- novalidate: desactiva las revisiones del navegador para que se vea la validación de PHP -->
        <form class="formulario" method="post" action="cita.php" novalidate>

            <div class="campo">
                <label for="nombre">Nombre completo *</label>
                <input type="text" id="nombre" name="nombre" value="<?= e($datos['nombre']) ?>" autocomplete="name">
            </div>

            <div class="campo">
                <label for="correo">Correo electrónico *</label>
                <input type="email" id="correo" name="correo" value="<?= e($datos['correo']) ?>" autocomplete="email">
            </div>

            <div class="campo">
                <label for="servicio">Servicio *</label>
                <select id="servicio" name="servicio">
                    <option value="0">— Elige un servicio —</option>
                    <?php foreach ($servicios as $servicio) : ?>
                        <option value="<?= (int) $servicio['id'] ?>"
                            <?= $datos['servicio'] === $servicio['id'] ? 'selected' : '' ?>>
                            <?= e($servicio['nombre']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="campo">
                <label for="fecha">Fecha preferida *</label>
                <!-- min = hoy: el calendario no deja escoger días pasados -->
                <input type="date" id="fecha" name="fecha" value="<?= e($datos['fecha']) ?>" min="<?= date('Y-m-d') ?>">
            </div>

            <fieldset class="campo">
                <legend>Horario preferido *</legend>
                <div class="opciones">
                    <?php foreach ($horarios as $horario) : ?>
                        <label class="opcion">
                            <input type="radio" name="horario" value="<?= e($horario) ?>"
                                <?= $datos['horario'] === $horario ? 'checked' : '' ?>>
                            <?= e($horario) ?>
                        </label>
                    <?php endforeach; ?>
                </div>
            </fieldset>

            <div class="campo">
                <label for="motivo">Cuéntanos brevemente qué te gustaría trabajar (opcional)</label>
                <textarea id="motivo" name="motivo" rows="4" maxlength="300"><?= e($datos['motivo']) ?></textarea>
            </div>

            <div class="campo">
                <label class="opcion">
                    <input type="checkbox" name="acepta" value="1" <?= $datos['acepta'] === '1' ? 'checked' : '' ?>>
                    Autorizo el tratamiento de mis datos personales (Ley 1581 de 2012). *
                </label>
            </div>

            <button type="submit" class="boton">Enviar solicitud</button>
        </form>

<?php endif; ?>

    </div>
</section>

<?php require __DIR__ . '/includes/pie.php'; ?>
