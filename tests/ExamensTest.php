<?php

use Auth;

class ExamensTest extends TestCase {

  /**
   * Get Examens
   *
   * @return void
   */
  public function testExamens()
  {
    $username= 'admin';
    $password= 'admin';
    Auth::attempt(['username' => $username, 'password' => $password, 'status' => 'ENA']);
    $username = Auth::user()->username;
    $response = $this->call('GET', 'examens');

    $this->assertEquals(200, $response->getStatusCode());
  }

}
