CREATE TABLE drink(
  id INT AUTO_INCREMENT NOT NULL,
  name VARCHAR(30) NOT NULL,
  category INT NOT NULL,
  minPrice decimal(19,2) NOT NULL,
  maxPrice decimal(19,2) NOT NULL,
  currentPrice decimal(19,2) NOT NULL,
  soldUnits INT NOT NULL,
  salesTime INT,
  PRIMARY KEY (id)
);

CREATE TABLE priceHistory(
  id INT AUTO_INCREMENT NOT NULL,
  fk_drinkId INT NOT NULL,
  price decimal(19,2) NOT NULL,
  FOREIGN KEY (fk_drinkId) REFERENCES drink(id),
  PRIMARY KEY(id)
);

CREATE TABLE salesHistory(
  id INT AUTO_INCREMENT NOT NULL,
  fk_drinkId INT NOT NULL,
  salesTime INT,
  time INT NOT NULL,
  FOREIGN KEY (fk_drinkId) REFERENCES drink(id),
  PRIMARY KEY(id)
);