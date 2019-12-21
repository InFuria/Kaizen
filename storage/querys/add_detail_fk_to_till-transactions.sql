ALTER TABLE till_transactions ADD CONSTRAINT fk_detail_id FOREIGN KEY (detail_id) REFERENCES sales(id);
