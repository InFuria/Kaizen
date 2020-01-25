-- Crea los tipos de transacciones iniciales
INSERT INTO transaction_types(id, name, description)
VALUES 
(1, 'till_close', 'Cierre de Caja'), 
(2, 'till_open', 'Apertura de Caja'), 
(3, 'extract_till', 'Extracto de Caja'), 
(4, 'deposit_till', 'Deposito en Caja'), 
(5, 'sale', 'Venta'),
(6, 'edit_user', 'Edicion de Usuario'), 
(7, 'create_user', 'Creacion de Usuario'), 
(8, 'charge_stock', 'Carga de Stock'), 
(9, 'modify_stock', 'Modificacion de Stock'), 
(10, 'stock_adjustment', 'Ajuste de Stock'), 
(11, 'create_product', 'Creacion de Producto'), 
(12, 'edit_product', 'Edicion de producto'), 
(13, 'audit', 'Arqueo de Caja'), 
(14, 'create_till', 'Creacion de Caja'), 
(15, 'edit_till', 'Edicion de Caja'), 
(16, 'discount', 'Descuento'), 
(17, 'insert_expense', 'Carga de Gastos');
