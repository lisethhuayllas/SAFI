<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="estilos/administrador/tesistas.css">
</head>
<body>
    <div class="cabecera_tesistas">
        <div class="titulo_modulo">
            <h1>ASESORES</h1>
        </div>
        
        <div class="cantidad_coincidencias">
            <span><b><span id="coincidencias"></span></b> de un total de <b><span id="total"></span></b></span>
        </div>
        
        <div class="seccion_buscador">
            <input type="text" class="input_busqueda" placeholder="Buscar con DNI" maxlength="8">
                <i class="fa-solid fa-magnifying-glass"></i>
            </input>
        </div>
        
    </div>

    <div class="opciones-interaccion">
        <div class="modo_visualizacion">
            <a href="#" id="mostrar_todos_a">Todos los asesores</a>
            <a href="#" id="mostrar_sistemas_a">Ing. de sistemas</a>
            <a href="#" id="mostrar_ambiental_a">Ing. ambiental</a>
            <a href="#" id="mostrar_agroindustrial_a">Ing. agroindustrial</a>
        </div>

        <div class="seccion_agregar">
            <button id="boton_añadir">
                <i class="fa-solid fa-plus"></i>
                <b>AÑADIR</b>
            </button>
        </div>
    </div>

    <div class="seccion_tabla">
        <table id="tabla-asesores">
            <thead>
                <th>NOMBRE Y APELLIDOS</th>
                <th>CARRERA PROFESIONAL</th>
                <th>CANT. ASESORADOS</th>
                <th>ACCIONES</th>
            </thead>

            <tbody id="contenido_tabla">

            </tbody>
        </table>
    </div>    
    <script src="../scripts/administrador/asesores.js"></script>
</body>
</html>