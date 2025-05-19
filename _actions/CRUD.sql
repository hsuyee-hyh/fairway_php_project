INSERT INTO roles (name, value) VALUES ('Editor', 44);

SELECT id, name FROM roles ORDER BY name DEESC LIMIT 3;


UPDATE roles SET name='Super' WHERE id=4;

DELETE FROM roles;
DELETE FROM roles WHERE id=2;