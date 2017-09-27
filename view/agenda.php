<!DOCTYPE html>
<html lang="en">
    <head>

        <!-- META TAG -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>S* dance</title>

        <!-- BOOTSTRAP CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">


        <!-- CSS PERSO -->

        <link rel="stylesheet" href="../css/accueil.css">
        <link rel="stylesheet" href="../css/general.css">

        <!-- CSS GRAFIKART -->

        <link rel="stylesheet" href="../css/calendrier.css">

        <!-- JQUERY -->

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>

        <!-- NOTRE CODE JQUERY -->
        <script type="text/javascript">
            jQuery(function($){
               $('.month').hide();
               $('.month:first').show();
               $('.months a:first').addClass('active');
               var current = 1;
               $('.months a').click(function(){
                    var month = $(this).attr('id').replace('linkMonth','');
                    if(month != current){
                        $('#month'+current).slideUp();
                        $('#month'+month).slideDown();
                        $('.months a').removeClass('active'); 
                        $('.months a#linkMonth'+month).addClass('active'); 
                        current = month;
                    }
                    return false; 
               });
            });

        </script>

    </head>


    <body class="body">

        <!-- MENU PRINCIPAL -->

        <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
            <a class="navbar-brand" href="#">S* Dance</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="horaire.html"> Horaires</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link professeurs" href="professeurs.html">Professeurs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link contact" href="contact.html">Contact</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link agenda" href="agenda.html">Agenda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link galerie" href="galerie.html">Photos/vidéos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link event" href="event.html">Mariage/anniversaire/autre</a>
                    </li>
                </ul>
            </div>
        </nav>


        <!-- PHP -->

        <?php
            require('../php/config.php');
            require('../php/date.php');
            $date = new Date();
            $year = date('Y');
            $events = $date->getEvents($year);
            $dates = $date->getAll($year);
        ?>

        <div class="periods">
            <div class="year">
                <?php echo $year; ?>
            </div>

            <div class="months">
                <ul>
                    <?php foreach ($date->months as $id=>$m): ?>
                        <li>
                            <a href="#" id="linkMonth<?php echo $id+1; ?>"><?php echo utf8_encode(substr(utf8_decode($m), 0,3));?></a>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
            <div class="clear"></div>
            <?php $dates = current($dates);?>
            <?php foreach ($dates as $m=>$days): ?>
                <div class="month relative" id="month<?php echo $m; ?>">
                    <table>
                        <thead>
                            <tr>
                                <?php foreach ($date->days as $d): ?>
                                    <th><?php echo substr($d,0,3); ?></th>
                                <?php endforeach; ?>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php $end = end($days); foreach ($days as $d=>$w): ?>
                                    <?php $time = strtotime("$year-$m-$d"); ?>
                                    <?php if(($d == 1)&&($w != 1)): ?>
                                        <td colspan="<?php echo $w-1; ?>" class="padding"></td>
                                    <?php endif; ?>

                                    <td<?php if($time == strtotime(date('Y-m-d'))): ?> class="today" <?php endif; ?> >
                                        <div class="relative">
                                            <div class="day">
                                                <?php echo $d; ?>
                                            </div>
                                        </div>
                                        <div class="daytitle">
                                            <?php echo $d; ?>
                                            <?php echo $date->months[$m-1]; ?>
                                        </div>
                                        <ul class="events">
                                            <?php if(isset($events[$time])): foreach ($events[$time] as $e): ?>
                                                <li><?php echo $e ?></li>
                                            <?php endforeach; endif; ?>
                                        </ul>
                                    </td>
                                    <?php if($w == 7): ?>
                                    </tr><tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <?php if($end != 7): ?>
                                    <td colspan="<?php echo 7-$end; ?>" class="padding"></td>
                                <?php endif; ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <div class="clear"></div>
            <?php endforeach; ?>
        </div>
    </body>
</html>