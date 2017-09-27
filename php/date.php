<?php
class Date{

	var $days = array('lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche');
	var $months = array('Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre');


	function getEvents($year){
		global $DB;
		$req = $DB->query('SELECT id,title,date FROM events WHERE YEAR(date)='.$year);
		$r = array();

		/**
		* CE QUE JE VEUX $r[TIMESTAMP][id] = title
		*/
		while($d = $req->fetch(PDO::FETCH_OBJ)){
			$r[strtotime($d->date)][$d->id] = $d->title;
		}
		return $r;
	}

	function getAll($year){
		$r = array();

		$date = new DateTime($year.'-01-01');
		while($date->format('Y') <= $year){
			$y = $date->format('Y');
			$m = $date->format('n');
			$d = $date->format('j');
			$w = str_replace('0', '7', $date->format('w'));
			$r[$y][$m][$d] = $w;
			$date->add(new DateInterval('P1D'));
		}

		return $r;
	}
}