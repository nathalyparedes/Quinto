$(document).ready(function() {
    cargarProductos();

    function cargarProductos() {
        $.ajax({
            url: '../controllers/producto.controllers.php?op=todos',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response && response !== "No se encontraron productos.") {
                    mostrarProductos(response);
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
        
        // SweetAlert2 para mostrar el mensaje de confirmación
        Swal.fire({
            title: '¿Está seguro que desea eliminar este producto?',
            text: "Esta acción no se puede deshacer.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {

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
                            Swal.fire(
                                '¡Eliminado!',
                                'El producto ha sido eliminado correctamente.',
                                'success'
                            );
                        } else {
                            Swal.fire(
                                'Error',
                                'No se pudo eliminar el producto: ' + response,
                                'error'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        Swal.fire(
                            'Error',
                            'Error de conexión al servidor',
                            'error'
                        );
                    }
                });
            }
        });
    });

    $('#inputBuscar').on('input', function() {
        var nombre = $(this).val().trim();
        buscarProductos(nombre);
    });

    // Función para buscar productos por nombre
    function buscarProductos(nombre) {
        $.ajax({
            url: '../controllers/producto.controllers.php?op=buscar&nombre=' + nombre,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response && response.length > 0) {
                    mostrarProductos(response);
                } else {
                    var mensaje = '<tr><td colspan="5" class="text-center">No se encontraron productos con el nombre especificado.</td></tr>';
                    $('#cuerpoProductos').html(mensaje);
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
                alert('Error al buscar productos.');
            }
        });
    }

    // Función para mostrar productos en la tabla
    function mostrarProductos(productos) {
        var cuerpoProductos = $('#cuerpoProductos');
        cuerpoProductos.empty();
        $.each(productos, function(index, producto) {
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
    }
});
