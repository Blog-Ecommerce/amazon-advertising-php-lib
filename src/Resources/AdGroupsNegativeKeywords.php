<?php

namespace CapsuleB\AmazonAdvertising\Resources;

use CapsuleB\AmazonAdvertising\Client;
use Exception;

/**
 * Class AdGroupsNegativeKeywords
 * @package CapsuleB\AmazonAdvertising\Resources
 *
 * @property Client $client
 */
class AdGroupsNegativeKeywords {

  const BASE_URL = 'negativeKeywords';

  /**
   * Addons constructor.
   * @param Client $client
   */
  public function __construct(Client $client) {
    $this->client = $client;
  }

  /**
   * @param array $query
   * @return array
   * @throws Exception
   */
  public function list($query = []) {
    return $this->client->get(self::BASE_URL, $query);
  }

  /**
   * @param array $query
   * @return array
   * @throws Exception
   */
  public function listExtended($query = []) {
    return $this->client->get([self::BASE_URL, 'extended'], $query);
  }

  /**
   * @param string $keywordId
   * @return array
   * @throws Exception
   */
  public function get($keywordId) {
    return $this->client->get([self::BASE_URL, $keywordId]);
  }

  /**
   * @param string $keywordId
   * @return array
   * @throws Exception
   */
  public function getExtended($keywordId) {
    return $this->client->get([self::BASE_URL, 'extended', $keywordId]);
  }

  /**
   * @param array $params
   * @return array
   * @throws Exception
   */
  public function create($params = []) {
    return $this->client->post(self::BASE_URL, null, $params);
  }

  /**
   * @param array $params
   * @return array
   * @throws Exception
   */
  public function update($params = []) {
    return $this->client->put(self::BASE_URL, null, $params);
  }

  /**
   * @param string $keywordId
   * @return array
   * @throws Exception
   */
  public function archive($keywordId) {
    return $this->client->delete([self::BASE_URL, $keywordId]);
  }

}
