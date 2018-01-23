<?php

use Auth;

class CategoriesTest extends TestCase {

  /**
   * Get Categories
   *
   * @return void
   */
  public function testCategories()
  {
    $username= 'admin';
    $password= 'admin';
    Auth::attempt(['username' => $username, 'password' => $password, 'status' => 'ENA']);
    $username = Auth::user()->username;
    $response = $this->call('GET', 'categories');

    $this->assertEquals(200, $response->getStatusCode());
  }

}
