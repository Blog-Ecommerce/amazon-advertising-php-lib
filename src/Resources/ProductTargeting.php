<?php

namespace CapsuleB\AmazonAdvertising\Resources;

use CapsuleB\AmazonAdvertising\Client;
use Exception;

/**
 * Class ProductTargeting
 * @package CapsuleB\AmazonAdvertising\Resources
 * @see https://advertising.amazon.com/API/docs/v2/reference/product_attribute_targeting
 *
 * @property Client $client
 */
class ProductTargeting {

  const BASE_URL_SP = 'sp/targets';

  /**
   * Addons constructor.
   * @param Client $client
   */
  public function __construct(Client $client) {
    $this->client = $client;
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/product_attribute_targeting#listTargetingClauses
   * @param array $query
   * @return array
   * @throws Exception
   */
  public function list($query = []) {
    return $this->client->get(self::BASE_URL_SP, $query);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/product_attribute_targeting#listTargetingClausesEx
   * @param array $query
   * @return array
   * @throws Exception
   */
  public function listExtended($query = []) {
    return $this->client->get([self::BASE_URL_SP, 'extended'], $query);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/product_attribute_targeting#getTargetingClause
   * @param string $targetId
   * @return array
   * @throws Exception
   */
  public function get($targetId) {
    return $this->client->get(self::BASE_URL_SP, $targetId);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/product_attribute_targeting#getTargetingClauseEx
   * @param string $targetId
   * @return array
   * @throws Exception
   */
  public function getExtended($targetId) {
    return $this->client->get([self::BASE_URL_SP, 'extended', $targetId]);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/product_attribute_targeting#createTargetingClauses
   * @param array $params
   * @return array
   * @throws Exception
   */
  public function create($params = []) {
    return $this->client->post(self::BASE_URL_SP, null, $params);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/product_attribute_targeting#updateTargetingClauses
   * @param array $params
   * @return array
   * @throws Exception
   */
  public function update($params = []) {
    return $this->client->put(self::BASE_URL_SP, null, $params);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/product_attribute_targeting#archiveTargetingClause
   * @param string $targetId
   * @return array
   * @throws Exception
   */
  public function archive($targetId) {
    return $this->client->delete(self::BASE_URL_SP, $targetId);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/product_attribute_targeting#createTargetRecommendations
   * @param array $params
   * @return array
   * @throws Exception
   */
  public function createRecommendations($params = []) {
    return $this->client->post([self::BASE_URL_SP, 'productRecommendations'], null, $params);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/product_attribute_targeting#getTargetingCategories
   * @param array $asins
   * @return array
   * @throws Exception
   */
  public function getCategories($asins = []) {
    return $this->client->get([self::BASE_URL_SP, 'categories'], ['asins' => implode(',', $asins)]);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/product_attribute_targeting#getBrandRecommendations
   * @param array $params
   * @return array
   * @throws Exception
   */
  public function getBrandRecommendations($params = []) {
    return $this->client->get([self::BASE_URL_SP, 'brands'], null, $params);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/bidding/bid_recommendations#getBidRecommendations
   * @param array $params
   * @return array
   * @throws Exception
   */
  public function getBidRecommendations($params = []) {
    return $this->client->post([self::BASE_URL_SP, 'bidRecommendations'], null, $params);
  }
}
