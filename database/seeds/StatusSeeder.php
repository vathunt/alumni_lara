<?php

use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 2; $i++) { 
        	$status = $i == 1 ? 'admin' : 'alumni';
        	DB::table('tbl_status')->insert([
            'status' => $status
        ]);
        }
    }
}
