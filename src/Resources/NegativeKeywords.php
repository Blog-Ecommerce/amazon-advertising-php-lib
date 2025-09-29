<?php

namespace CapsuleB\AmazonAdvertising\Resources;

use CapsuleB\AmazonAdvertising\Client;
use Exception;

/**
 * Class NegativeKeywords
 * @package CapsuleB\AmazonAdvertising\Resources
 *
 * @property Client $client
 */
class NegativeKeywords {

  const BASE_URL_SP = 'v2/sp/negativeKeywords';

  /**
   * Addons constructor.
   * @param Client $client
   */
  public function __construct(
    protected Client $client
  ) {}

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/keywords/ad_group_negative_keywords#listNegativeKeywords
   * @param array $query
   * @return array
   * @throws Exception
   */
  public function list($query = []) {
    return $this->client->get(self::BASE_URL_SP, $query);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/keywords/ad_group_negative_keywords#listNegativeKeywordsEx
   * @param array $query
   * @return array
   * @throws Exception
   */
  public function listExtended($query = []) {
    return $this->client->get([self::BASE_URL_SP, 'extended'], $query);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/keywords/ad_group_negative_keywords#getNegativeKeyword
   * @param string $keywordId
   * @return array
   * @throws Exception
   */
  public function get($keywordId) {
    return $this->client->get([self::BASE_URL_SP, $keywordId]);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/keywords/ad_group_negative_keywords#getNegativeKeywordEx
   * @param string $keywordId
   * @return array
   * @throws Exception
   */
  public function getExtended($keywordId) {
    return $this->client->get([self::BASE_URL_SP, 'extended', $keywordId]);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/keywords/ad_group_negative_keywords#createNegativeKeywords
   * @param array $params
   * @return array
   * @throws Exception
   */
  public function create($params = []) {
    return $this->client->post(self::BASE_URL_SP, null, $params);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/keywords/ad_group_negative_keywords#updateNegativeKeywords
   * @param array $params
   * @return array
   * @throws Exception
   */
  public function update($params = []) {
    return $this->client->put(self::BASE_URL_SP, null, $params);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/keywords/ad_group_negative_keywords#archiveNegativeKeyword
   * @param string $keywordId
   * @return array
   * @throws Exception
   */
  public function archive($keywordId) {
    return $this->client->delete([self::BASE_URL_SP, $keywordId]);
  }

}
