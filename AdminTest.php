<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminTest extends TestCase {

    protected $user = null;

    public function setUp() {
        parent::setUp();
        $this->user = App\User::where("email", "rthakur.dev@gmail.com")->first();
    }

    public function testAdminPage() {
        $this->actingAs($this->user)
                ->visit('admin')    
                ->see('search');
    }

    public function testFrancises() {
        $this->actingAs($this->user)
                ->visit('admin/francises')
                ->see('Existing francises');
    }

    public function testBookings() {
        $this->actingAs($this->user)
                ->visit("admin/bookings")
                ->see("search");
    }

    public function testUsers() {
        $this->actingAs($this->user)
                ->visit("admin/users")
                ->see("Users");
    }

    public function testFranciseBookings() {
        $this->actingAs($this->user)
                ->visit("admin/francisebookings")
                ->see("search");
    }

    public function testCarrier() {
        $this->actingAs($this->user)
                ->visit("admin/carrier")
                ->see("Current Carriers");
    }

    public function testOrderHistory() {
        $this->actingAs($this->user)
                ->visit("admin/orderhistory")
                ->see("search");
    }

    public function testChoosePackage() {
        $this->actingAs($this->user)
                ->visit("admin/choosepackage")
                ->see("search");
    }

    public function testProfile() {
        $this->actingAs($this->user)
                ->visit("admin/profile")
                ->see("Your active package");
    }

    public function testProfilePost() {
        $this->actingAs($this->user)
                ->visit("admin/profile")
                ->type(env("TEST_USER_PASSWOR"), "current_password")
                ->type("123456", "password")
                ->type("123456", "password_confirmation")
                ->seePageIs("admin/profile");
    }

    public function testSearchStats() {
        $this->actingAs($this->user)
                ->visit("admin/searchstats")
                ->see("List of searches");
    }

    public function testVerifyCompany() {
        $response = $this->call("GET", "admin/verifycompany/1/0");
        $this->assertEquals($response->status(), 302);

        $response = $this->call("GET", "admin/verifycompany/1/1");
        $this->assertEquals($response->status(), 302);
    }

}
