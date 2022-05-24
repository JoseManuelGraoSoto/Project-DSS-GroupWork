<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Reward;
use App\Models\User;
use \DateTime;

class RewardTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreate()
    {
        $user = User::find(1);
        $new_Reward = new Reward;
        $new_Reward->points = 4;
        $new_Reward->month = new DateTime('2022-03-29');
        $new_Reward->isModerator = true;
        $new_Reward->user()->associate($user);
        $new_Reward->save();
        $Reward = Reward::where('points', 4)->firstOrFail();
        $this->assertEquals($new_Reward->points, $Reward->points);
    }

    public function testRead()
    {
        $Reward = Reward::where('points', 4)->firstOrFail();
        $this->assertEquals($Reward->points, 4);
    }

    public function testUpdate()
    {
        $Reward = Reward::where('points', 4)->firstOrFail();
        $Reward->points = 5;
        $Reward->save();
        $updated_Reward = Reward::where('points', 5)->firstOrFail();
        $this->assertEquals($updated_Reward->points, 5);
    }

    public function testDelete()
    {
        $num_Reward = Reward::all()->count();
        $Reward = Reward::firstOrFail();
        $Reward->delete();
        $num_Reward_deleted = Reward::all()->count();
        $this->assertTrue($num_Reward > $num_Reward_deleted);
    }
}
