<?php

namespace CapsuleB\AmazonAdvertising\Resources;

use CapsuleB\AmazonAdvertising\Client;
use Exception;

/**
 * Class Campaigns
 * @package CapsuleB\AmazonAdvertising\Resources
 *
 * @property Client $client
 */
class Campaigns{

  const BASE_URL = 'campaigns';

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
   * @param string $campaignId
   * @return mixed
   * @throws Exception
   */
  public function get($campaignId) {
    return $this->client->get(self::BASE_URL, $campaignId);
  }

  /**
   * @param string $campaignId
   * @return mixed
   * @throws Exception
   */
  public function getExtended($campaignId) {
    return $this->client->get([self::BASE_URL, 'extended', $campaignId]);
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
   * @param string $campaignId
   * @return mixed
   * @throws Exception
   */
  public function archive($campaignId) {
    return $this->client->delete(self::BASE_URL, $campaignId);
  }

}
