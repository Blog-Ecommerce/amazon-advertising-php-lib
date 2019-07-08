<?php

namespace CapsuleB\AmazonAdvertising\Resources;

use CapsuleB\AmazonAdvertising\Client;
use Exception;

/**
 * Class Reports
 * @package CapsuleB\AmazonAdvertising\Resources
 * @see https://advertising.amazon.com/API/docs/v2/reference/reports
 *
 * @property Client $client
 */
class Reports {

  const BASE_URL = 'report';

  /**
   * Addons constructor.
   * @param Client $client
   */
  public function __construct(Client $client) {
    $this->client = $client;
  }

  /**
   * @param string $recordType
   * @param string|array $segment
   * @param string|array $reportDate
   * @param array $metrics
   * @return mixed
   * @throws Exception
   */
  private function retrieve($type, $recordType, $segment, $reportDate, $metrics) {
    return $this->client->post([$type, $recordType, self::BASE_URL], null, [
      'segment'     => is_array($segment    ) ? $segment    : [$segment   ],
      'reportDate'  => is_array($reportDate ) ? $reportDate : [$reportDate],
      'metrics'     => is_array($metrics    ) ? $metrics    : [$metrics   ],
    ]);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/reports#Campaigns-reports
   * @param $segment
   * @param $reportDate
   * @param $metrics
   * @return mixed
   * @throws Exception
   */
  public function getCampaigns($segment, $reportDate, $metrics) {
    return $this->retrieve('sp', 'campaigns', $segment, $reportDate, $metrics);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/reports#Campaigns-reports
   * @param $segment
   * @param $reportDate
   * @param $metrics
   * @return mixed
   * @throws Exception
   */
  public function getCampaignsHSA($segment, $reportDate, $metrics) {
    return $this->retrieve('hsa', 'campaigns', $segment, $reportDate, $metrics);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/reports#Ad-Group-reports
   * @param $segment
   * @param $reportDate
   * @param $metrics
   * @return mixed
   * @throws Exception
   */
  public function getAdGroups($segment, $reportDate, $metrics) {
    return $this->retrieve('sp', 'adGroups', $segment, $reportDate, $metrics);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/reports#Ad-Group-reports
   * @param $segment
   * @param $reportDate
   * @param $metrics
   * @return mixed
   * @throws Exception
   */
  public function getAdGroupsHSA($segment, $reportDate, $metrics) {
    return $this->retrieve('hsa', 'adGroups', $segment, $reportDate, $metrics);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/reports#Keyword-reports
   * @param $segment
   * @param $reportDate
   * @param $metrics
   * @return mixed
   * @throws Exception
   */
  public function getKeywords($segment, $reportDate, $metrics) {
    return $this->retrieve('sp', 'keywords', $segment, $reportDate, $metrics);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/reports#Keyword-reports
   * @param $segment
   * @param $reportDate
   * @param $metrics
   * @return mixed
   * @throws Exception
   */
  public function getKeywordsHSA($segment, $reportDate, $metrics) {
    return $this->retrieve('hsa', 'keywords', $segment, $reportDate, $metrics);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/reports#Product-Ads-reports
   * @param $segment
   * @param $reportDate
   * @param $metrics
   * @return mixed
   * @throws Exception
   */
  public function getProductAds($segment, $reportDate, $metrics) {
    return $this->retrieve('sp', 'productAds', $segment, $reportDate, $metrics);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/reports#Product-Targeting-Reports
   * @param $segment
   * @param $reportDate
   * @param $metrics
   * @return mixed
   * @throws Exception
   */
  public function getProductTargeting($segment, $reportDate, $metrics) {
    return $this->retrieve('sp', 'productAds', $segment, $reportDate, $metrics);
  }
}
