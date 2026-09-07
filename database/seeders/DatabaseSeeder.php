<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Training_Center;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'kalilacam787@gmail.com'],
            [
                'name' => 'Kamila Camilo',
                'document_type' => 'CC',
                'document_number' => '1002777104',
                'password' => Hash::make('27294910'),
            ]
        );

        $centers = [
            ['name' => 'Centro Agropecuario', 'location' => 'Km 5 vía al Tambo, Popayán, Cauca'],
            ['name' => 'Centro de Comercio y Servicios', 'location' => 'Calle 4 No. 2-80, Popayán, Cauca'],
            ['name' => 'Centro de Teleinformática y Producción Industrial', 'location' => 'Carrera 9 No. 71N-60, Popayán, Cauca'],
            ['name' => 'Centro Industrial del Cauca', 'location' => 'Carrera 13 No. 3-60, Santander de Quilichao, Cauca'],
            ['name' => 'Centro Agropecuario de Buga', 'location' => 'Buga, Valle del Cauca'],
            ['name' => 'Centro de Biotecnología Industrial', 'location' => 'Palmira, Valle del Cauca'],
            ['name' => 'Centro de Electricidad y Automatización Industrial', 'location' => 'Cali, Valle del Cauca'],
            ['name' => 'Centro de la Construcción', 'location' => 'Cali, Valle del Cauca'],
            ['name' => 'Centro de Diseño Tecnológico Industrial', 'location' => 'Cali, Valle del Cauca'],
            ['name' => 'Centro de Gestión Tecnológica de Servicios', 'location' => 'Cali, Valle del Cauca'],
            ['name' => 'Centro Latinoamericano de Especies Menores y Tecnologías Agropecuarias', 'location' => 'Tuluá, Valle del Cauca'],
            ['name' => 'Centro Náutico Pesquero', 'location' => 'Buenaventura, Valle del Cauca'],
            ['name' => 'Centro Nacional de Asistencia Técnica a la Industria - ASTIN', 'location' => 'Cali, Valle del Cauca'],
            ['name' => 'Centro de Tecnologías Agroindustriales', 'location' => 'Cartago, Valle del Cauca'],
        ];

        $centerIds = collect($centers)->mapWithKeys(function (array $center) {
            return [$center['name'] => Training_Center::updateOrCreate(['name' => $center['name']], $center)->id];
        });

        $courses = [
            ['course_number' => 'ADS-001', 'name' => 'Técnico en Análisis y Desarrollo de Software', 'day' => 'Lunes a viernes', 'schedule' => '8:00 a. m. - 12:00 m.', 'duration_months' => 14],
            ['course_number' => 'SIS-002', 'name' => 'Técnico en Sistemas y Soporte Técnico', 'day' => 'Lunes a viernes', 'schedule' => '2:00 p. m. - 6:00 p. m.', 'duration_months' => 14],
            ['course_number' => 'ADM-003', 'name' => 'Técnico en Gestión Administrativa', 'day' => 'Lunes, miércoles y viernes', 'schedule' => '8:00 a. m. - 12:00 m.', 'duration_months' => 14],
            ['course_number' => 'CON-004', 'name' => 'Técnico en Contabilidad y Finanzas', 'day' => 'Martes y jueves', 'schedule' => '2:00 p. m. - 6:00 p. m.', 'duration_months' => 14],
            ['course_number' => 'ELE-005', 'name' => 'Curso de Electricidad Residencial', 'day' => 'Lunes a viernes', 'schedule' => '6:00 p. m. - 10:00 p. m.', 'duration_months' => 3],
            ['course_number' => 'GAS-006', 'name' => 'Curso de Cocina y Gastronomía', 'day' => 'Sábados', 'schedule' => '8:00 a. m. - 4:00 p. m.', 'duration_months' => 2],
            ['course_number' => 'DIS-007', 'name' => 'Curso de Diseño Gráfico y Multimedia', 'day' => 'Martes y jueves', 'schedule' => '8:00 a. m. - 12:00 m.', 'duration_months' => 3],
            ['course_number' => 'LOG-008', 'name' => 'Técnico en Logística y Cadena de Suministro', 'day' => 'Lunes, miércoles y viernes', 'schedule' => '2:00 p. m. - 6:00 p. m.', 'duration_months' => 14],
            ['course_number' => 'AUT-009', 'name' => 'Técnico en Automatización Industrial', 'day' => 'Lunes a viernes', 'schedule' => '6:00 p. m. - 10:00 p. m.', 'duration_months' => 14],
        ];

        foreach ($courses as $index => $course) {
            $course['training_center_id'] = $centerIds->values()->get($index % $centerIds->count());
            Course::updateOrCreate(['course_number' => $course['course_number']], $course);
        }
    }
}
