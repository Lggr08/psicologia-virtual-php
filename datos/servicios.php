<?php
/*
 * datos/servicios.php
 * -------------------------------------------------------------
 * AQUÍ GUARDAMOS LOS SERVICIOS.
 *
 * Un "arreglo" (array) es como una caja con compartimentos.
 * Cada servicio es una cajita con sus datos: nombre, categoría, precio, etc.
 * Todas las cajitas juntas forman la lista de servicios.
 *
 * "return" significa: "entrega esta lista a quien me llame".
 * (Las páginas la piden con la función cargar_servicios()).
 *
 * Para AGREGAR un servicio nuevo: copia un bloque completo (desde [ hasta ],),
 * pégalo al final, cambia el 'id' por un número que no se repita y edita los textos.
 *
 * Nota: los precios son VALORES DE EJEMPLO para el proyecto de clase.
 * Si el precio es null, el sitio muestra "Cotización a la medida".
 */
return [
    [
        'id'          => 1,
        'nombre'      => 'Terapia individual en línea',
        'categoria'   => 'Individual',
        'icono'       => '🧠',
        'resumen'     => 'Un espacio privado para hablar de lo que te preocupa con un psicólogo, desde tu casa.',
        'descripcion' => 'Sesiones uno a uno por videollamada para trabajar emociones, hábitos y decisiones importantes. En la primera sesión se conoce tu situación y se acuerdan objetivos claros.',
        'duracion'    => '50 minutos',
        'modalidad'   => 'Videollamada',
        'precio'      => 80000,
        'para_quien'  => 'Adultos',
        'incluye'     => [
            'Primera sesión de valoración',
            'Plan de trabajo con objetivos',
            'Tareas sencillas para practicar entre sesiones',
        ],
    ],
    [
        'id'          => 2,
        'nombre'      => 'Terapia de pareja en línea',
        'categoria'   => 'Pareja y familia',
        'icono'       => '💞',
        'resumen'     => 'Mejora la comunicación y resuelve conflictos con apoyo profesional, sin salir de casa.',
        'descripcion' => 'Sesiones por videollamada para que ambas personas puedan expresarse, escucharse y acordar cambios concretos. Se necesita una conexión estable y un lugar tranquilo.',
        'duracion'    => '60 minutos',
        'modalidad'   => 'Videollamada',
        'precio'      => 100000,
        'para_quien'  => 'Parejas',
        'incluye'     => [
            'Sesión inicial con ambos integrantes',
            'Ejercicios de comunicación',
            'Acuerdos por escrito al final de cada ciclo',
        ],
    ],
    [
        'id'          => 3,
        'nombre'      => 'Orientación para adolescentes',
        'categoria'   => 'Niñez y adolescencia',
        'icono'       => '🌱',
        'resumen'     => 'Acompañamiento para el estrés escolar, las emociones y las relaciones, con apoyo de la familia.',
        'descripcion' => 'Sesiones por videollamada pensadas para jóvenes de 12 a 17 años. Un adulto responsable autoriza el servicio y participa en la sesión inicial.',
        'duracion'    => '45 minutos',
        'modalidad'   => 'Videollamada (con acudiente)',
        'precio'      => 70000,
        'para_quien'  => 'Jóvenes de 12 a 17 años',
        'incluye'     => [
            'Sesión inicial con el acudiente',
            'Actividades cortas y dinámicas',
            'Recomendaciones para la familia',
        ],
    ],
    [
        'id'          => 4,
        'nombre'      => 'Programa de manejo de ansiedad y estrés',
        'categoria'   => 'Programas',
        'icono'       => '🌿',
        'resumen'     => 'Seis sesiones guiadas con técnicas prácticas para calmar la mente y el cuerpo.',
        'descripcion' => 'Un programa corto y ordenado: aprenderás a reconocer lo que te estresa, técnicas de respiración, organización del tiempo y hábitos de descanso.',
        'duracion'    => '6 sesiones de 50 minutos',
        'modalidad'   => 'Videollamada',
        'precio'      => 420000,
        'para_quien'  => 'Mayores de 18 años',
        'incluye'     => [
            'Cuaderno de trabajo digital',
            'Audios de respiración guiada',
            'Seguimiento al terminar el programa',
        ],
    ],
    [
        'id'          => 5,
        'nombre'      => 'Taller de mindfulness y respiración',
        'categoria'   => 'Talleres grupales',
        'icono'       => '🧘',
        'resumen'     => 'Aprende a pausar y a respirar con calma en un grupo pequeño.',
        'descripcion' => 'Taller práctico en grupo reducido (máximo 12 personas) por videollamada. Se practican ejercicios de atención plena y respiración que puedes usar a diario.',
        'duracion'    => '90 minutos',
        'modalidad'   => 'Videollamada grupal',
        'precio'      => 35000,
        'para_quien'  => 'Público en general',
        'incluye'     => [
            'Ejercicios guiados en vivo',
            'Guía en PDF con los ejercicios',
            'Resolución de dudas al final',
        ],
    ],
    [
        'id'          => 6,
        'nombre'      => 'Grupo de apoyo en duelo',
        'categoria'   => 'Talleres grupales',
        'icono'       => '🕊️',
        'resumen'     => 'Un espacio seguro para compartir la pérdida de un ser querido, acompañado.',
        'descripcion' => 'Encuentros semanales por videollamada, conducidos por una psicóloga, donde cada persona participa a su ritmo. No es obligatorio hablar.',
        'duracion'    => '75 minutos por encuentro',
        'modalidad'   => 'Videollamada grupal',
        'precio'      => 40000,
        'para_quien'  => 'Adultos',
        'incluye'     => [
            'Encuentros semanales',
            'Normas de respeto y confidencialidad',
            'Lecturas y ejercicios opcionales',
        ],
    ],
    [
        'id'          => 7,
        'nombre'      => 'Orientación vocacional y proyecto de vida',
        'categoria'   => 'Programas',
        'icono'       => '🧭',
        'resumen'     => 'Descubre tus intereses y habilidades para elegir qué estudiar o a qué dedicarte.',
        'descripcion' => 'Cuatro sesiones para explorar gustos, fortalezas y metas, conocer opciones de estudio o trabajo y armar un plan de acción realista.',
        'duracion'    => '4 sesiones de 50 minutos',
        'modalidad'   => 'Videollamada',
        'precio'      => 260000,
        'para_quien'  => 'Jóvenes y adultos',
        'incluye'     => [
            'Test de intereses en línea',
            'Informe con recomendaciones',
            'Plan de acción a 6 meses',
        ],
    ],
    [
        'id'          => 8,
        'nombre'      => 'Bienestar emocional para equipos de trabajo',
        'categoria'   => 'Empresas',
        'icono'       => '🏢',
        'resumen'     => 'Talleres virtuales para reducir el estrés y mejorar la comunicación en tu empresa.',
        'descripcion' => 'Charlas y talleres en vivo para equipos: manejo del estrés laboral, comunicación asertiva y pausas para el descanso mental. Se adapta al tamaño y a las necesidades del equipo.',
        'duracion'    => '2 horas',
        'modalidad'   => 'Videollamada grupal',
        'precio'      => null,   // null = sin precio fijo: se cotiza
        'para_quien'  => 'Equipos de trabajo',
        'incluye'     => [
            'Conversación inicial con la empresa',
            'Taller en vivo con material digital',
            'Informe con recomendaciones',
        ],
    ],
];
