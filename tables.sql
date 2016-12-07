-- Création des tables du modèle absences

		-- Supression des tables
		-- Création des tables

--		\i chemin/absencesCreationTable_postgre.sql
-- ********************************************************
--set search_path to absences_dev;

DROP VIEW IF EXISTS vue_absences CASCADE;
DROP TABLE IF EXISTS absences CASCADE;
DROP TABLE IF EXISTS eleves CASCADE;
DROP TABLE IF EXISTS lecons CASCADE;
DROP TABLE IF EXISTS matieres CASCADE;
DROP TABLE IF EXISTS modules CASCADE;
DROP TABLE IF EXISTS classes CASCADE;
DROP TABLE IF EXISTS utilisateurs_groupes CASCADE;
DROP TABLE IF EXISTS permissions_groupes CASCADE;
DROP TABLE IF EXISTS permissions_utilisateurs CASCADE;
DROP TABLE IF EXISTS sessions CASCADE;
DROP TABLE IF EXISTS groupes CASCADE;
DROP TABLE IF EXISTS permissions CASCADE;
DROP TABLE IF EXISTS utilisateurs CASCADE;

-- Base de données :  absences
--
-- --------------------------------------------------------
--
-- Structure de la table 'absences'
--
CREATE TABLE IF NOT EXISTS absences
(
	Numero SERIAL,
	NumeroEleve INTEGER,
	NumeroLecon INTEGER,
	NbPeriode INTEGER,
	Commentaire VARCHAR(255),
	
	CONSTRAINT pk_absences PRIMARY KEY(numero)
);
-- --------------------------------------------------------
--
-- Structure de la table `classes` vv
--
CREATE TABLE IF NOT EXISTS classes
(
	Numero SERIAL,
	Code VARCHAR(50),
	
	CONSTRAINT pk_classes PRIMARY KEY(numero),
	CONSTRAINT xu_classes_code UNIQUE (code)
);	
-- --------------------------------------------------------
--
-- Structure de la table `eleves`
--
CREATE TABLE IF NOT EXISTS Eleves
(
	Numero SERIAL,
	NumeroClasse INTEGER,
	Nom VARCHAR(50),
	Prenom VARCHAR(50),
	
	CONSTRAINT pk_Eleves PRIMARY KEY(numero)
);
-- --------------------------------------------------------
--
-- Structure de la table `groupes`
--

-- --------------------------------------------------------
--
-- Structure de la table `lecons`
--
CREATE TABLE IF NOT EXISTS lecons
(
	Numero SERIAL, 
    NumeroMatiere INTEGER,
	NumeroUtilisateur INTEGER,	
	NbPeriode INTEGER,
	Date DATE,
	Login VARCHAR(20),
	
	CONSTRAINT pk_lecons PRIMARY KEY(numero)
);
-- --------------------------------------------------------
--
-- Structure de la table `matieres`
--
CREATE TABLE IF NOT EXISTS matieres (
	Numero SERIAL,
	NumeroModule INTEGER,
	Libelle VARCHAR(50),
	Dotation INTEGER,
	
	CONSTRAINT pk_matieres PRIMARY KEY(numero)
 );
-- --------------------------------------------------------
--
-- Structure de la table `modules`
--
CREATE TABLE IF NOT EXISTS modules (
	Numero SERIAL,
    NumeroClasse INTEGER,
	Libelle VARCHAR(50),
	
	CONSTRAINT pk_modules PRIMARY KEY(numero)
);
-- --------------------------------------------------------
--
-- Structure de la table `permissions`
--

-- --------------------------------------------------------
--
-- Structure de la table `permissions_groupes`
--

-- --------------------------------------------------------
--
-- Structure de la table `permissions_utilisateurs`
--

-- --------------------------------------------------------
--
-- Structure de la table `sessions`
--

-- --------------------------------------------------------
--
-- Structure de la table 'utilisateurs'
--

-- --------------------------------------------------------
--
-- Structure de la table `utilisateurs_groupes`
--
