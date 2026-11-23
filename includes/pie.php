<?php
/*
 * includes/pie.php
 * -------------------------------------------------------------
 * COMPONENTE: PIE DE PÁGINA (la parte de ABAJO de todas las páginas).
 *
 * Cierra lo que abrió la cabecera (</main>, </body>, </html>) y muestra
 * el aviso de ayuda con las líneas de atención.
 *
 * Cada página la "pega" al final con:  require __DIR__ . '/includes/pie.php';
 */
?>
    </main>

    <footer class="pie">
        <div class="contenedor pie-interna">
            <div>
                <p class="pie-marca"><span aria-hidden="true">🌿</span> Ánimo Virtual</p>
                <p>Proyecto académico de práctica (SENA). Los servicios, textos y precios son de ejemplo y el sitio no ofrece atención real.</p>
            </div>
            <div class="aviso-ayuda">
                <p><strong>¿Necesitas ayuda ahora?</strong></p>
                <p>Marca la <strong>Línea 106</strong> (gratuita, confidencial y disponible las 24 horas) o, si hay una emergencia, la <strong>línea 123</strong>.</p>
                <p class="pie-nota">Este sitio no reemplaza una consulta profesional.</p>
            </div>
        </div>
    </footer>
</body>
</html>
