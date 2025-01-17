CREATE TABLE IF NOT EXISTS PERSONNE (
    idP INTEGER PRIMARY KEY AUTOINCREMENT,
    nomP VARCHAR(15) NOT NULL,
    prenomP VARCHAR(15) NOT NULL
);

CREATE TABLE IF NOT EXISTS QUIZ_DATE (
    idD INTEGER PRIMARY KEY AUTOINCREMENT,
    jour DATE NOT NULL DEFAULT (DATE('now'))
);

CREATE TABLE IF NOT EXISTS REALISE (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    idP INTEGER NOT NULL,
    idD INTEGER NOT NULL,
    score INTEGER NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (idP) REFERENCES PERSONNE (idP) ON DELETE CASCADE,
    FOREIGN KEY (idD) REFERENCES QUIZ_DATE (idD) ON DELETE CASCADE
);
