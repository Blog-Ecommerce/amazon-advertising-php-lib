<?php

namespace CapsuleB\AmazonAdvertising\Resources;

use CapsuleB\AmazonAdvertising\Client;
use Exception;

/**
 * Class CampaignsNegativeKeywords
 * @package CapsuleB\AmazonAdvertising\Resources
 * @see https://advertising.amazon.com/API/docs/v2/reference/keywords/campaign_negative_keywords
 *
 * @property Client $client
 */
class CampaignsNegativeKeywords {

  const BASE_URL_SP = 'v2/sp/campaignNegativeKeywords';

  /**
   * Addons constructor.
   * @param Client $client
   */
  public function __construct(Client $client) {
    $this->client = $client;
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/keywords/campaign_negative_keywords#listCampaignNegativeKeywords
   * @param array $query
   * @return array
   * @throws Exception
   */
  public function list($query = []) {
    return $this->client->get(self::BASE_URL_SP, $query);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/keywords/campaign_negative_keywords#listCampaignNegativeKeywordsEx
   * @param array $query
   * @return array
   * @throws Exception
   */
  public function listExtended($query = []) {
    return $this->client->get([self::BASE_URL_SP, 'extended'], $query);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/keywords/campaign_negative_keywords#getCampaignNegativeKeyword
   * @param string $keywordId
   * @return array
   * @throws Exception
   */
  public function get($keywordId) {
    return $this->client->get([self::BASE_URL_SP, $keywordId]);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/keywords/campaign_negative_keywords#getCampaignNegativeKeywordEx
   * @param string $keywordId
   * @return array
   * @throws Exception
   */
  public function getExtended($keywordId) {
    return $this->client->get([self::BASE_URL_SP, 'extended', $keywordId]);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/keywords/campaign_negative_keywords#createCampaignNegativeKeywords
   * @param array $params
   * @return array
   * @throws Exception
   */
  public function create($params = []) {
    return $this->client->post(self::BASE_URL_SP, null, $params);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/keywords/campaign_negative_keywords#updateCampaignNegativeKeywords
   * @param array $params
   * @return array
   * @throws Exception
   */
  public function update($params = []) {
    return $this->client->put(self::BASE_URL_SP, null, $params);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/keywords/campaign_negative_keywords#archiveCampaignNegativeKeyword
   * @param string $keywordId
   * @return array
   * @throws Exception
   */
  public function archive($keywordId) {
    return $this->client->delete([self::BASE_URL_SP, $keywordId]);
  }

}
