<?php include("../../includes/functions.php"); ?>


    <script type="text/javascript" src="jquery/ajax-jquery-2.0.0.js"></script>


    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/loader-style.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

   <link href="assets/js/footable/css/footable.core.css?v=2-0-1" rel="stylesheet" type="text/css" />
    <link href="assets/js/footable/css/footable.standalone.css" rel="stylesheet" type="text/css" />
    <link href="assets/js/footable/css/footable-demos.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="assets/js/dataTable/lib/jquery.dataTables/css/DT_bootstrap.css" />
    <link rel="stylesheet" href="assets/js/dataTable/css/datatables.responsive.css" />





    <div class="content-wrap" id="toutLesRDV">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="nest" id="FilteringClose">
                            <div class="title-alt">
                                <h6>
                                    Rendez-Vous Du Jour</h6>
                                <div class="titleClose">
                                    <a class="gone" href="#FilteringClose">
                                        <span class="entypo-cancel"></span>
                                    </a>
                                </div>
                                <div class="titleToggle">
                                    <a class="nav-toggle-alt" href="#Filtering">
                                        <span class="entypo-up-open"></span>
                                    </a>
                                </div>

                            </div>

                            <div class="body-nest" id="Filtering">

                                <div class="row" style="margin-bottom:10px;">
                                    <div class="col-sm-4">
                                        <input class="form-control" id="filter" placeholder="Search..." type="text" />
                                    </div>
                                    <div class="col-sm-2">
                                        <select class="filter-status form-control">
                                            <option value="active">Active</option>
                                            <option value="disabled">Disabled</option>
                                            <option value="suspended">Suspended</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6">

                                        <a href="#clear" style="margin-left:10px;" class="pull-right btn btn-info clear-filter" title="clear filter">clear</a>
                                        <a href="#api" class="pull-right btn btn-info filter-api" title="Filter using the Filter API">filter API</a>



                                    </div>

                                </div>

                                <table id="footable-res2" class="demo" data-filter="#filter" data-filter-text-only="true">
                                    <thead>
                                        <tr>
                                            <th data-toggle="true">
                                                Nom Patient
                                            </th>
                                            <th>
                                                Date Rendez-Vouz
                                            </th>

                                            <th data-hide="phone,tablet">
                                                Identifiant
                                            </th>
                                            <th data-hide="phone,tablet">
                                                Prenom Patient
                                            </th>
                                            <th data-hide="phone,tablet">
                                                Téléphone
                                            </th>
                                            <th data-hide="phone,tablet">
                                                Chez docteur
                                            </th>
                                            <th>
                                                Heure Rendez-Vous
                                            </th>

                                            <th>
                                                Passer le patient
                                            </th>
                                            <th>
                                                Statut
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php 

    if (isset($_REQUEST['nomCabinet'])) {

                $nomCabinet    = $_GET['nomCabinet'];

                $nomBD = crypterNomDeLaBase($nomCabinet);

            }        


        try
                    {
                       $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                       $bdd = new PDO("mysql:host=localhost;dbname=$nomBD", "root", "", $pdo_options);
                                                     
                          $date = "'" .date('d/m/Y')."'";
                          $reponse = $bdd->query("SELECT * FROM rdv WHERE dateRDV = $date order by dateRDV desc, heureRDV asc");
                                                  
                      while ($donnees = $reponse->fetch())
                         {
                              echo "</tr>";

                              echo "<td> $donnees[nomP] </td>";
                              echo "<td> $donnees[dateRDV] </td>";

                              echo "<td data-value> $donnees[id] </td>";
                              echo "<td data-value> $donnees[prenoP] </td>";
                              echo "<td data-value> $donnees[tel] </td>";
                              echo "<td data-value> $donnees[medecin] </td>";       

                              echo "<td data-value=\"1\"> <span class=\"status-metro status-active\" title=\"Active\"> $donnees[heureRDV] </span></td>";

                              echo "<td data-value> <button>Passer</button> </td>";

                              switch ($donnees['statut']) {
                                case '0':
                                  echo "<td data-value> <button>Absent</button> </td>";
                                  break;
                                case '1':
                                  echo "<td data-value> <button>En salle</button> </td>";
                                  break;
                                case '2':
                                  echo "<td data-value> <button>En pause</button> </td>";
                                  break;    
                                
                                default:
                                  
                                  break;
                              }

                              

                              echo "</tr>";
            }
                           $reponse->closeCursor();
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }        
?>                                       

                                    </tbody>
                                </table>

                            </div>

                        </div>


                    </div>

                </div>
            </div>



    <script type="text/javascript" src="assets/js/toggle_close.js"></script>
    <script src="assets/js/footable/js/footable.js?v=2-0-1" type="text/javascript"></script>
    <script src="assets/js/footable/js/footable.sort.js?v=2-0-1" type="text/javascript"></script>
    <script src="assets/js/footable/js/footable.filter.js?v=2-0-1" type="text/javascript"></script>
    <script src="assets/js/footable/js/footable.paginate.js?v=2-0-1" type="text/javascript"></script>
    <script src="assets/js/footable/js/footable.paginate.js?v=2-0-1" type="text/javascript"></script>

<script type="text/javascript">
    $(function() {
        $('.footable-res').footable();
    });
    </script>
    <script type="text/javascript">
    $(function() {
        $('#footable-res2').footable().bind('footable_filtering', function(e) {
            var selected = $('.filter-status').find(':selected').text();
            if (selected && selected.length > 0) {
                e.filter += (e.filter && e.filter.length > 0) ? ' ' + selected : selected;
                e.clear = !e.filter;
            }
        });

        $('.clear-filter').click(function(e) {
            e.preventDefault();
            $('.filter-status').val('');
            $('table.demo').trigger('footable_clear_filter');
        });

        $('.filter-status').change(function(e) {
            e.preventDefault();
            $('table.demo').trigger('footable_filter', {
                filter: $('#filter').val()
            });
        });

        $('.filter-api').click(function(e) {
            e.preventDefault();

            //get the footable filter object
            var footableFilter = $('table').data('footable-filter');

            alert('about to filter table by "tech"');
            //filter by 'tech'
            footableFilter.filter('tech');

            //clear the filter
            if (confirm('clear filter now?')) {
                footableFilter.clearFilter();
            }
        });
    });
    </script>