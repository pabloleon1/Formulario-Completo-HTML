<?php
function print_value($key, $value) {
    $emoji = get_emoji_for_field($key);
    echo "<tr><th>$emoji " . htmlspecialchars($key) . "</th><td>";
    if (is_array($value)) {
        if (empty($value)) {
            echo "<span class='text-muted'>Ninguno seleccionado</span>";
        } else {
            echo htmlspecialchars(implode(", ", $value));
        }
    } else {
        if (empty($value)) {
            echo "<span class='text-muted'>No especificado</span>";
        } else {
            echo htmlspecialchars($value);
        }
    }
    echo "</td></tr>";
}

function get_emoji_for_field($field) {
    return '';
}

echo '<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Datos recibidos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap-5.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5 mb-5">
        <div class="card shadow">
            <div class="card-header bg-success text-white text-center py-4">
                <h1 class="mb-2">Datos recibidos exitosamente</h1>
            </div>
            <div class="card-body p-4">';
$post_count = count($_POST);
$get_count = count($_GET);
$files_count = count($_FILES);

echo '<h3 class="mb-3">Detalles de los datos recibidos:</h3>';
echo '<div class="table-responsive">';
echo '<table class="table table-bordered table-hover">';
echo '<thead class="table-dark"><tr><th>Campo</th><th>Valor</th></tr></thead><tbody>';

foreach ($_POST as $key => $value) {
    print_value($key, $value);
}
foreach ($_GET as $key => $value) {
    print_value($key, $value);
}
if (!empty($_FILES)) {
    foreach ($_FILES as $key => $file) {
        if (is_array($file["name"])) {
            foreach ($file["name"] as $i => $name) {
                echo "<tr><th>" . htmlspecialchars($key) . " (archivo " . ($i+1) . ")</th><td>" . htmlspecialchars($name) . "</td></tr>";
            }
        } else {
            echo "<tr><th>" . htmlspecialchars($key) . " (archivo)</th><td>" . htmlspecialchars($file["name"]) . "</td></tr>";
        }
    }
}

echo '</tbody></table></div>';

echo '<div class="text-center mt-4">
    <a href="index.html" class="btn btn-primary">
        Volver al formulario
    </a>
    <button onclick="window.print()" class="btn btn-outline-secondary ms-2">
        Imprimir
    </button>
</div>';

echo '</div></div></div></body></html>'; 