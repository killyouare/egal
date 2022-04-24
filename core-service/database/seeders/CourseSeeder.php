<?php

namespace Database\Seeders;

use App\Models\Course;
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
    Course::factory(53)->create([
      "start_date" => "2050-01-01",
      'end_date' => '2050-03-05'
    ]);
  }
}
