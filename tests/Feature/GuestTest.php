<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GuestTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
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
    //api
    public function test_api_user_myAppl_getAnswersUsers(){
        $response = $this->post('/api/myAppl/getAnswersUsers');
        $response->assertStatus(401);
    }
    public function test_api_user_myAppl_getUsers(){
        $response = $this->post('/api/myAppl/getUsers');
        $response->assertStatus(401);
    }
    public function test_api_user_myAppl_getDepartment(){
        $response = $this->post('/api/myAppl/getDepartment');
        $response->assertStatus(401);
    }
    public function test_api_user_myAppl_addApplication(){
        $response = $this->post('/api/myAppl/addApplication');
        $response->assertStatus(401);
    }
    public function test_api_user_myAppl_changeApplSend(){
        $response = $this->post('/api/myAppl/changeApplSend');
        $response->assertStatus(401);
    }
    public function test_api_user_myAppl_deleteDoc(){
        $response = $this->post('/api/myAppl/deleteDoc');
        $response->assertStatus(401);
    }public function test_api_user_incAppl_updateStatusDocument(){
        $response = $this->post('/api/incAppl/updateStatusDocument');
        $response->assertStatus(401);
    }
    public function test_api_user_myAppl_Download(){
        $response = $this->post('/api/myAppl/Download');
        $response->assertStatus(401);
    }
    //admin
    public function test_api_admin_getOneUser(){
        $response = $this->post('/api/admin/getOneUser');
        $response->assertStatus(401);
    }
    public function test_api_admin_getAllDepartments(){
        $response = $this->post('/api/admin/getAllDepartments');
        $response->assertStatus(401);
    }
    public function test_api_admin_getDepartmentParts(){
        $response = $this->post('/api/admin/getDepartmentParts');
        $response->assertStatus(401);
    }
    public function test_api_admin_addUser(){
        $response = $this->post('/api/admin/addUser');
        $response->assertStatus(401);
    }
    public function test_api_admin_changeUser(){
        $response = $this->post('/api/admin/changeUser');
        $response->assertStatus(401);
    }
    public function test_api_admin_destroyUser(){
        $response = $this->post('/api/admin/destroyUser');
        $response->assertStatus(401);
    }
    public function test_api_admin_getPostGroup(){
        $response = $this->post('/api/admin/getPostGroup');
        $response->assertStatus(401);
    }
    public function test_api_admin_addGroup(){
        $response = $this->post('/api/admin/addGroup');
        $response->assertStatus(401);
    }
    public function test_api_admin_changeGroup(){
        $response = $this->post('/api/admin/changeGroup');
        $response->assertStatus(401);
    }
    public function test_api_admin_addPost(){
        $response = $this->post('/api/admin/addPost');
        $response->assertStatus(401);
    }
    public function test_api_admin_destroyPost(){
        $response = $this->post('/api/admin/destroyPost');
        $response->assertStatus(401);
    }
    public function test_api_admin_changePost(){
        $response = $this->post('/api/admin/changePost');
        $response->assertStatus(401);
    }
    public function test_api_admin_downloadUser(){
        $response = $this->post('/api/admin/downloadUser');
        $response->assertStatus(401);
    }
    public function test_api_admin_downloadGroupsAndParts(){
        $response = $this->post('/api/admin/downloadGroupsAndParts');
        $response->assertStatus(401);
    }
    public function test_api_admin_importUsers(){
        $response = $this->post('/api/admin/importUsers');
        $response->assertStatus(401);
    }
    public function test_api_admin_importGroupsAndPosts(){
        $response = $this->post('/api/admin/importGroupsAndPosts');
        $response->assertStatus(401);
    }
}
