<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CurrencyTest extends TestCase {

    protected $user = null;

    public function setUp() {
        parent::setUp();
        $this->user = App\User::where("email", "rthakur.dev@gmail.com")->first();
    }

    public function testCurrencySet() {
        $code = "US";
        $response = $this->call("GET", "choosecurrency/$code");
        $this->assertEquals(302, $response->status());
    }

}
