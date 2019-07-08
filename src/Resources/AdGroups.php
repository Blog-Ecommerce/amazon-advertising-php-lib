<?php

namespace CapsuleB\AmazonAdvertising\Resources;

use CapsuleB\AmazonAdvertising\Client;
use Exception;

/**
 * Class AdGroups
 * @package CapsuleB\AmazonAdvertising\Resources
 *
 * @property Client $client
 */
class AdGroups {

  const BASE_URL = 'adGroups';

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
   * @param string $adGroupId
   * @return mixed
   * @throws Exception
   */
  public function get($adGroupId) {
    return $this->client->get(self::BASE_URL, $adGroupId);
  }

  /**
   * @param string $adGroupId
   * @return mixed
   * @throws Exception
   */
  public function getExtended($adGroupId) {
    return $this->client->get([self::BASE_URL, 'extended', $adGroupId]);
  }

  /**
   * @param array $params
   * @throws Exception
   */
  public function create($params = []) {
    $this->client->post(self::BASE_URL, null, $params);
  }

  /**
   * @param array $params
   * @throws Exception
   */
  public function update($params = []) {
    $this->client->put(self::BASE_URL, null, $params);
  }

  /**
   * @param string $adGroupId
   * @return mixed
   * @throws Exception
   */
  public function archive($adGroupId) {
    return $this->client->delete(self::BASE_URL, $adGroupId);
  }

}
