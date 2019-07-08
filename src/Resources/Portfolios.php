<?php

namespace CapsuleB\AmazonAdvertising\Resources;

use CapsuleB\AmazonAdvertising\Client;
use Exception;

/**
 * Class Portfolios
 * @package CapsuleB\AmazonAdvertising\Resources
 *
 * @property Client $client
 */
class Portfolios {

  const BASE_URL = 'portfolios';

  /**
   * Addons constructor.
   * @param Client $client
   */
  public function __construct(Client $client) {
    $this->client = $client;
  }

  /**
   * @param array $query
   * @return mixed
   * @throws Exception
   */
  public function list($query = []) {
    return $this->client->get(self::BASE_URL, $query);
  }

  /**
   * @param array $query
   * @return mixed
   * @throws Exception
   */
  public function listExtended($query = []) {
    return $this->client->get([self::BASE_URL, 'extended'], $query);
  }

  /**
   * @param $portfolioId
   * @return mixed
   * @throws Exception
   */
  public function get($portfolioId) {
    return $this->client->get([self::BASE_URL, $portfolioId]);
  }

  /**
   * @param $portfolioId
   * @return mixed
   * @throws Exception
   */
  public function getExtended($portfolioId) {
    return $this->client->get([self::BASE_URL, 'extended', $portfolioId]);
  }

  /**
   * @param array $params
   * @return mixed
   * @throws Exception
   */
  public function create($params = []) {
    return $this->client->post(self::BASE_URL, null, $params);
  }

  /**
   * @param array $params
   * @return mixed
   * @throws Exception
   */
  public function update($params = []) {
    return $this->client->put(self::BASE_URL, null, $params);
  }
}
