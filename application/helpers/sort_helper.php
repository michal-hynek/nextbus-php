<?php

	
function sortArrivals($arrivals) {
	usort($arrivals, 'cmpArrivals');
	return $arrivals;
}		

function cmpArrivals($a, $b) {
	if(intval($a->getMinutesTillArrival()) ==  intval($b->getMinutesTillArrival())) {
		return 0 ;
	} 

	return (intval($a->getMinutesTillArrival()) < intval($b->getMinutesTillArrival())) ? -1 : 1;
}
