<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\TaskLoan\User::class, 1)->state('student-role')->create();
        factory(\TaskLoan\User::class, 1)->state('taskmaster-role')->create()->each(function ($user) {
            $count = 0;
            while ($count < 15) {
                $user->tasks()->save(factory(TaskLoan\Task::class)->make());
                $count++;
            }
        });
    }
}
