<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
  /**
   * Run the database seeders.
   *
   * @return void
   */
  public function run()
  {

    Course::factory(7)->has(Lesson::factory(rand(1, 10)))->create();
  }
}
