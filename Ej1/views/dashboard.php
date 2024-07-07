<!DOCTYPE html>
<html lang='es'>
<head>
    <?php require_once('./html/head.php') ?>
    <link href='../public/lib/calendar/lib/main.css' rel='stylesheet' />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <style>
        .custom-flatpickr {
            display: flex;
            align-items: center;
        }

        .custom-flatpickr input {
            margin-right: 5px;
            flex: 1;
        }
    </style>
</head>
<body>
    <div class='container-xxl position-relative bg-white d-flex p-0'>
        <!-- Spinner Start -->
        <div id='spinner' class='show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center'>
            <div class='spinner-border text-primary' style='width: 3rem; height: 3rem;' role='status'>
                <span class='sr-only'>Cargando...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Sidebar Start -->
        <?php require_once('./html/menu.php') ?>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class='content'>
            <!-- Navbar Start -->
            <?php require_once('./html/header.php') ?>
            <!-- Navbar End -->

            <!-- Lista de Productos -->
            <div class='container-fluid pt-4 px-4'>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalProducto">
                    Nuevo Producto
                </button>
                <div class='d-flex align-items-center justify-content-between mb-4'>
                    <h6 class='mb-0'>Lista de Productos</h6>
                </div>

                <table class="table table-bordered table-striped table-hover table-responsive">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="cuerpoProductos">
                        <!-- Aquí se cargarán los productos dinámicamente -->
                    </tbody>
                </table>
            </div>
            <!-- Fin Lista de Productos -->

            <!-- Modal Nuevo Producto -->
            <div class="modal fade" id="modalProducto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nuevo Producto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formNuevoProducto">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" name="nombre" id="nombre" placeholder=" " class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="precio">Precio</label>
                                    <input type="number" name="precio" id="precio" placeholder=" " class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="stock">Stock</label>
                                    <input type="number" name="stock" id="stock" placeholder=" " class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Fin Modal Nuevo Producto -->

            <!-- Modal Edición de Producto -->
            <div class="modal fade" id="modalEditarProducto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Producto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formEditarProducto">
                            <div class="modal-body">
                                <input type="hidden" name="idProducto" id="idProducto">
                                <div class="form-group">
                                    <label for="nombreEditar">Nombre</label>
                                    <input type="text" name="nombreEditar" id="nombreEditar" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="precioEditar">Precio</label>
                                    <input type="number" name="precioEditar" id="precioEditar" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="stockEditar">Stock</label>
                                    <input type="number" name="stockEditar" id="stockEditar" class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Fin Modal Edición de Producto -->

            <!-- JavaScript Libraries -->
            <?php require_once('./html/scripts.php') ?>
            <script src="./dashboard.js"></script>
            <script>
                $(document).ready(function() {
                    cargarProductos();

                    function cargarProductos() {
                        $.ajax({
                            url: '../controllers/producto.controllers.php?op=todos',
                            type: 'GET',
                            dataType: 'json',
                            success: function(response) {
                                if (response && response !== "No se encontraron productos.") {
                                    var cuerpoProductos = $('#cuerpoProductos');
                                    cuerpoProductos.empty();
                                    $.each(response, function(index, producto) {
                                        var fila = '<tr data-id="' + producto.id + '">' +
                                            '<td>' + producto.id + '</td>' +
                                            '<td>' + producto.nombre + '</td>' +
                                            '<td>' + producto.precio + '</td>' +
                                            '<td>' + producto.stock + '</td>' +
                                            '<td>' +
                                            '<button class="btn btn-sm btn-warning btn-editar" data-id="' + producto.id + '">Editar</button>' +
                                            '<button class="btn btn-sm btn-danger btn-eliminar ms-2" data-id="' + producto.id + '">Eliminar</button>' +
                                            '</td>' +
                                            '</tr>';
                                        cuerpoProductos.append(fila);
                                    });
                                } else {
                                    alert('Error al cargar los productos.');
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                                alert('Error al cargar los productos.');
                            }
                        });
                    }

                    $('#formNuevoProducto').submit(function(event) {
                        event.preventDefault();
                        var nombre = $('#nombre').val();
                        var precio = $('#precio').val();
                        var stock = $('#stock').val();

                        $.ajax({
                            url: '../controllers/producto.controllers.php?op=insertar',
                            type: 'POST',
                            data: {
                                nombre: nombre,
                                precio: precio,
                                stock: stock
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response === "ok") {
                                    $('#modalProducto').modal('hide');
                                    cargarProductos();
                                    $('#formNuevoProducto')[0].reset();
                                } else {
                                    alert('Error al insertar producto: ' + response);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                                alert('Error de conexión al servidor');
                            }
                        });
                    });

                    $('#cuerpoProductos').on('click', '.btn-editar', function() {
                        var idProducto = $(this).data('id');

                        $.ajax({
                            url: '../controllers/producto.controllers.php?op=detalle&id=' + idProducto,
                            type: 'GET',
                            dataType: 'json',
                            success: function(response) {
                                if (response) {
                                    $('#idProducto').val(response.id);
                                    $('#nombreEditar').val(response.nombre);
                                    $('#precioEditar').val(response.precio);
                                    $('#stockEditar').val(response.stock);

                                    $('#modalEditarProducto').modal('show');
                                } else {
                                    alert('No se pudo obtener los detalles del producto.');
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                                alert('Error al obtener detalles del producto.');
                            }
                        });
                    });

                    $('#formEditarProducto').submit(function(event) {
                        event.preventDefault();
                        
                        var idProducto = $('#idProducto').val();
                        var nombre = $('#nombreEditar').val();
                        var precio = $('#precioEditar').val();
                        var stock = $('#stockEditar').val();

                        $.ajax({
                            url: '../controllers/producto.controllers.php?op=actualizar',
                            type: 'POST',
                            data: {
                                id: idProducto,
                                nombre: nombre,
                                precio: precio,
                                stock: stock
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response && response !== "Error al obtener el producto actualizado.") {
                                    // Actualizar la fila correspondiente en la tabla
                                    var fila = $('#cuerpoProductos').find('tr[data-id="' + idProducto + '"]');
                                    fila.find('td:nth-child(2)').text(response.nombre);
                                    fila.find('td:nth-child(3)').text(response.precio);
                                    fila.find('td:nth-child(4)').text(response.stock);
                                    
                                    $('#modalEditarProducto').modal('hide');
                                } else {
                                    alert('Error al actualizar producto: ' + response);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                                alert('Error de conexión al servidor');
                            }
                        });
                    });

                    $('#cuerpoProductos').on('click', '.btn-eliminar', function() {
                        var idProducto = $(this).data('id');
                        if (confirm("¿Está seguro que desea eliminar este producto?")) {
                            $.ajax({
                                url: '../controllers/producto.controllers.php?op=eliminar',
                                type: 'POST',
                                data: {
                                    id: idProducto
                                },
                                dataType: 'json',
                                success: function(response) {
                                    if (response === "ok") {
                                        cargarProductos();
                                    } else {
                                        alert('Error al eliminar producto: ' + response);
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error(error);
                                    alert('Error de conexión al servidor');
                                }
                            });
                        }
                    });
                });
            </script>
        </div>
        <!-- Content End -->
    </div>
</body>
</html>
