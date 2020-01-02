-- Crea los tipos de transacciones iniciales
INSERT INTO public.transaction_types(name)
VALUES ('till_close'), ('till_open'), ('extract_till'), ('deposit_till'), ('sale'),('edit_user'), ('create_user'), ('charge_stock'), ('modify_stock'), ('stock_adjustment'), ('create_product'), ('edit_product'), ('audit'), ('create_till'), ('edit_till');
