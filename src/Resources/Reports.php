<?php

namespace CapsuleB\AmazonAdvertising\Resources;

use CapsuleB\AmazonAdvertising\Client;
use Exception;

/**
 * Class Reports
 *
 * @package CapsuleB\AmazonAdvertising\Resources
 * @see https://advertising.amazon.com/API/docs/v2/reference/reports
 *
 * @property Client $client
 */
class Reports {

  const BASE_URL = 'reporting/reports';

  /**
   * Addons constructor.
   * @param Client $client
   */
  public function __construct(
    protected Client $client
  ) {}

  /**
   * @param string       $recordType
   * @param string|array $reportDate
   * @param string|array $segment
   * @param array        $columns
   * @param array        $groupBy
   * @param array        $keywordType
   * @return mixed
   * @throws Exception
   */
  private function retrieve(string $recordType, $reportDate, $segment, array $columns, array $groupBy = [], array $keywordType = []) {
    $params = [
      'configuration' => [
        'adProduct' => 'SPONSORED_PRODUCTS',
        'reportTypeId' => $recordType,
        'columns' => $columns,
        'groupBy' => $groupBy,
        'timeUnit' => 'DAILY',
        'format' => 'GZIP_JSON',
      ]
    ];

    // Add the additional params
    if (!empty($keywordType)) $params['configuration']['filters'][] = ['field' => 'keywordType', 'values' => $keywordType];
    if (!empty($segment)) $params['configuration']['segment'] = $segment;
    if (!empty($reportDate)) {
      $params['startDate'] = $reportDate;
      $params['endDate'] = $reportDate;
    }

    return $this->client->post(self::BASE_URL, null, $params);
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
   * @param       $reportDate
   * @param       $segment
   * @param array $columns
   * @return mixed
   * @throws Exception
   */
  public function getCampaigns($reportDate, $segment = null, array $columns = []) {
    return $this->retrieve('spCampaigns', $reportDate, $segment, $columns,
      ['campaign']);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/reports#Campaigns-reports
   * @param       $reportDate
   * @param       $segment
   * @param array $columns
   * @return mixed
   * @throws Exception
   */
  public function getCampaignsHSA($reportDate, $segment = null, array $columns = []) {
    return null;
    // return $this->retrieve('campaigns', $reportDate, $segment, $columns);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/reports#Ad-Group-reports
   * @param       $reportDate
   * @param       $segment
   * @param array $columns
   * @return mixed
   * @throws Exception
   */
  public function getAdGroups($reportDate, $segment = null, array $columns = []) {
    return $this->retrieve('spCampaigns', $reportDate, $segment, $columns,
      ['campaign', 'adGroup']);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/reports#Ad-Group-reports
   * @param       $reportDate
   * @param       $segment
   * @param array $columns
   * @return mixed
   * @throws Exception
   */
  public function getAdGroupsHSA($reportDate, $segment = null, array $columns = []) {
    return null;
    // return $this->retrieve('adGroups', $reportDate, $segment, $columns);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/reports#Keyword-reports
   * @param       $reportDate
   * @param       $segment
   * @param array $columns
   * @return mixed
   * @throws Exception
   */
  public function getKeywords($reportDate, $segment = null, array $columns = []) {
    return $this->retrieve('spTargeting', $reportDate, $segment, $columns,
      ['targeting'],
      ['BROAD', 'PHRASE', 'EXACT']);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/reports#Keyword-reports
   * @param       $reportDate
   * @param       $segment
   * @param array $columns
   * @return mixed
   * @throws Exception
   */
  public function getKeywordsHSA($reportDate, $segment = null, array $columns = []) {
    return null;
    // return $this->retrieve('keywords', $reportDate, $segment, $columns);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/reports#Product-Ads-reports
   * @param       $reportDate
   * @param       $segment
   * @param array $columns
   * @return mixed
   * @throws Exception
   */
  public function getProductAds($reportDate, $segment = null, array $columns = []) {
    return $this->retrieve('spAdvertisedProduct', $reportDate, $segment, $columns,
      ['advertiser']);
  }

  /**
   * @see https://advertising.amazon.com/API/docs/v2/reference/reports#Product-Targeting-Reports
   * @param       $reportDate
   * @param       $segment
   * @param array $columns
   * @return mixed
   * @throws Exception
   */
  public function getProductTargeting($reportDate, $segment = null, array $columns = []) {
    return $this->retrieve('spTargeting', $reportDate, $segment, $columns,
      ['targeting'],
      ['TARGETING_EXPRESSION', 'TARGETING_EXPRESSION_PREDEFINED']);
  }
}
