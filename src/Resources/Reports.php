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

  const BASE_URL  = 'v2/reports';
  const BASE_SP   = 'v2/sp';
  const BASE_HSA  = 'v2/hsa';

  /**
   * Addons constructor.
   * @param Client $client
   */
  public function __construct(Client $client) {
    $this->client = $client;
  }

  /**
   * @param string $recordType
   * @param string|array $reportDate
   * @param string|array $segment
   * @param array $metrics
   * @return mixed
   * @throws Exception
   */
  private function retrieve($type, $recordType, $reportDate, $segment, $metrics) {
    $params = [];
    if (!empty($reportDate) ) $params['reportDate'] = $reportDate;
    if (!empty($metrics)    ) $params['metrics']    = implode(',', $metrics);
    if (!empty($segment)    ) $params['segment']    = $segment;

    return $this->client->post([$type, $recordType, 'report'], null, $params);
  }

  /**
   * @param $id
   * @return mixed
   * @throws Exception
   */
  public function download($id) {
    $report = $this->client->get([self::BASE_URL, $id]);

    // If the report is ready, download, format and return it
    if ($report->status == 'SUCCESS') {
      return $this->client->download($report->location);
    }

    // Otherwise return the answer as-is
    return $report;
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/reports#Campaigns-reports
   * @param $reportDate
   * @param $segment
   * @param array $metrics
   * @return mixed
   * @throws Exception
   */
  public function getCampaigns($reportDate, $segment = null, $metrics = []) {
    return $this->retrieve(self::BASE_SP, 'campaigns', $reportDate, $segment, $metrics);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/reports#Campaigns-reports
   * @param $reportDate
   * @param $segment
   * @param $metrics
   * @return mixed
   * @throws Exception
   */
  public function getCampaignsHSA($reportDate, $segment = null, $metrics = []) {
    return $this->retrieve(self::BASE_HSA, 'campaigns', $reportDate, $segment, $metrics);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/reports#Ad-Group-reports
   * @param $reportDate
   * @param $segment
   * @param $metrics
   * @return mixed
   * @throws Exception
   */
  public function getAdGroups($reportDate, $segment = null, $metrics = []) {
    return $this->retrieve(self::BASE_SP, 'adGroups', $reportDate, $segment, $metrics);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/reports#Ad-Group-reports
   * @param $reportDate
   * @param $segment
   * @param $metrics
   * @return mixed
   * @throws Exception
   */
  public function getAdGroupsHSA($reportDate, $segment = null, $metrics = []) {
    return $this->retrieve(self::BASE_HSA, 'adGroups', $reportDate, $segment, $metrics);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/reports#Keyword-reports
   * @param $reportDate
   * @param $segment
   * @param $metrics
   * @return mixed
   * @throws Exception
   */
  public function getKeywords($reportDate, $segment = null, $metrics = []) {
    return $this->retrieve(self::BASE_SP, 'keywords', $reportDate, $segment, $metrics);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/reports#Keyword-reports
   * @param $reportDate
   * @param $segment
   * @param $metrics
   * @return mixed
   * @throws Exception
   */
  public function getKeywordsHSA($reportDate, $segment = null, $metrics = []) {
    return $this->retrieve(self::BASE_HSA, 'keywords', $reportDate, $segment, $metrics);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/reports#Product-Ads-reports
   * @param $reportDate
   * @param $segment
   * @param $metrics
   * @return mixed
   * @throws Exception
   */
  public function getProductAds($reportDate, $segment = null, $metrics = []) {
    return $this->retrieve(self::BASE_SP, 'productAds', $reportDate, $segment, $metrics);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/reports#Product-Targeting-Reports
   * @param $reportDate
   * @param $segment
   * @param $metrics
   * @return mixed
   * @throws Exception
   */
  public function getProductTargeting($reportDate, $segment = null, $metrics = []) {
    return $this->retrieve(self::BASE_SP, 'targets', $reportDate, $segment, $metrics);
  }
}
