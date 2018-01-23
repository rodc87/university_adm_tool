<?php

use Auth;

class ExampleTest extends TestCase {

	/**
	 * Get HOMEPAGE
	 *
	 * @return void
	 */
	public function testBasicExample()
	{
		$username= 'admin';
		$password= 'admin';
		Auth::attempt(['username' => $username, 'password' => $password, 'status' => 'ENA']);
		$username = Auth::user()->username;
		$response = $this->call('GET', '/');

		$this->assertEquals(200, $response->getStatusCode());
	}

}
