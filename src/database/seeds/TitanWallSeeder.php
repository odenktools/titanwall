<?php

use Illuminate\Database\Seeder;

class TitanWallSeeder extends Seeder
{
	public function run()
	{
		$prefix = Config::get('titanwall.prefix', '');

		$role_admin = DB::table($prefix . 'role')->insertGetId([
			'role_name' 		=> Config::get('titanwall.super_admin'),
			'role_description' 	=> 'SuperAdmin Role, Can manage everythings',
			'is_active' 		=> 1,
			'is_purchaseable' 	=> 0,
			'amount' 			=> 0,
			'price' 			=> 0,
			'time_left' 		=> 0,
			'quantity' 			=> 0,
			'period' 			=> 'D',
			'is_builtin' 		=> 1,
			'backcolor' 		=> 'c32113',
			'forecolor' 		=> 'white',
			'created_at' 		=> date('Y-m-d H:i:s'),
			'updated_at' 		=> date('Y-m-d H:i:s')
		]);
		
		$role_member = DB::table($prefix . 'role')->insertGetId([
			'role_name' 		=> 'member',
			'role_description' 	=> 'User is member',
			'is_active' 		=> 1,
			'is_purchaseable' 	=> 1,
			'amount' 			=> 10,
			'price' 			=> 10,
			'time_left' 		=> 1,
			'quantity' 			=> 10,
			'period' 			=> 'M',
			'is_builtin' 		=> 1,
			'backcolor' 		=> '00c12e',
			'forecolor' 		=> 'white',
			'created_at' 		=> date('Y-m-d H:i:s'),
			'updated_at' 		=> date('Y-m-d H:i:s')
		]);
		
		$user_admin = DB::table($prefix . 'user')->insertGetId([
            'username' 		=> 'admin',
            'user_mail' 	=> 'admin@example.com',
            'email' 		=> 'admin@example.com',
            'password' 		=> '$2y$10$B77TiIMLObUS6L2mExjhKuW4tU.G6WrkZd8d9ZdltknmnLVRIZDBe', //'admin123456',
			'is_builtin' 	=> 1,
            'verified' 		=> 1,
            'is_active' 	=> 1
			'created_at' 	=> date('Y-m-d H:i:s'),
			'updated_at' 	=> date('Y-m-d H:i:s')
		]);
		
		$user_member = DB::table($prefix . 'user')->insertGetId([
            'username' 		=> 'member',
            'user_mail' 	=> 'member@example.com',
            'email' 		=> 'member@example.com',
            'password' 		=> '$2y$10$ISRcd1y3.RHf3D3zFUinheMbc.M6i/9Hvq4LGP5TPAXcdsM25xrqW', //'member123456',
			'is_builtin' 	=> 1,
            'verified' 		=> 1,
            'is_active' 	=> 1
			'created_at' 	=> date('Y-m-d H:i:s'),
			'updated_at' 	=> date('Y-m-d H:i:s')
		]);
		
		DB::table($prefix . 'user_roles')->insert([
			'user_id' => $user_admin,
			'role_id' => $role_admin,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		]);
		
		DB::table($prefix . 'user_roles')->insert([
			'user_id' => $user_member,
			'role_id' => $role_member,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		]);
		
		$this->command->info('User table seeded!');
	}
}