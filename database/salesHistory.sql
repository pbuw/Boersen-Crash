INSERT INTO salesHistory( fk_drinkId, salesTime, time)
VALUES
('1', '3', '500'),
('1', '2', '2'),
('1', '1','1'),
('1', '2','3'),
('1', '3', '500'),
('1', '2', '2'),
('1', '1','1'),
('1', '2','3'),
('1', '3', '500'),
('1', '2', '2'),
('1', '1','1'),
('1', '2','3'),
('1', '3', '500'),
('1', '2', '2'),
('1', '1','1'),
('1', '2','3')

SELECT AVG(soldUnits) AS average FROM (SELECT TOP 1 * FROM drink WHERE fk_drinkId='1' ORDER BY fk_drinkId DESC);
SELECT AVG(salesTime) AS average FROM (SELECT TOP 1 * FROM salesHistory WHERE fk_drinkId='1' ORDER BY fk_drinkId DESC);