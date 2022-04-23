<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Seeder;


class LessonSeeder extends Seeder
{
  /**
   * Run the database seeders.
   *
   * @return void
   */
  public function run()
  {

    Lesson::factory(50)->create();
    Lesson::factory(3)->create([
      'course_id' => 51,
    ]);
    Lesson::factory(3)->create([
      'course_id' => 52,
    ]);
    Lesson::factory(3)->create([
      'course_id' => 53,
    ]);
  }
}
