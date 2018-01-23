<?php

use Auth;

class CentresTest extends TestCase {

  /**
   * Get Centres
   *
   * @return void
   */
  public function testCentres()
  {
    $username= 'admin';
    $password= 'admin';
    Auth::attempt(['username' => $username, 'password' => $password, 'status' => 'ENA']);
    $username = Auth::user()->username;
    $response = $this->call('GET', 'centres');

    $this->assertEquals(200, $response->getStatusCode());
  }

}
