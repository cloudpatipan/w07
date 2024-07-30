<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as FakerFactory;

class VaccineRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create('th');

        $vaccines = [];
        for ($i = 0; $i < 100; $i++) {
            $vaccines[] = [
                'std_id' => rand(1, 10),
                'vac_id' => rand(1, 10),
                'vaccined_date' => $faker->dateTimeBetween($startDate = "-2 years", $endDate = 'now')->format('Ymd'),
            ];
        }

        DB::table('vaccine_record')->insert($vaccines);
    }
}
