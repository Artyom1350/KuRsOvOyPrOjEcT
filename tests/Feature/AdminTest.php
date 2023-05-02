<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_login_page()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }
    public function test_user_home_page()
    {
        $response = $this->get('/home');
        $response->assertStatus(302);
    }
    public function test_user_inclAppl_page()
    {
        $response = $this->get('/inclAppl');
        $response->assertStatus(302);
    }
    public function test_user_inclAppl_id_page()
    {
        $response = $this->get('/inclAppl/1');
        $response->assertStatus(302);
    }
    public function test_user_myAppl_page()
    {
        $response = $this->get('/myAppl');
        $response->assertStatus(302);
    }
    public function test_user_allAppl_page()
    {
        $response = $this->get('/allAppl');
        $response->assertStatus(302);
    }
    public function test_user_create_appl_page()
    {
        $response = $this->get('/myAppl/doItAppl');
        $response->assertStatus(302);
    }
    public function test_user_change_appl_page()
    {
        $response = $this->get('/myAppl/changeApplication/1');
        $response->assertStatus(302);
    }
    //admin
    public function test_admin_home_page()
    {
        $response = $this->get('/admin_panel/home_admin');
        $response->assertStatus(302);
    }
    public function test_admin_user_page()
    {
        $response = $this->get('/admin_panel/user_admin');
        $response->assertStatus(302);
    }
    public function test_admin_group_page()
    {
        $response = $this->get('/admin_panel/group_admin');
        $response->assertStatus(302);
    }
    public function test_admin_download_template_user()
    {
        $response = $this->get('/admin_panel/download_template_user');
        $response->assertStatus(302);
    }
    public function test_admin_download_template_departments_and_parts()
    {
        $response = $this->get('/admin_panel/download_template_departments_and_parts');
        $response->assertStatus(302);
    }
}
