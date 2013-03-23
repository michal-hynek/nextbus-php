<?php

require_once('restapiclient.php');
require_once('translinkapiparser.php');

class TranslinkAPIAdapter {

	const API_URL = 'http://api.translink.ca/RTTIAPI/V1';

	private $APIKey;
	private $instance;
	private $restClient;
	private $parser;

	public function __construct($config = array()) {
		$this->setRestClient($config['restClient']);
		$this->setAPIKey($config['APIKey']);
		$this->setParser($config['parser']);
	}

	///////////////////  GETTERS and SETTERS //////////////////////
	public function getAPIKey() {
		return $this->APIKey;
	}

	public final function setAPIKey($APIKey) {
		if (!isset($APIKey)) {
			throw new InvalidArgumentException('API key cannot be empty');
		}

		$this->APIKey = $APIKey;
	}

	public final function setRestClient(RestAPIClient $restClient) {
		if (!isset($restClient)) {
			throw new InvalidArgumentException('REST client cannot be NULL');
		}

		$this->restClient = $restClient;
	}

	public final function setParser(TranslinkAPIParser $parser) {
		$this->parser = $parser;
	}

	//////////////////////// API CALLS /////////////////////////
	public function getArrivals($stopId) {
		$response = $this->restClient->execute("GET", self::API_URL . "/stops/" . $stopId . '/estimates',
												array('ApiKey' => $this->APIKey));	

		return $this->parser->parseArrivals($response);
	}


}