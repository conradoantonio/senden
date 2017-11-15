<?php

use App\User;
use App\UserType;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'name' => 'Senden Admin',
            'name' => 'Sendenboy',
            'name' => 'Business Admin',
            'name' => 'Salesman',
        ];

        foreach ($types as $type) {
            factory(UserType::class)->create([
                'name' => $type,
            ]);
        }

        $rolId = Rol::where('nombre', 'Administrador')->first()->id;

        $admin = factory(User::class)->create([
        	'rol_id' => $rolId,
            'nombre' => 'Administrador',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'api_token' => str_random(60),
        ]);

        $admin->save();
    }
}
