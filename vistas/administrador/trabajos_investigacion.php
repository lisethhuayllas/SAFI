<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="estilos/administrador/trabajos_investigacion.css">
</head>
<body>
    <div class="cabecera_modulo">
        <div class="titulo_modulo">
            <h1>PROYECTOS</h1>
        </div>        
    </div>

    <div class="opciones-interaccion">
        <div class="seccion_buscador">
            <input type="text" class="input-busqueda" placeholder="Buscar por título" maxlength="200">
                <i class="fa-solid fa-magnifying-glass"></i>
            </input>
        </div>
    </div>

    <div class="seccion_tabla">
        <table>
            <thead>
                <th>TÍTULO</th>
                <th>AUTOR</th>
                <th>INFORME FINAL</th>
                <th>ACCIONES</th>
            </thead>

            <tbody id="contenido_tabla">

            </tbody>
        </table>
    </div>
    
    <script src="../scripts/PDF/base64js.min.js"></script>
    <script src="../scripts/administrador/trabajos_investigacion.js"></script>
</body>
</html>