<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AlumniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for($x = 1; $x <= 500; $x++){
 
        	// insert data dummy pegawai dengan faker
        	DB::table('tbl_alumni')->insert([
        		'nim' => $faker->numberBetween($min = 1000000000, $max = 9999999999),
        		'nama_alumni' => $faker->name,
        		'tmp_lahir' => $faker->state,
        		'tgl_lahir' => $faker->date($format = 'Y-m-d', $max = 'now'),
        		'jenis_kelamin' => $faker->numberBetween($min = 0, $max = 1),
        		'alamat' => $faker->address,
        	]);
 
        }
    }
}
