<?php

use App\Models\ApiKeys;
use Illuminate\Database\Seeder;

class ApiKeySeeder extends Seeder
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
                'id' => '1',
                'name' => 'app',
                'key' => 'Glf6DtL4XgGfO86mAunyvD7Vi65hrm1nPSK4XCKS8CXvmCexqTlc1hKSsYo7V1Ib',
                'active' => '1',
            ]
        ];

        foreach ($datas as $data)
        {
            $primaryKey = [
                'id' => $data['id'],
            ];
            unset($data['id']);

            ApiKeys::updateOrCreate($primaryKey, $data);
        }
    }
}
