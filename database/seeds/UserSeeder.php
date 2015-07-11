<?php

use App\Models\ORM\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		User::create(array(
			'name' => 'pandu',
			'email' => 'anpandumail@gmail.com',
			'password' => crypt('pandu'),
			'picture' => 'http://0.gravatar.com/avatar/4c35d531244ef10e5f2dcc9ee36e2c8c?size=400'
		));
	}

}
