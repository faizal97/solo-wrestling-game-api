<?php

use App\Models\UserRoles;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
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
                'user_role_id' => 'super-admin',
            ],
            [
                'user_role_id' => 'admin'
            ],
            [
                'user_role_id' => 'wrestler'
            ],
            [
                'user_role_id' => 'user'
            ],
        ];

        foreach ($datas as $data)
        {
            UserRoles::updateOrCreate([
                'user_role_id' => $data['user_role_id'],
            ], $data);
        }
    }
}
