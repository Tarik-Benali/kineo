-- ---------------------------------------------------------------------
-- Mise à jour du 14/11/2026
--   1. Type de séance sur chaque rendez-vous (simple, vestibulaire,
--      bilan_vestibulaire, esthetique)
--   2. Reprise de l'historique : les RDV déjà clôturés récupèrent le
--      type de séance enregistré lors du paiement (table addition)
--   3. Index pour accélérer l'agenda et l'historique des RDV
--
-- A exécuter UNE SEULE FOIS sur la base virtuhos_kine (phpMyAdmin > SQL).
-- Aucune donnée existante n'est supprimée.
-- ---------------------------------------------------------------------

-- 1. Nouvelle colonne
ALTER TABLE `rdv`
  ADD COLUMN `type_seance` VARCHAR(20) NOT NULL DEFAULT 'simple'
  COMMENT 'simple, vestibulaire, bilan_vestibulaire, esthetique'
  AFTER `type`;

-- 2. Reprise de l'historique depuis les paiements
UPDATE `rdv`
  INNER JOIN `addition` ON `addition`.`idRDV` = `rdv`.`id`
  SET `rdv`.`type_seance` = `addition`.`type_seance`
  WHERE `addition`.`type_seance` IN ('vestibulaire', 'bilan_vestibulaire', 'esthetique');

-- 3. Index
ALTER TABLE `rdv`
  ADD INDEX `idx_rdv_medecin_date` (`idMedecin`, `dateRDV`),
  ADD INDEX `idx_rdv_date` (`dateRDV`),
  ADD INDEX `idx_rdv_patient` (`idPatient`),
  ADD INDEX `idx_rdv_nom` (`nomP`, `prenoP`),
  ADD INDEX `idx_rdv_tel` (`tel`);
