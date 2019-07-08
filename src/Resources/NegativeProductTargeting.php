<?php

namespace CapsuleB\AmazonAdvertising\Resources;

use CapsuleB\AmazonAdvertising\Client;
use Exception;

/**
 * Class NegativeProductTargeting
 * @package CapsuleB\AmazonAdvertising\Resources
 * @see https://advertising.amazon.com/API/docs/v2/reference/keywords/ad_group_negative_keywords
 *
 * @property Client $client
 */
class NegativeProductTargeting {

  const BASE_URL_SP = 'sp/negativeTargets';

  /**
   * Addons constructor.
   * @param Client $client
   */
  public function __construct(Client $client) {
    $this->client = $client;
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/product_attribute_targeting#listNegativeTargetingClauses
   * @param array $query
   * @return array
   * @throws Exception
   */
  public function list($query = []) {
    return $this->client->get(self::BASE_URL_SP, $query);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/product_attribute_targeting#listNegativeTargetingClausesEx
   * @param array $query
   * @return array
   * @throws Exception
   */
  public function listExtended($query = []) {
    return $this->client->get([self::BASE_URL_SP, 'extended'], $query);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/product_attribute_targeting#getNegativeTargetingClause
   * @param string $targetId
   * @return array
   * @throws Exception
   */
  public function get($targetId) {
    return $this->client->get(self::BASE_URL_SP, $targetId);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/product_attribute_targeting#getNegativeTargetingClauseEx
   * @param string $targetId
   * @return array
   * @throws Exception
   */
  public function getExtended($targetId) {
    return $this->client->get([self::BASE_URL_SP, 'extended', $targetId]);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/product_attribute_targeting#createNegativeTargetingClauses
   * @param array $params
   * @return array
   * @throws Exception
   */
  public function create($params = []) {
    return $this->client->post(self::BASE_URL_SP, null, $params);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/product_attribute_targeting#updateNegativeTargetingClauses
   * @param array $params
   * @return array
   * @throws Exception
   */
  public function update($params = []) {
    return $this->client->put(self::BASE_URL_SP, null, $params);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/product_attribute_targeting#archiveNegativeTargetingClause
   * @param string $targetId
   * @return array
   * @throws Exception
   */
  public function archive($targetId) {
    return $this->client->delete(self::BASE_URL_SP, $targetId);
  }

}
