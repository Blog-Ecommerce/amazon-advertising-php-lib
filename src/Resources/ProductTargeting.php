<?php

namespace CapsuleB\AmazonAdvertising\Resources;

use CapsuleB\AmazonAdvertising\Client;
use Exception;

/**
 * Class ProductTargeting
 * @package CapsuleB\AmazonAdvertising\Resources
 *
 * @property Client $client
 */
class ProductTargeting {

  const BASE_URL = 'targets';

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
   * @param string $targetId
   * @return array
   * @throws Exception
   */
  public function get($targetId) {
    return $this->client->get(self::BASE_URL, $targetId);
  }

  /**
   * @param string $targetId
   * @return array
   * @throws Exception
   */
  public function getExtended($targetId) {
    return $this->client->get([self::BASE_URL, 'extended', $targetId]);
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
   * @param string $targetId
   * @return array
   * @throws Exception
   */
  public function archive($targetId) {
    return $this->client->delete(self::BASE_URL, $targetId);
  }

  /**
   * @param array $params
   * @return array
   * @throws Exception
   */
  public function createRecommendations($params = []) {
    return $this->client->post([self::BASE_URL, 'productRecommendations'], null, $params);
  }

  /**
   * @param array $asins
   * @return array
   * @throws Exception
   */
  public function getCategories($asins = []) {
    return $this->client->get([self::BASE_URL, 'categories'], ['asins' => implode(',', $asins)]);
  }

  /**
   * @param array $params
   * @return array
   * @throws Exception
   */
  public function getBrandRecommendations($params = []) {
    return $this->client->get([self::BASE_URL, 'brands'], null, $params);
  }
}
