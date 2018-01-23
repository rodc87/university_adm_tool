<?php

use Auth;

class UtilisateursTest extends TestCase {

  /**
   * Get Utilisateurs
   *
   * @return void
   */
  public function testUtilisateurs()
  {
    $username= 'admin';
    $password= 'admin';
    Auth::attempt(['username' => $username, 'password' => $password, 'status' => 'ENA']);
    $username = Auth::user()->username;
    $response = $this->call('GET', 'utilisateurs');

    $this->assertEquals(200, $response->getStatusCode());
  }

}
