<?php

namespace Tests\Unit;

use Tests\TestCase;


class RegistrationTest extends TestCase
{
    public function test_registration_invalid_empty() // TC-Reg-29
    {
        $response = $this->post('/register', []);
        $response->assertSessionHasErrors([
            'id_number' => 'NIK wajib diisi',
            'name' => 'Nama lengkap wajib diisi',
            'birth_date' => 'Tanggal lahir wajib diisi',
            'gender' => 'Jenis kelamin wajib diisi',
            'phone_number' => 'Nomor Telpon wajib diisi',
            'username' => 'Nama Pengguna wajib diisi',
            'email' => 'Email wajib diisi',
            'password'=>'Password wajib diisi',
        ]);
    }

    public function test_registration_valid_default()// TC-Reg-1
    {
        $response = $this->post('/register', [
            'id_number' => '3510084207030003',
            'name' => 'Tuan Deban XII',
            'birth_date' => '2004-08-11',
            'gender' => 'pria',
            'phone_number' => '08383012179',
            'username' => 'debanxii',
            'email' => 'deban@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);
        $response->assertStatus(302);
    }

    public function test_registration_valid_nik()// TC-Reg-2
    {
        $response = $this->post('/register', [
            'id_number' => '3510084207030003',
            'name' => 'Tuan Deban XII',
            'birth_date' => '2004-08-11',
            'gender' => 'pria',
            'phone_number' => '08383012179',
            'username' => 'debanxii',
            'email' => 'deban@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);
        $response->assertStatus(302);
    }

    public function test_registration_invalid_nik_bb()// TC-Reg-3
    {
        $response = $this->post('/register', [
            'id_number' => '351008420703000',
            'name' => 'Tuan Deban XII',
            'birth_date' => '2004-08-11',
            'gender' => 'pria',
            'phone_number' => '08383012179',
            'username' => 'debanxii',
            'email' => 'deban@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);
        $response->assertSessionHasErrors([
            'id_number' => 'NIK harus terdiri dari 16 digit angka',
        ]);
    }

    public function test_registration_invalid_nik_ba()// TC-Reg-4
    {
        $response = $this->post('/register', [
            'id_number' => '35100842070300031',
            'name' => 'Tuan Deban XII',
            'birth_date' => '2004-08-11',
            'gender' => 'pria',
            'phone_number' => '08383012179',
            'username' => 'debanxii',
            'email' => 'deban@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);
        $response->assertSessionHasErrors([
            'id_number' => 'NIK harus terdiri dari 16 digit angka',
        ]);
    }

    public function test_registration_invalid_nik_empty()// TC-Reg-5
    {
        $response = $this->post('/register', [
            'id_number' => '',
            'name' => 'Tuan Deban XII',
            'birth_date' => '2004-08-11',
            'gender' => 'pria',
            'phone_number' => '08383012179',
            'username' => 'debanxii',
            'email' => 'deban@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);
        $response->assertSessionHasErrors([
            'id_number' => 'NIK wajib diisi',
        ]);
    }

    public function test_registration_valid_uname_bb()// TC-Reg-6
    {
        $response = $this->post('/register', [
            'id_number' => '3510084207030003',
            'name' => 'Tuan Deban XII',
            'birth_date' => '2004-08-11',
            'gender' => 'pria',
            'phone_number' => '08383012179',
            'username' => 'debanx',
            'email' => 'deban@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);
        $response->assertStatus(302);
    }

    public function test_registration_valid_uname_ba()// TC-Reg-7
    {
        $response = $this->post('/register', [
            'id_number' => '3510084207030003',
            'name' => 'Tuan Deban XII',
            'birth_date' => '2004-08-11',
            'gender' => 'pria',
            'phone_number' => '08383012179',
            'username' => 'debanxiidebanxiixiixiixii',
            'email' => 'deban@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);
        $response->assertStatus(302);
    }

    public function test_registration_invalid_uname_ba()// TC-Reg-8
    {
        $response = $this->post('/register', [
            'id_number' => '3510084207030003',
            'name' => 'Tuan Deban XII',
            'birth_date' => '2004-08-11',
            'gender' => 'pria',
            'phone_number' => '08383012179',
            'username' => 'debanxiidebanxiixiixiixiid',
            'email' => 'deban@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);
        $response->assertSessionHasErrors(['username']);
    }

    public function test_registration_invalid_uname_bb()// TC-Reg-9
    {
        $response = $this->post('/register', [
            'id_number' => '3510084207030003',
            'name' => 'Tuan Deban XII',
            'birth_date' => '2004-08-11',
            'gender' => 'pria',
            'phone_number' => '08383012179',
            'username' => 'deban',
            'email' => 'deban@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);
        $response->assertSessionHasErrors(['username']);
    }

    public function test_registration_valid_email()// TC-Reg-10
    {
        $response = $this->post('/register', [
            'id_number' => '3510084207030003',
            'name' => 'Tuan Deban XII',
            'birth_date' => '2004-08-11',
            'gender' => 'pria',
            'phone_number' => '08383012179',
            'username' => 'debanx',
            'email' => 'deban@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);
        $response->assertStatus(302);
    }

    public function test_registration_invalid_email()//TC-Reg-11
    {
        $response = $this->post('/register', [
            'id_number' => '3510084207030003',
            'name' => 'Tuan Deban XII',
            'birth_date' => '2004-08-11',
            'gender' => 'pria',
            'phone_number' => '08383012179',
            'username' => 'deban',
            'email' => 'debanexample.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);
        $response->assertSessionHasErrors(['email']);
    }

    public function test_registration_valid_name_ba()// TC-Reg-12
    {
        $response = $this->post('/register', [
            'id_number' => '3510084207030003',
            'name' => 'Tuan Deban XII Tuan Deban XII Tuan Deban XII deban',
            'birth_date' => '2004-08-11',
            'gender' => 'pria',
            'phone_number' => '08383012179',
            'username' => 'debanx',
            'email' => 'deban@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);
        $response->assertStatus(302);
    }

    public function test_registration_valid_name_bb()// TC-Reg-13
    {
        $response = $this->post('/register', [
            'id_number' => '3510084207030003',
            'name' => 'Tuan D',
            'birth_date' => '2004-08-11',
            'gender' => 'pria',
            'phone_number' => '08383012179',
            'username' => 'debanx',
            'email' => 'deban@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);
        $response->assertStatus(302);
    }

    public function test_registration_invalid_name_ba()// TC-Reg-14
    {
        $response = $this->post('/register', [
            'id_number' => '3510084207030003',
            'name' => 'Tuan Deban XII Tuan Deban XII Tuan Deban XII debanx',
            'birth_date' => '2004-08-11',
            'gender' => 'pria',
            'phone_number' => '08383012179',
            'username' => 'debanx',
            'email' => 'deban@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);
        $response->assertSessionHasErrors('name');
    }

    public function test_registration_invalid_name_bb()// TC-Reg-15
    {
        $response = $this->post('/register', [
            'id_number' => '3510084207030003',
            'name' => 'TuanD',
            'birth_date' => '2004-08-11',
            'gender' => 'pria',
            'phone_number' => '08383012179',
            'username' => 'debanx',
            'email' => 'deban@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);
        $response->assertSessionHasErrors('name');
    }

    public function test_registration_valid_phone_bb()// TC-Reg-16
    {
        $response = $this->post('/register', [
            'id_number' => '3510084207030003',
            'name' => 'TuanDb',
            'birth_date' => '2004-08-11',
            'gender' => 'pria',
            'phone_number' => '0838301217',
            'username' => 'debanx',
            'email' => 'deban@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);
        $response->assertStatus(302);
    }

    public function test_registration_invalid_phone_bb()// TC-Reg-17
    {
        $response = $this->post('/register', [
            'id_number' => '3510084207030003',
            'name' => 'TuanDb',
            'birth_date' => '2004-08-11',
            'gender' => 'pria',
            'phone_number' => '083830121',
            'username' => 'debanx',
            'email' => 'deban@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);
        $response->assertSessionHasErrors('phone_number');
    }

    public function test_registration_valid_phone_ba()// TC-Reg-18
    {
        $response = $this->post('/register', [
            'id_number' => '3510084207030003',
            'name' => 'TuanDb',
            'birth_date' => '2004-08-11',
            'gender' => 'pria',
            'phone_number' => '0838301217912',
            'username' => 'debanx',
            'email' => 'deban@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);
        $response->assertStatus(302);
    }

    public function test_registration_invalid_phone_ba()// TC-Reg-19
    {
        $response = $this->post('/register', [
            'id_number' => '3510084207030003',
            'name' => 'TuanDb',
            'birth_date' => '2004-08-11',
            'gender' => 'pria',
            'phone_number' => '08383012179123',
            'username' => 'debanx',
            'email' => 'deban@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);
        $response->assertSessionHasErrors('phone_number');
    }

    public function test_registration_valid_password_bb()// TC-Reg-20
    {
        $response = $this->post('/register', [
            'id_number' => '3510084207030003',
            'name' => 'TuanDb',
            'birth_date' => '2004-08-11',
            'gender' => 'pria',
            'phone_number' => '0838301217912',
            'username' => 'debanx',
            'email' => 'deban@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);
        $response->assertStatus(302);
    }

    public function test_registration_invalid_password_bb()// TC-Reg-21
    {
        $response = $this->post('/register', [
            'id_number' => '3510084207030003',
            'name' => 'TuanDb',
            'birth_date' => '2004-08-11',
            'gender' => 'pria',
            'phone_number' => '0838301217912',
            'username' => 'debanx',
            'email' => 'deban@example.com',
            'password' => 'passwor',
            'password_confirmation' => 'passwor',
        ]);
        $response->assertSessionHasErrors('password');
    }

    public function test_registration_valid_password_ba()// TC-Reg-22
    {
        $response = $this->post('/register', [
            'id_number' => '3510084207030003',
            'name' => 'TuanDb',
            'birth_date' => '2004-08-11',
            'gender' => 'pria',
            'phone_number' => '0838301217912',
            'username' => 'debanx',
            'email' => 'deban@example.com',
            'password' => 'passwordpassword',
            'password_confirmation' => 'passwordpassword',
        ]);
        $response->assertStatus(302);
    }

    public function test_registration_invalid_password_ba()// TC-Reg-23
    {
        $response = $this->post('/register', [
            'id_number' => '3510084207030003',
            'name' => 'TuanDb',
            'birth_date' => '2004-08-11',
            'gender' => 'pria',
            'phone_number' => '0838301217912',
            'username' => 'debanx',
            'email' => 'deban@example.com',
            'password' => 'passwordpassword1',
            'password_confirmation' => 'passwordpassword1',
        ]);
        $response->assertSessionHasErrors('password');
    }

    public function test_registration_valid_password_match()// TC-Reg-24
    {
        $response = $this->post('/register', [
            'id_number' => '3510084207030003',
            'name' => 'TuanDb',
            'birth_date' => '2004-08-11',
            'gender' => 'pria',
            'phone_number' => '0838301217912',
            'username' => 'debanx',
            'email' => 'deban@example.com',
            'password' => 'passwordku',
            'password_confirmation' => 'passwordku',
        ]);
        $response->assertSessionDoesntHaveErrors('password');
    }

    public function test_registration_invalid_password_match()// TC-Reg-25
    {
        $response = $this->post('/register', [
            'id_number' => '3510084207030003',
            'name' => 'TuanDb',
            'birth_date' => '2004-08-11',
            'gender' => 'pria',
            'phone_number' => '0838301217912',
            'username' => 'debanx',
            'email' => 'deban@example.com',
            'password' => 'passwordku',
            'password_confirmation' => 'passworddia',
        ]);
        $response->assertSessionHasErrors('password');
    }

    public function test_registration_invalid_exist_email()// TC-Reg-26
    {
        $response = $this->post('/register', [
            'id_number' => '3510084207030003',
            'name' => 'TuanDb',
            'birth_date' => '2004-08-11',
            'gender' => 'pria',
            'phone_number' => '0838301217912',
            'username' => 'debank',
            'email' => 'debank@mail.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);
        $response->assertSessionHasErrors('email');
    }

    public function test_registration_invalid_exist_uname()// TC-Reg-27
    {
        $response = $this->post('/register', [
            'id_number' => '3510084207030003',
            'name' => 'TuanDb',
            'birth_date' => '2004-08-11',
            'gender' => 'pria',
            'phone_number' => '0838301217912',
            'username' => 'sir_deban',
            'email' => 'deban@mail.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);
        $response->assertSessionHasErrors('username');
    }

    public function test_registration_invalid_exist_nik()// TC-Reg-28
    {
        $response = $this->post('/register', [
            'id_number' => '3510084207030003',
            'name' => 'TuanDb',
            'birth_date' => '2004-08-11',
            'gender' => 'pria',
            'phone_number' => '0838301217912',
            'username' => 'sir_deban',
            'email' => 'deban@mail.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);
        $response->assertSessionHasErrors('id_number');
    }
}
