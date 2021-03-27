CREATE DATABASE IF NOT EXISTS convocations;

DROP TABLE IF EXISTS Absences;
DROP TABLE IF EXISTS Convocations_enregistrees;
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
                            
INSERT INTO Utilisateurs VALUES ('secretaire', '$2y$10$iXWUmcnvWLn85tXDtIgE8O8jKRUCEoJtyBJNXZVuuEOSBiqSayQxa', 'Secrétaire'), ('entraineur', '$2y$10$gPREU8RtbNmYjMmRhNEi1OXa5lb7VArU6UbxtOoVqAvzHkxpeEW3W', 'Entraîneur');
                 

CREATE TABLE Equipes (
    nom_equipe VARCHAR(20),
    categorie VARCHAR(20),
    PRIMARY KEY (nom_equipe, categorie)
);

INSERT INTO Equipes VALUES
('EQUIPE A','VETERAN'),
('EQUIPE A','SENIOR');


CREATE TABLE Competitions (
    nom_compet VARCHAR(100),
    PRIMARY KEY (nom_compet)
);

INSERT INTO Competitions VALUES
('Championnat départemental - SENIOR'),
('Championnat de France - VETERAN');

CREATE TABLE Effectifs (
    nom VARCHAR(30),
    prenom VARCHAR(30),
    type_licence VARCHAR(20) NOT NULL CHECK (type_licence IN ('oui', 'non')),
    categorie VARCHAR(20),
    PRIMARY KEY (nom, prenom)
);

INSERT INTO Effectifs VALUES
('Petit','Emmanuel','oui','VETERAN'),
('Zidane','Zinedine','oui','VETERAN'),
('Djorkaeff','Youri','oui','VETERAN'),
('Lizarazu','Bixente','oui','VETERAN'),
('Barthez','Fabien','oui','VETERAN'),
('Thuram','Lilian','oui','VETERAN'),
('Deschamps','Didier','oui','VETERAN'),
('Leboeuf','Frank','oui','VETERAN'),
('Vieira','Patrick','oui','VETERAN'),
('Blanc','Laurent','oui','VETERAN'),
('Trezeguet','David','oui','VETERAN'),
('Mbappé','Kylian','oui','SENIOR'),
('Griezmann','Antoine','oui','SENIOR'),
('Lloris','Hugo','oui','SENIOR'),
('Giroud','Olivier','oui','SENIOR'),
('Pogba','Paul','oui','SENIOR'),
('Kanté','NGolo','oui','SENIOR'),
('Pavard','Benjamin','oui','SENIOR'),
('Matuidi','Blaise','oui','SENIOR'),
('Umtiti','Samuel','oui','SENIOR'),
('Martial','Anthony','oui','SENIOR'),
('Varane','Raphaël','oui','SENIOR');

CREATE TABLE Matchs (
    date_m DATE,
    categorie VARCHAR(20),
    competition VARCHAR(40),
    equipe VARCHAR(20),
    equipe_adv VARCHAR(20),
    heure TIME,
    site VARCHAR(50),
    terrain VARCHAR(50),
    domicile INT,
    exterieur INT,
    PRIMARY KEY (date_m, categorie, competition, equipe, equipe_adv, heure),
    FOREIGN KEY (competition) REFERENCES Competitions(nom_compet),
    FOREIGN KEY (equipe, categorie) REFERENCES Equipes(nom_equipe, categorie)
);


CREATE TABLE Convocations (
    date_m DATE,
    PRIMARY KEY (date_m)
);

CREATE TABLE Convocations_enregistrees (
    date_m DATE,
    joueur VARCHAR(100),
    nom_match VARCHAR(100),
    PRIMARY KEY (date_m, joueur)
);

CREATE TABLE Absences (
    nom VARCHAR(30),
    prenom VARCHAR(30),
    raison VARCHAR(15) NOT NULL CHECK (raison IN ('Absent', 'Blesse', 'Suspendu', 'Sans licence')),
    raison_court CHAR(1) NOT NULL CHECK (raison_court IN ('A', 'B', 'S', 'N')),
    date_abs DATE,
    PRIMARY KEY (nom, prenom,date_abs),
    FOREIGN KEY (nom, prenom) REFERENCES Effectifs(nom, prenom)
);

