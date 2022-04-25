refrerencerefrerence<?php

                    use Illuminate\Database\Migrations\Migration;
                    use Illuminate\Database\Schema\Blueprint;
                    use Illuminate\Support\Facades\Schema;

                    class CreateLessonsTable extends Migration
                    {
                        /**
                         * Run the migrations.
                         *
                         * @return void
                         */
                        public function up()
                        {
                            Schema::create('lessons', function (Blueprint $table) {
                                $table->bigIncrements("id");
                                $table->foreignId('course_id')->constrained()->cascadeOnDelete();
                                $table->string('theme', 256);
                                $table->timestamps();
                            });
                        }

                        /**
                         * Reverse the migrations.
                         *
                         * @return void
                         */
                        public function down()
                        {
                            Schema::dropIfExists('lessons');
                        }
                    }
