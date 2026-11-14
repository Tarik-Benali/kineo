/* ---------------------------------------------------------------------------
 * Recherche rapide de patient (autocomplete)
 *
 * RecherchePatient.attacher({
 *     champ      : '#mailPhonePatient',   // champ de saisie
 *     champId    : '#idPatien',           // champ caché qui reçoit l'identifiant
 *     url        : 'fonctionnalites/affichage/rechercherPatients.php',
 *     surSelection : function (patient) {} // optionnel
 * });
 *
 * - recherche par nom, prénom, "nom prénom", téléphone ou mail
 * - tous les résultats sont accessibles ("Afficher plus" / défilement)
 * - clavier : flèches haut / bas, Entrée pour choisir, Echap pour fermer
 * ------------------------------------------------------------------------- */

var RecherchePatient = (function ($) {

    var styleAjoute = false;

    function ajouterStyle() {
        if (styleAjoute) { return; }
        styleAjoute = true;

        var css = ''
            + '.rp-zone{position:relative;}'
            + '.rp-champ.rp-selectionne{border-color:#45B6B0 !important; background:#F2FBFA !important; font-weight:bold; padding-right:32px;}'
            + '.rp-coche{display:none; position:absolute; right:10px; top:50%; margin-top:-10px; width:20px; height:20px; line-height:20px; text-align:center; border-radius:50%; background:#45B6B0; color:#fff; font-size:12px; pointer-events:none;}'
            + '.rp-zone.rp-ok .rp-coche{display:block;}'
            + '.rp-liste{display:none; position:absolute; left:0; right:0; top:100%; margin-top:2px; z-index:3000; background:#fff; border:1px solid #cfd8dc; border-radius:4px; box-shadow:0 6px 18px rgba(0,0,0,.18); text-align:left;}'
            + '.rp-entete{padding:6px 12px; font-size:12px; color:#607d8b; background:#f5f7f8; border-bottom:1px solid #e3e8ea; border-radius:4px 4px 0 0;}'
            + '.rp-resultats{max-height:340px; overflow-y:auto;}'
            + '.rp-item{padding:7px 12px; border-bottom:1px solid #eef1f2; cursor:pointer; color:#37474f;}'
            + '.rp-item:last-child{border-bottom:none;}'
            + '.rp-item.rp-actif{background:#E3F2FD;}'
            + '.rp-ligne1{font-size:14px; line-height:20px;}'
            + '.rp-ligne1 .rp-nom{font-weight:bold; text-transform:uppercase;}'
            + '.rp-ligne1 .rp-age{float:right; font-size:12px; color:#78909c;}'
            + '.rp-ligne2{font-size:12px; color:#78909c; line-height:18px;}'
            + '.rp-ligne2 span{margin-right:12px; white-space:nowrap;}'
            + '.rp-item mark{background:#FFF59D; color:inherit; padding:0;}'
            + '.rp-badge{display:inline-block; margin-left:6px; padding:0 5px; border-radius:3px; font-size:10px; font-weight:bold; line-height:16px; vertical-align:middle; color:#fff;}'
            + '.rp-risque{background:#000;}'
            + '.rp-nouveau{background:#fff; color:#E74C3C; border:1px solid #E74C3C;}'
            + '.rp-prochain{color:#337ab7;}'
            + '.rp-message{padding:10px 12px; font-size:13px; color:#78909c;}'
            + '.rp-plus{display:block; width:100%; padding:7px; border:none; border-top:1px solid #e3e8ea; background:#f5f7f8; color:#337ab7; font-size:13px; cursor:pointer;}'
            + '.rp-plus:hover{background:#eceff1;}';

        $('<style type="text/css">' + css + '</style>').appendTo('head');
    }

    function echapper(texte) {
        return String(texte === null || texte === undefined ? '' : texte)
            .replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;').replace(/'/g, '&#39;');
    }

    function echapperRegex(texte) {
        return texte.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
    }

    // Met en évidence les mots saisis dans un texte (déjà échappé)
    function surligner(texte, mots) {
        var html = echapper(texte);
        for (var i = 0; i < mots.length; i++) {
            if (mots[i].length > 0) {
                html = html.replace(new RegExp('(^|\\s)(' + echapperRegex(echapper(mots[i])) + ')', 'ig'), '$1<mark>$2</mark>');
            }
        }
        return html;
    }

    function attacher(options) {

        ajouterStyle();

        var $champ   = $(options.champ);
        var $champId = $(options.champId);
        var url      = options.url || 'fonctionnalites/affichage/rechercherPatients.php';

        if ($champ.length === 0 || $champ.data('rp-actif')) { return; }
        $champ.data('rp-actif', true);

        $champ.attr('autocomplete', 'off').addClass('rp-champ');
        $champ.attr('placeholder', 'Nom, prénom ou téléphone du patient...');

        var $zone = $champ.parent();
        $zone.addClass('rp-zone');
        $zone.append('<span class="rp-coche">&#10003;</span>');

        var $liste = $('<div class="rp-liste"><div class="rp-entete"></div><div class="rp-resultats"></div></div>');
        $zone.append($liste);
        var $entete    = $liste.find('.rp-entete');
        var $resultats = $liste.find('.rp-resultats');

        var minuteur   = null;
        var requete    = null;
        var numero     = 0;
        var recherche  = '';
        var patients   = [];
        var total      = 0;
        var actif      = -1;
        var memo       = null;   // patient sélectionné avant la saisie
        var choisi     = false;

        function marquerSelection() {
            var ok = $.trim($champId.val()) !== '';
            $champ.toggleClass('rp-selectionne', ok);
            $zone.toggleClass('rp-ok', ok);
        }

        function fermer() {
            $liste.hide();
            actif = -1;
        }

        function afficherMessage(message) {
            $entete.hide();
            $resultats.html('<div class="rp-message">' + message + '</div>');
            $liste.show();
        }

        function rendre(ajout) {
            var mots = recherche.split(' ');
            var html = '';

            for (var i = (ajout ? $resultats.find('.rp-item').length : 0); i < patients.length; i++) {
                var p = patients[i];

                var infos = [];
                if (p.telephones.length > 0) { infos.push('<span>&#9742; ' + surligner(p.telephones.join(' / '), mots) + '</span>'); }
                if (p.naissance !== '')       { infos.push('<span>Né(e) le ' + echapper(p.naissance) + '</span>'); }
                if (p.nbSeances > 0) {
                    infos.push('<span>Dernière séance : ' + echapper(p.derniereSeance) + ' (' + p.nbSeances + ')</span>');
                }
                if (p.prochainRDV !== '')     { infos.push('<span class="rp-prochain">Prochain RDV : ' + echapper(p.prochainRDV) + '</span>'); }

                var badges = '';
                if (p.risque)          { badges += '<span class="rp-badge rp-risque">À risque</span>'; }
                if (p.nbSeances === 0) { badges += '<span class="rp-badge rp-nouveau">Nouveau</span>'; }

                html += '<div class="rp-item" data-index="' + i + '">'
                      +   '<div class="rp-ligne1">'
                      +     (p.age !== '' ? '<span class="rp-age">' + p.age + ' ans</span>' : '')
                      +     '<span class="rp-nom">' + surligner(p.nom, mots) + '</span> ' + surligner(p.prenom, mots) + badges
                      +   '</div>'
                      +   '<div class="rp-ligne2">' + infos.join('') + '</div>'
                      + '</div>';
            }

            if (ajout) {
                $resultats.find('.rp-plus').remove();
                $resultats.append(html);
            } else {
                $resultats.html(html);
                $resultats.scrollTop(0);
            }

            if (patients.length < total) {
                $resultats.append('<button type="button" class="rp-plus">Afficher plus (' + (total - patients.length) + ' restant' + (total - patients.length > 1 ? 's' : '') + ')</button>');
            }

            $entete.text(total + ' patient' + (total > 1 ? 's' : '') + ' trouvé' + (total > 1 ? 's' : '')
                + (total > patients.length ? ' - précisez le prénom ou le téléphone pour réduire la liste' : '')).show();
            $liste.show();

            if (!ajout) { activer(patients.length > 0 ? 0 : -1); }
        }

        function charger(ajout) {
            if (requete) { requete.abort(); }
            var ceNumero = ++numero;

            if (!ajout) { afficherMessage('Recherche en cours...'); }

            requete = $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                data: { q: recherche, offset: ajout ? patients.length : 0 },
                success: function (donnees) {
                    if (ceNumero !== numero) { return; }   // réponse d'une ancienne saisie
                    total    = donnees.total;
                    patients = ajout ? patients.concat(donnees.patients) : donnees.patients;

                    if (total === 0) {
                        afficherMessage('Aucun patient trouvé pour « ' + echapper(recherche) + ' »');
                    } else {
                        rendre(ajout);
                    }
                },
                error: function (xhr, statut) {
                    if (statut !== 'abort' && ceNumero === numero) {
                        afficherMessage('La recherche a échoué, veuillez réessayer.');
                    }
                }
            });
        }

        function activer(index) {
            var $items = $resultats.find('.rp-item');
            $items.removeClass('rp-actif');
            actif = index;
            if (index < 0 || index >= $items.length) { return; }

            var $item = $items.eq(index).addClass('rp-actif');
            var haut  = $item.position().top + $resultats.scrollTop();
            if (haut < $resultats.scrollTop()) {
                $resultats.scrollTop(haut);
            } else if (haut + $item.outerHeight() > $resultats.scrollTop() + $resultats.height()) {
                $resultats.scrollTop(haut + $item.outerHeight() - $resultats.height());
            }
        }

        function choisir(index) {
            var p = patients[index];
            if (!p) { return; }

            choisi = true;
            memo   = null;
            $champ.val(p.nom + ' ' + p.prenom);
            $champId.val(p.id);
            marquerSelection();
            fermer();

            if (typeof options.surSelection === 'function') { options.surSelection(p); }
        }

        $champ.on('focus', function () {
            choisi = false;
            memo   = ($.trim($champId.val()) !== '') ? { id: $champId.val(), texte: $champ.val() } : null;
            this.select();
        });

        $champ.on('input', function () {
            choisi = false;
            $champId.val('');
            marquerSelection();

            recherche = $.trim($champ.val().replace(/\s+/g, ' '));
            clearTimeout(minuteur);

            if (recherche.length < 2) {
                if (requete) { requete.abort(); }
                numero++;
                if (recherche.length === 0) { fermer(); } else { afficherMessage('Saisissez au moins 2 caractères...'); }
                return;
            }

            minuteur = setTimeout(function () { charger(false); }, 250);
        });

        $champ.on('keydown', function (e) {
            var visible = $liste.is(':visible');
            var nb      = $resultats.find('.rp-item').length;

            if (e.which === 40) {            // flèche bas
                e.preventDefault();
                if (visible && nb > 0) { activer(Math.min(actif + 1, nb - 1)); }
            } else if (e.which === 38) {     // flèche haut
                e.preventDefault();
                if (visible && nb > 0) { activer(Math.max(actif - 1, 0)); }
            } else if (e.which === 13) {     // Entrée : choisit le patient (sans passer au champ suivant)
                e.preventDefault();
                if (visible && actif >= 0) { e.stopPropagation(); choisir(actif); }
            } else if (e.which === 27) {     // Echap : ferme la liste sans fermer la modale
                if (visible) { e.preventDefault(); e.stopPropagation(); fermer(); $champ.data('rp-echap', true); }
            }
        });

        $champ.on('keyup', function (e) {
            if (e.which === 27 && $champ.data('rp-echap')) {
                e.stopPropagation();
                $champ.data('rp-echap', false);
            }
        });

        $champ.on('blur', function () {
            setTimeout(function () {
                if ($liste.data('rp-survol')) { return; }
                fermer();
                if (choisi) { return; }

                if ($.trim($champ.val()) === '') {
                    $champId.val('');
                } else if (memo) {
                    // Rien de nouveau n'a été choisi : on garde le patient précédent
                    $champ.val(memo.texte);
                    $champId.val(memo.id);
                }
                marquerSelection();
            }, 150);
        });

        // Souris : mousedown pour choisir avant que le champ ne perde le focus
        $liste.on('mouseenter', function () { $liste.data('rp-survol', true); });
        $liste.on('mouseleave', function () { $liste.data('rp-survol', false); });

        $liste.on('mousedown', '.rp-item', function (e) {
            e.preventDefault();
            choisir(parseInt($(this).attr('data-index'), 10));
            $liste.data('rp-survol', false);
        });

        $liste.on('mousemove', '.rp-item', function () {
            var index = parseInt($(this).attr('data-index'), 10);
            if (index !== actif) { activer(index); }
        });

        $liste.on('mousedown', '.rp-plus', function (e) {
            e.preventDefault();
            charger(true);
        });

        $liste.on('mousedown', function (e) {
            // garder le focus dans le champ (défilement de la liste, entête...)
            e.preventDefault();
        });

        // Défilement jusqu'en bas : chargement automatique de la suite
        $resultats.on('scroll', function () {
            if (patients.length < total && $resultats.scrollTop() + $resultats.innerHeight() >= this.scrollHeight - 30) {
                if (!$resultats.data('rp-chargement')) {
                    $resultats.data('rp-chargement', true);
                    charger(true);
                    setTimeout(function () { $resultats.data('rp-chargement', false); }, 400);
                }
            }
        });

        // Suivre les changements faits par le reste de la page (ouverture d'un RDV, réinitialisation...)
        $champ.on('rp-actualiser', marquerSelection);
        marquerSelection();
    }

    return { attacher: attacher };

})(jQuery);
