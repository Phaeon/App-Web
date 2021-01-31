CREATE DATABASE convocations IF NOT EXISTS;

DROP TABLE IF EXISTS Equipes;
DROP TABLE IF EXISTS Sites;
DROP TABLE IF EXISTS Competitions;
DROP TABLE IF EXISTS NonConvoques;
DROP TABLE IF EXISTS Convocations;
DROP TABLE IF EXISTS Matchs;
DROP TABLE IF EXISTS Equipes;
DROP TABLE IF EXISTS Absences;

CREATE TABLE Effectifs (
    nom VARCHAR(30),
    prenom VARCHAR(30),
    type_licence VARCHAR(20) NOT NULL,
    CONSTRAINT c_licence CHECK (type_licence IN ('Libre', 'Futsal', 'Entreprise', 'Loisir')),
    PRIMARY KEY (nom, prenom)
);


CREATE TABLE Competitions (
    nom_compet VARCHAR(40),
    -- Permet de définir l'importance de la compétition par un numéro quelconque (facultatif)
    importance INTEGER,
    PRIMARY KEY (nom_compet),
    CONSTRAINT c_importance CHECK (importance >= 0)
);


CREATE TABLE Sites (
    nom_site VARCHAR(50),
    terrain VARCHAR(50),
    PRIMARY KEY (nom_site, terrain)
    -- Faudrait trouver une manière de trier la table, sans passer par ORDER BY dans le SELECT
);


CREATE TABLE NonConvoques (
    nom VARCHAR(30),
    prenom VARCHAR(30),
    raison VARCHAR(15) NOT NULL,
    PRIMARY KEY (nom, prenom),
    FOREIGN KEY (nom, prenom) REFERENCES Effectifs(nom, prenom),
    CONSTRAINT c_raison CHECK (raison IN ('Exempt', 'Absent', 'Blesse', 'Suspendu', 'Sans licence'))
);


CREATE TABLE Equipes (
    nom_equipe VARCHAR(20),
    categorie VARCHAR(20),
    effectif INTEGER NOT NULL,
    PRIMARY KEY (nom_equipe, categorie)
);


CREATE TABLE Absences (
    nom VARCHAR(30),
    prenom VARCHAR(30),
    date_m DATE,
    raison VARCHAR(15) NOT NULL,
    raison_court CHAR(1) NOT NULL,
    PRIMARY KEY (nom, prenom, date_m),
    FOREIGN KEY (nom, prenom) REFERENCES Effectifs(nom, prenom),
    FOREIGN KEY (date_m) REFERENCES Convocations(date_m),
    FOREIGN KEY (raison) REFERENCES NonConvoques(raison),
    CONSTRAINT c_raison_court CHECK (raison_court IN ('A', 'B', 'N', 'S'))
);


CREATE TABLE Matchs (
    categorie VARCHAR(20) NOT NULL,
    competition VARCHAR(20) NOT NULL,
    equipe VARCHAR(20) NOT NULL,
    equipe_adv VARCHAR(50) NOT NULL,
    date_m DATE NOT NULL,
    heure TIME NOT NULL,
    terrain VARCHAR(50),
    site VARCHAR(50) NOT NULL,
    PRIMARY KEY (categorie, competition, equipe, equipe_adv, date_m, heure),
    FOREIGN KEY (categorie) REFERENCES Equipes(categorie),
    FOREIGN KEY (equipe) REFERENCES Equipes(nom_equipe),
    FOREIGN KEY (equipe_adv) REFERENCES Equipes(nom_equipe),
    FOREIGN KEY (terrain) REFERENCES Sites(terrain),
    FOREIGN KEY (site) REFERENCES Sites(nom_site)
);


CREATE TABLE Convocations (
    date_m DATE NOT NULL,
    competition VARCHAR(20) NOT NULL,
    equipe_adv VARCHAR(50) NOT NULL,
    site VARCHAR(50) NOT NULL,
    terrain VARCHAR(50),
    heure TIME NOT NULL,
    rdv VARCHAR(100),
    equipe VARCHAR(20) NOT NULL,
    PRIMARY KEY (date_m, competition, equipe_adv, heure, equipe),
    FOREIGN KEY (date_m) REFERENCES Matchs(date_m),
    FOREIGN KEY (competition) REFERENCES Matchs(competition),
    FOREIGN KEY (equipe_adv) REFERENCES Equipes(nom_equipe),
    FOREIGN KEY (equipe) REFERENCES Equipes(nom_equipe),
    FOREIGN KEY (site, terrain) REFERENCES Sites(nom_site, terrain),
    FOREIGN KEY (heure) REFERENCES Matchs(heure)
);