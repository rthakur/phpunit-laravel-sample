<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FranciseTest extends TestCase {

	protected $user = null;

	
	public function setUp()
	{
		parent::setUp();
		
		$this->user = App\User::where("email","rthakur.dev@gmail.com")->first();
	}

	public function testFrancise()
	{
		$this->actingAs($this->user)
			->visit("admin/francises")
			->see("search");
	}
	
	public function testFrancisePost()
	{
		$response = $this->call("POST", "admin/francises", [
			"_token" => "".csrf_token(),
			"country" => 1,
			"company" => 1
		]);

		$this->assertEquals(302, $response->status());
	}
}
