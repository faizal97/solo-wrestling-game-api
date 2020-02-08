<?php

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            [
                'id' => 1,
                'first_name' => 'Faizal',
                'last_name' => 'Ardian Putra',
                'email' => 'faizalardianputra@yahoo.co.id',
                'email_verified_at' => now(),
                'password' => bcrypt('12345'),
                'api_token' => null,
            ],
            [
                'id' => 2,
                'first_name' => 'Fayz',
                'last_name' => 'Ard',
                'email' => 'citizens1997@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('12345'),
                'api_token' => null,
            ],

        ];

        foreach ($datas as $data)
        {
            $primaryKey = [
                'id' => $data['id'],
            ];
            
            User::updateOrCreate($primaryKey, $data);
        }
    }
}
