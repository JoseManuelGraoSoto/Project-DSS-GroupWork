<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Reward;
use App\Models\User;
use DateTime;

class Reward_userTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Reward()
    {        
        $new_Reward= new Reward;
        $new_Reward->points = 4;
        $new_Reward->month = new DateTime('2022-03-29');
        $new_Reward->isModerator = true;
        $new_Reward->user_id = 1;
        $new_Reward->save();

        $new_user = new User;
        $new_user->name = 'Óscar';
        $new_user->type = 'reader';
        $new_user->email = 'oscar@gmail.com';
        $new_user->password = 'holaContra';
        $new_user->telephone = '965354870';
        $new_user->save();

        $new_Reward->user()->associate($new_user);
        $new_Reward->save();

        $this->assertEquals($new_Reward->user_id, $new_user->id);


    }
}
