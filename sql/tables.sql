
/*

To create database:

CREATE DATABASE blogue CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;
GRANT ALL PRIVILEGES ON blogue.* TO 'blogue'@'localhost' IDENTIFIED BY '1234';

*/

CREATE TABLE IF NOT EXISTS categories (
    id      INTEGER       NOT NULL                AUTO_INCREMENT,
    nom     VARCHAR(40)   NOT NULL,
    /* contraintes */
    PRIMARY KEY ( id )
);

CREATE TABLE IF NOT EXISTS nouvelles (
    id              INTEGER       NOT NULL        AUTO_INCREMENT,
    nom             VARCHAR(80)   NOT NULL,
    contenu         TEXT          NOT NULL,
    date_parution   TIMESTAMP     NOT NULL        DEFAULT CURRENT_TIMESTAMP,

    /* cles etrangeres */
    categorie_id    INTEGER       NOT NULL,
    /* contraintes */
    PRIMARY KEY (id),
    CONSTRAINT nv_categorie_id FOREIGN KEY ( categorie_id ) REFERENCES categories ( id )
);

CREATE TABLE IF NOT EXISTS utilisateurs (
    id              INTEGER       NOT NULL      AUTO_INCREMENT,
    username        VARCHAR(40)   NOT NULL,
    password        VARCHAR(32)   NOT NULL,
    nom             VARCHAR(80)   NOT NULL,
    prenom          VARCHAR(80)   NOT NULL,
    admin           BOOLEAN       NOT NULL    DEFAULT FALSE,
    theme           VARCHAR(40)   NOT NULL    DEFAULT 'vert',
    /* cles etrangeres */
    categorie_id    INTEGER       NOT NULL,
    session_id      VARCHAR(32)   NULL,
    /* contraintes */
    PRIMARY KEY ( id ),
    CONSTRAINT ut_categorie_id
    FOREIGN KEY ( categorie_id )
    REFERENCES categories ( id )

);
