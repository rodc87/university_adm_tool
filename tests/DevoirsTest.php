<?php

use Auth;

class DevoirsTest extends TestCase {

  /**
   * Get Devoirs
   *
   * @return void
   */
  public function testDevoirs()
  {
    $username= 'admin';
    $password= 'admin';
    Auth::attempt(['username' => $username, 'password' => $password, 'status' => 'ENA']);
    $username = Auth::user()->username;
    $response = $this->call('GET', 'devoirs');

    $this->assertEquals(200, $response->getStatusCode());
  }

}
