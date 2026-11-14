-- Rendez-vous dont le patient a été effacé lors d'une modification
-- (identifiant patient enregistré avec un espace au début, nom / prénom / téléphone vides).
-- On recopie les informations depuis la fiche du patient et on corrige l'identifiant.
-- Script sans risque : il peut être exécuté plusieurs fois.

UPDATE `rdv`
INNER JOIN `patient` ON `patient`.`idPatient` = TRIM(`rdv`.`idPatient`)
SET `rdv`.`nomP`      = `patient`.`nomPatient`,
    `rdv`.`prenoP`    = `patient`.`prenomPatient`,
    `rdv`.`mail`      = `patient`.`emailPatient`,
    `rdv`.`tel`       = `patient`.`numTelPatient`,
    `rdv`.`idPatient` = TRIM(`rdv`.`idPatient`)
WHERE `rdv`.`idPatient` <> TRIM(`rdv`.`idPatient`);
