<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="estilos/administrador/resoluciones.css">
</head>
<body>
    <div class="cabecera_modulo">
        <div class="titulo_modulo">
            <h1>RESOLUCIONES</h1>
        </div>        
    </div>
    
    <div class="seccion-buscar-cargar">
        <div class="seccion-buscar">
            <input type="text" class="input-busqueda" placeholder="Buscar por número de resolución" maxlength="8">
                <i class="fa-solid fa-magnifying-glass"></i>
            </input>
        </div>
        
        <div class="seccion-cargar">           
            <button id="botonCargar">
                <i class="fa-solid fa-cloud-arrow-up"></i>
                CARGAR
            </button>
        </div>
    </div>
    
    <div class="seccion-tabla">
        <table>
            <thead>
                <th>NÚMERO</th>
                <th>TIPO</th>
                <th>FECHA DE CARGA</th>
                <th>ACCIONES</th>
            </thead>

            <tbody id="contenido_tabla">
                
            </tbody>
        </table>
    </div>
    <script src="../scripts/PDF/base64js.min.js"></script>
    <script src="../scripts/administrador/resoluciones.js"></script>
</body>
</html>