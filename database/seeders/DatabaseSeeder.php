<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		// \App\Models\User::factory(10)->create();

		User::factory()->create([
			'name'              => 'Lukabrazi',
			'email'             => 'lukakhangoshvili@gmail.com',
			'password'          => Hash::make('luka123'),
			'email_verified_at' => Carbon::now(),
		]);

		User::factory()->create([
			'name'              => 'luka',
			'email'             => 'luka@gmail.com',
			'password'          => Hash::make('luka123'),
			'email_verified_at' => null,
		]);
	}
}
