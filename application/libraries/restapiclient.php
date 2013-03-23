<?php

class RestAPIClient {

	public function execute($method, $url, $data = false) {
		$curl = curl_init();

		switch (strtoupper($method)) {
			case "POST":
				curl_setopt($curl, CURLOPT_POST, true);
				break;
			case "GET":
				curl_setopt($curl, CURLOPT_HTTPGET, true);
				break;
		}

		if ($data) {
			$apiURL = sprintf("%s?%s", $url, http_build_query($data));
		}

		curl_setopt($curl, CURLOPT_URL, $apiURL);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		return curl_exec($curl);
	}
}