<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase {

	/**
	 * Creates the application.
	 *
	 * @return Symfony\Component\HttpKernel\HttpKernelInterface
	 */
	public function createApplication()
	{
		$unitTesting = true;

		$testEnvironment = 'testing';

		return require __DIR__.'/../../bootstrap/start.php';
	}

	public function assertJsonOk()
	{
		$this->assertResponseOk();

		$responseJson = json_decode($this->client->getResponse()->getContent());
		$this->assertTrue( ! is_null($responseJson), 'Expected response to be not NULL');

		$this->assertTrue( isset($responseJson->success) && $responseJson->success, 'Expected response to contain success => true');
	}

	public function assertJsonNotOk()
	{
		$status = $this->client->getResponse()->getStatusCode();
		$this->assertTrue( 200 != $status, 'Expected status code not equal to 200');

		$responseJson = json_decode($this->client->getResponse()->getContent());
		$this->assertTrue( ! is_null($responseJson), 'Expected response to be not NULL');

		$this->assertTrue( isset($responseJson->success) && ! $responseJson->success, 'Expected response to contain success => false');
	}
}
