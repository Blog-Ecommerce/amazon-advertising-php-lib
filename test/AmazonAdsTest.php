<?php

namespace CapsuleB\AmazonAdvertising\Test;

use CapsuleB\AmazonAdvertising\Client;
use Exception;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase {

  /**
   * @var Client
   */
  private $client;

  protected function setUp() {
    // Set the Client
    $this->client = new Client(
      '',
      '',
      '',
      '',
      null,
      true
    );

    // Set the Customer ID
    $this->client->setCustomerId('12345678910');
  }

  /**
   * @throws Exception
   */
  public function testProfile() {
    // List Profiles
    var_dump($this->client->profiles->get('12345678910'));
    $this->client->refreshToken();
    var_dump($this->client->profiles->get('12345678910'));
  }
}
