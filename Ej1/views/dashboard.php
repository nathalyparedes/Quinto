<!DOCTYPE html>
<html lang='es'>
<head>
    <?php require_once('./html/head.php') ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

        .hide-arrows::-webkit-outer-spin-button,
        .hide-arrows::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
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
                    <input id="inputBuscar" type="text" class="form-control" placeholder="Buscar producto...">
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
                                    <input type="number" name="precio" id="precio" placeholder=" " class="form-control hide-arrows" required step="0.01">
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
                                    <input type="number" name="precioEditar" id="precioEditar" class="form-control hide-arrows" required step="0.01">
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
        </div>
        <!-- Content End -->
    </div>
</body>
</html>
