<?php

require_once APPPATH . 'models/arrival.php';

class TranslinkAPIParser {

	public function parseArrivals($arrivalsResponse) {
		$arrivals = array();

		if (isset($arrivalsResponse) && !empty($arrivalsResponse)) {
			$xml = simplexml_load_string($arrivalsResponse);

			foreach ($xml->NextBus as $bus) {
				foreach ($bus->Schedules->Schedule as $arrival) {
					$arrivals[] = new Arrival(strval($bus->RouteNo), strval($arrival->Destination), strval($arrival->ExpectedCountdown));
				}
			}
		}

		return $arrivals;
	}

}