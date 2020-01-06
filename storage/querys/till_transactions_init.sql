-- Crea los tipos de transacciones iniciales
INSERT INTO public.transaction_types(id, name)
VALUES (1, 'till_close'), (2, 'till_open'), (3, 'extract_till'), (4, 'deposit_till'), (5, 'sale'),(6, 'edit_user'), (7, 'create_user'), (8, 'charge_stock'), (9, 'modify_stock'), (10, 'stock_adjustment'), (11, 'create_product'), (12, 'edit_product'), (13, 'audit'), (14, 'create_till'), (15, 'edit_till'), (16, 'discount'), (17, 'insert_ expense');
