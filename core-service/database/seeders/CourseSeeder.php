<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

// Лишний отступ
// Форматирование кода
class CourseSeeder extends Seeder
{
  /**
   * Run the database seeders.
   *
   * @return void
   */
  public function run()
  {
      // start/end Генерировать через faker
    Course::factory(7)->create([
      "start_date" => "2050-01-01",
      'end_date' => '2050-03-05'
    ]);
  }
}
