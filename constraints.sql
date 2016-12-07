-- Ajout de contraintes aux tables du modèle absences
-- Création : 18.09.2015
-- Auteurs : Sellathurai Aansana

-- Pour exécuter le script dans votre schéma :
-- 	SET search_path TO aansana;
--		\i chemin/absenceContraintes_postgres.sql
-- ********************************************************
-- Base de données :  `absences`
--
-- --------------------------------------------------------
--
-- Table `classes`
--
-- --------------------------------------------------------
--
-- Table `eleves`
--
ALTER TABLE eleves
	ADD CONSTRAINT FK_eleves_classes
                FOREIGN KEY (numeroclasse)
                REFERENCES classes(numero);
-- --------------------------------------------------------
--
-- Table `absences`
--
ALTER TABLE absences 
	ADD CONSTRAINT FK_absences_eleves
		FOREIGN KEY (numeroeleve)
                REFERENCES eleves(numero)
                ON DELETE CASCADE;

ALTER TABLE absences 
	ADD CONSTRAINT FK_absences_lecons
		FOREIGN KEY (numerolecon)
                REFERENCES lecons(numero)
                ON DELETE CASCADE;
-- --------------------------------------------------------
--
-- Table `lecons`
--
ALTER TABLE lecons
	ADD CONSTRAINT FK_lecons_matieres
                FOREIGN KEY (numeromatiere)
                REFERENCES matieres(numero);

ALTER TABLE lecons
	ADD CONSTRAINT FK_lecons_utilisateur
                FOREIGN KEY (numeroutilisateur)
                REFERENCES utilisateurs(numero);
-- --------------------------------------------------------
--
-- Table `modules`
--
ALTER TABLE modules
	ADD CONSTRAINT FK_modules_classes
                FOREIGN KEY (numeroclasse)
                REFERENCES classes(numero);	
-- --------------------------------------------------------
--
-- Table `matieres`
--
ALTER TABLE matieres
	ADD CONSTRAINT FK_matieres_modules
                FOREIGN KEY (numeromodule)
                REFERENCES modules(numero);	
-- --------------------------------------------------------
--
-- Table `utilisateurs_groupes`
--
ALTER TABLE utilisateurs_groupes
        ADD CONSTRAINT FK_utilisateurs_groupes_utilisateurs
                FOREIGN KEY (numutilisateur)
                REFERENCES utilisateurs(numero);

ALTER TABLE utilisateurs_groupes
        ADD CONSTRAINT FK_utilisateurs_groupes_groupes
                FOREIGN KEY (numgroupe)
                REFERENCES groupes(numero);
-- --------------------------------------------------------
--
-- Table `permissions_groupes`
--
ALTER TABLE permissions_groupes
        ADD CONSTRAINT FK_premissions_groupes_groupes
                FOREIGN KEY (numgroupe)
                REFERENCES groupes(numero);

ALTER TABLE permissions_groupes
        ADD CONSTRAINT FK_premissions_groupes_permissions
                FOREIGN KEY (numpermission)
                REFERENCES permissions(numero);
-- --------------------------------------------------------
--
-- Table `permissions_utilisateurs`
--
ALTER TABLE permissions_utilisateurs
        ADD CONSTRAINT FK_permissions_utilisateurs_utilisateurs
                FOREIGN KEY (numutilisateur)
                REFERENCES utilisateurs(numero);

ALTER TABLE permissions_utilisateurs
        ADD CONSTRAINT FK_permissions_utilisateurs_permissions
                FOREIGN KEY (numpermission)
                REFERENCES permissions(numero);
-- --------------------------------------------------------
--
-- Table `sessions`
--
ALTER TABLE sessions
	ADD CONSTRAINT FK_sessions_utilisateurs
                FOREIGN KEY (numutilisateur)
                REFERENCES utilisateurs(numero);
-- --------------------------------------------------------
--
-- Table 'utilisateurs'
--
-- --------------------------------------------------------
--
-- Table `utilisateurs_groupes`
--