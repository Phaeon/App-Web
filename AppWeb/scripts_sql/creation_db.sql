CREATE DATABASE IF NOT EXISTS convocations;

DROP TABLE IF EXISTS Absences;
DROP TABLE IF EXISTS Convocations;
DROP TABLE IF EXISTS Matchs;
DROP TABLE IF EXISTS NonConvoques;
DROP TABLE IF EXISTS Effectifs;

DROP TABLE IF EXISTS Sites;
DROP TABLE IF EXISTS Competitions;
DROP TABLE IF EXISTS Equipes;
DROP TABLE IF EXISTS Utilisateurs;


CREATE TABLE Utilisateurs (
    login VARCHAR(50),
    mdp VARCHAR(100),
    role VARCHAR(10) CHECK (role IN ('Secrétaire', 'Entraîneur')),
    PRIMARY KEY (login, mdp, role)
);

CREATE TABLE Equipes (
    nom_equipe VARCHAR(20),
    categorie VARCHAR(20),
    effectif INTEGER NOT NULL,
    PRIMARY KEY (nom_equipe, categorie)
);

INSERT INTO Equipes VALUES
('Equipe A','Senior',0),
('Equipe B','Senior',0);


CREATE TABLE Competitions (
    nom_compet VARCHAR(40),
    importance INTEGER CHECK (importance > 0),
    PRIMARY KEY (nom_compet)
);

CREATE TABLE Sites (
    nom_site VARCHAR(50),
    terrain VARCHAR(50),
    PRIMARY KEY (nom_site, terrain)
    -- Faudrait trouver une manière de trier la table, sans passer par ORDER BY dans le SELECT
);

CREATE TABLE Effectifs (
    nom VARCHAR(30),
    prenom VARCHAR(30),
    type_licence VARCHAR(20) NOT NULL CHECK (type_licence IN ('oui', 'non')),
    nom_equipe VARCHAR(20),
    categorie VARCHAR(20),
    PRIMARY KEY (nom, prenom),
    FOREIGN KEY (nom_equipe, categorie) REFERENCES Equipes(nom_equipe, categorie)
);

CREATE TABLE NonConvoques (
    nom VARCHAR(30),
    prenom VARCHAR(30),
    raison VARCHAR(15) NOT NULL CHECK (raison IN ('Exempt', 'Absent', 'Blesse', 'Suspendu', 'Sans licence')),
    PRIMARY KEY (nom, prenom),
    FOREIGN KEY (nom, prenom) REFERENCES Effectifs(nom, prenom)
);

CREATE TABLE Matchs (
    date_m DATE,
    categorie VARCHAR(20),
    competition VARCHAR(40),
    equipe VARCHAR(20),
    equipe_adv VARCHAR(20),
    heure TIME,
    site VARCHAR(50),
    terrain VARCHAR(50),
    PRIMARY KEY (date_m, categorie, competition, equipe, equipe_adv, heure),
    FOREIGN KEY (competition) REFERENCES Competitions(nom_compet),
    FOREIGN KEY (equipe, categorie) REFERENCES Equipes(nom_equipe, categorie),
    FOREIGN KEY (equipe_adv) REFERENCES Equipes(nom_equipe),
    FOREIGN KEY (site, terrain) REFERENCES Sites(nom_site, terrain)
);


CREATE TABLE Convocations (
    date_m DATE,
    categorie VARCHAR(20),
    competition VARCHAR(20),
    equipe_adv VARCHAR(20),
    site VARCHAR(50),
    terrain VARCHAR(50),
    heure TIME,
    rdv VARCHAR(100),
    equipe VARCHAR(20),
    PRIMARY KEY (date_m, categorie, competition, equipe_adv, heure, equipe),
    FOREIGN KEY (date_m, categorie, competition, equipe, equipe_adv, heure) REFERENCES Matchs(date_m, categorie, competition, equipe, equipe_adv, heure),
    FOREIGN KEY (site, terrain) REFERENCES Sites(nom_site, terrain)
);


CREATE TABLE Absences (
    nom VARCHAR(30),
    prenom VARCHAR(30),
    date_m DATE,
    raison VARCHAR(15) NOT NULL CHECK (raison IN ('Exempt', 'Absent', 'Blesse', 'Suspendu', 'Sans licence')),
    raison_court CHAR(1) NOT NULL CHECK (raison_court IN ('A', 'B', 'N', 'S')),
    PRIMARY KEY (nom, prenom, date_m),
    FOREIGN KEY (nom, prenom) REFERENCES Effectifs(nom, prenom),
    FOREIGN KEY (date_m) REFERENCES Matchs(date_m)
);
