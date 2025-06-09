<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Medico;
use App\Models\Paciente;
use App\Models\Farmaceutico;
use App\Models\Receita;
use App\Models\Lembrete;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Usuários genéricos
        User::factory(10)->create();

        // Médicos, Pacientes e Farmacêuticos
        Medico::factory(10)->create();
        Paciente::factory(10)->create();
        Farmaceutico::factory(10)->create();

        // Criar receitas e lembretes para cada paciente
        Paciente::all()->each(function ($paciente) {
            $medico = Medico::inRandomOrder()->first();

            Receita::factory(5)->create([
                'paciente_id' => $paciente->id,
                'medico_id' => $medico->id,
            ]);

            Lembrete::factory(5)->create([
                'paciente_id' => $paciente->id,
                'medico_id' => $medico->id,
            ]);
        });

        // Usuário + Médico
        $user = User::factory()->create([
            'name' => 'Medico User',
            'email' => 'medico@example.com',
            'username' => 'medico_user',
            'password' => bcrypt('1234'),
        ]);
        Medico::factory()->create([
            'usuario' => $user->id,
            'crm' => 'CRM-8089790',
        ]);

        // Usuário + Paciente
        $user = User::factory()->create([
            'name' => 'Paciente User',
            'email' => 'paciente@example.com',
            'username' => 'paciente_user',
            'password' => bcrypt('1234'),
        ]);
        $paciente = Paciente::factory()->create([
            'usuario' => $user->id,
        ]);
        Receita::factory(5)->create([
            'paciente_id' => $paciente->id,
            'medico_id' => Medico::inRandomOrder()->first()->id,
        ]);
        Lembrete::factory(5)->create([
            'paciente_id' => $paciente->id,
            'medico_id' => Medico::inRandomOrder()->first()->id,
        ]);

        // Usuário + Farmacêutico
        $user = User::factory()->create([
            'name' => 'Farmaceutico User',
            'email' => 'farmaceutico@example.com',
            'username' => 'farmaceutico_user',
            'password' => bcrypt('1234'),
        ]);
        Farmaceutico::factory()->create([
            'usuario' => $user->id,
        ]);
    }
}
