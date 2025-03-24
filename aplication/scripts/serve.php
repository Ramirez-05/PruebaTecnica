<?php

echo "Servidor de desarrollo iniciado en http://localhost:8000\n";
echo "Presiona Ctrl+C para detenerlo\n\n";
passthru('php -S localhost:8000 -t public/');