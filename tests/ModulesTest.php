<?php

use Auth;

class ModulesTest extends TestCase {

  /**
   * Get Modules
   *
   * @return void
   */
  public function testModules()
  {
    $username= 'admin';
    $password= 'admin';
    Auth::attempt(['username' => $username, 'password' => $password, 'status' => 'ENA']);
    $username = Auth::user()->username;
    $response = $this->call('GET', 'modules');

    $this->assertEquals(200, $response->getStatusCode());
  }

}
