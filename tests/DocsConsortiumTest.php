<?php

use Auth;

class DocsConsortiumTest extends TestCase {

  /**
   * Get Categories
   *
   * @return void
   */
  public function testDocsConsortium()
  {
    $username= 'admin';
    $password= 'admin';
    Auth::attempt(['username' => $username, 'password' => $password, 'status' => 'ENA']);
    $username = Auth::user()->username;
    $response = $this->call('GET', 'DocsConsortium');

    $this->assertEquals(200, $response->getStatusCode());
  }

}
