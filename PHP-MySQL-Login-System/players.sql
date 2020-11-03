CREATE TABLE playrs (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL ,
    surname VARCHAR(50) NOT NULL ,
    team VARCHAR(50) NOT NULL ,
    goals INT(3),
    assists INT(3),
    salary INT(6),
    ycard INT(2),
    rcard INT(2),
    injured BOOLEAN,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);