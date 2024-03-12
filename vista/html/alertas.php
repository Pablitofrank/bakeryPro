<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificaciones de Stock</title>
    <style>
        .notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #f44336;
            color: white;
            padding: 15px;
            border-radius: 10px;
            z-index: 9999;
        }
    </style>
</head>
<body>

<!-- Contenedor para las notificaciones -->
<div id="notificationContainer"></div>

<script>
    // Función para crear una notificación emergente
    function createNotification(insumo, stock) {
        // Crear elemento de notificación
        var notification = document.createElement('div');
        notification.classList.add('notification');
        notification.innerHTML = 'El insumo ' + insumo + ' tiene un stock de ' + stock + ' unidades.';

        // Agregar notificación al contenedor
        document.getElementById('notificationContainer').appendChild(notification);

        // Eliminar la notificación después de 5 segundos
        setTimeout(function() {
            notification.remove();
        }, 5000);
    }

    // Función para obtener los insumos con stock por debajo de 20
    function checkStock() {
        fetch('get_stock.php')
        .then(response => response.json())
        .then(data => {
            // Verificar el stock de cada insumo
            data.forEach(insumo => {
                if (insumo.Stock < 20) {
                    createNotification(insumo.NombreInsumo, insumo.Stock);
                }
            });
        });
    }

    // Llamar a la función checkStock cada 5 segundos
    setInterval(checkStock, 5000);
</script>

</body>
</html>
