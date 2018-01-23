<?php

use Auth;

class SemestresTest extends TestCase {

  /**
   * Get Semestres
   *
   * @return void
   */
  public function testSemestres()
  {
    $username= 'admin';
    $password= 'admin';
    Auth::attempt(['username' => $username, 'password' => $password, 'status' => 'ENA']);
    $username = Auth::user()->username;
    $response = $this->call('GET', 'semestres');

    $this->assertEquals(200, $response->getStatusCode());
  }

}
