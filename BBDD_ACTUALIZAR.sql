
ALTER TABLE documento ADD pai INT;
DROP TABLE tag;

ALTER TABLE documento DROP COLUMN extension;
ALTER TABLE documento DROP COLUMN peso;
ALTER TABLE documento DROP COLUMN tema;
ALTER TABLE documento ADD categoria VARCHAR(200 