CREATE DATABASE IF NOT EXISTS task_db;
USE task_db;

CREATE TABLE IF NOT EXISTS shipments (
  `Receiving Date` DATE NOT NULL,
  `Tracking Number` VARCHAR(50) NOT NULL,
  `Product Name` VARCHAR(100) NOT NULL,
  CBM DECIMAL(8,3) NOT NULL,
  Weight DECIMAL(8,2) NOT NULL
);

INSERT INTO shipments (`Receiving Date`, `Tracking Number`, `Product Name`, CBM, Weight) VALUES
('2026-04-01', 'TRK1001', 'Electronic Parts', 0.500, 2.30),
('2026-04-02', 'TRK1002', 'Computer Parts', 1.200, 5.40),
('2026-04-03', 'TRK1003', 'Phone Screen', 0.380, 1.80),
('2026-04-04', 'TRK1004', 'Electromechanical Parts', 0.900, 3.10),
('2026-04-05', 'TRK1005', 'Stationery Set', 0.250, 0.90),
('2026-04-06', 'TRK1006', 'Printer', 1.800, 7.50);

UPDATE shipments
SET `Product Name` = 'High-performance Electromechanical Parts', Weight = 3.20
WHERE `Tracking Number` = 'TRK1004';

DELETE FROM shipments
WHERE `Tracking Number` = 'TRK1006';

SELECT *
FROM shipments
WHERE Weight > 2.0
ORDER BY `Receiving Date` DESC;

SELECT *
FROM shipments
ORDER BY `Tracking Number` ASC;

ALTER TABLE shipments
ADD COLUMN Supplier VARCHAR(100) DEFAULT 'Unknown';

UPDATE shipments
SET Supplier = 'Shanghai Supplier'
WHERE `Tracking Number` = 'TRK1001';

ALTER TABLE shipments
DROP COLUMN Supplier;
