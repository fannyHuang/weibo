<?php

use Illuminate\Database\Seeder;
use App\Models\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users= factory(User::class)->times(50)->make();
        User::insert($users->makeVisible(['password','remeber_token'])->toArray());
        $user = User::find(1);
        $user->name = 'sufan';
        $user->email = '491585767@qq.com';
        $user->is_admin = true;
        $user->save();
    }
}
