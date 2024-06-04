ALTER TABLE detalle_pedido
DROP PRIMARY KEY,
ADD COLUMN id_Detalle_Producto INT(11) NOT NULL AUTO_INCREMENT FIRST,
ADD PRIMARY KEY (Id_Detalle_Producto),
ADD UNIQUE KEY uk_codigo_pedido_codigo_producto (codigo_pedido, codigo_producto);
