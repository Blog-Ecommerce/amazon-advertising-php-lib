<?php

namespace CapsuleB\AmazonAdvertising\Resources;

use CapsuleB\AmazonAdvertising\Client;
use Exception;

/**
 * Class Campaigns
 * @package CapsuleB\AmazonAdvertising\Resources
 * @see https://advertising.amazon.com/API/docs/v2/reference/campaigns
 *
 * @property Client $client
 */
class Campaigns{

  const BASE_URL_SP   = 'v2/sp/campaigns';
  const BASE_URL_HSA  = 'v2/hsa/campaigns';

  /**
   * Addons constructor.
   * @param Client $client
   */
  public function __construct(Client $client) {
    $this->client = $client;
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/campaigns#listCampaigns
   * @param array $query
   * @return array
   * @throws Exception
   */
  public function list($query = []) {
    return $this->client->get(self::BASE_URL_SP, $query);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/campaigns#listCampaigns
   * @param array $query
   * @return array
   * @throws Exception
   */
  public function listHSA($query = []) {
    return $this->client->get(self::BASE_URL_HSA, $query);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/campaigns#listCampaignsEx
   * @param array $query
   * @return array
   * @throws Exception
   */
  public function listExtended($query = []) {
    return $this->client->get([self::BASE_URL_SP, 'extended'], $query);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/campaigns#getCampaign
   * @param string $campaignId
   * @return array
   * @throws Exception
   */
  public function get($campaignId) {
    return $this->client->get(self::BASE_URL_SP, $campaignId);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/campaigns#getCampaign
   * @param string $campaignId
   * @return array
   * @throws Exception
   */
  public function getHSA($campaignId) {
    return $this->client->get(self::BASE_URL_HSA, $campaignId);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/campaigns#getCampaignEx
   * @param string $campaignId
   * @return array
   * @throws Exception
   */
  public function getExtended($campaignId) {
    return $this->client->get([self::BASE_URL_SP, 'extended', $campaignId]);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/campaigns#createCampaigns
   * @param array $params
   * @return array
   * @throws Exception
   */
  public function create($params = []) {
    return $this->client->post(self::BASE_URL_SP, null, $params);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/campaigns#updateCampaigns
   * @param array $params
   * @return array
   * @throws Exception
   */
  public function update($params = []) {
    return $this->client->put(self::BASE_URL_SP, null, $params);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/campaigns#updateCampaigns
   * @param array $params
   * @return array
   * @throws Exception
   */
  public function updateHSA($params = []) {
    return $this->client->put(self::BASE_URL_HSA, null, $params);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/campaigns#archiveCampaign
   * @param string $campaignId
   * @return array
   * @throws Exception
   */
  public function archive($campaignId) {
    return $this->client->delete(self::BASE_URL_SP, $campaignId);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/campaigns#archiveCampaign
   * @param string $campaignId
   * @return array
   * @throws Exception
   */
  public function archiveHSA($campaignId) {
    return $this->client->delete(self::BASE_URL_HSA, $campaignId);
  }

  /**
   * @return CampaignsNegativeKeywords
   */
  public function negativeKeywords() {
    return new CampaignsNegativeKeywords($this->client);
  }
}
