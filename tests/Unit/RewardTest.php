<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Reward;
use \DateTime;

class RewardTest extends TestCase {    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreate(){
        $new_Reward= new Reward;
        $new_Reward->points = 4;
        $new_Reward->month = new DateTime('2022-03-29');
        $new_Reward->isModerator = true;
        $new_Reward->article_id = 1;
        $new_Reward->save();
        $Reward = Reward::where('points', 4)-> first(); 
        $this->assertEquals($new_Reward->points, $Reward->points);
    }

    public function testRead() {
        $Reward = Reward::where('points',4)->first();
        $this->assertEquals($Reward->points,4);
    }

    public function testUpdate(){
        $Reward = Reward::where('points',4)->first();
        $Reward->points = 5;
        $Reward->save();
        $updated_Reward = Reward::where('points',5)->first();
        $this->assertEquals($updated_Reward->points, 5);
    }

    public function testDelete(){
        $num_Reward = Reward::all()->count();
        $Reward = Reward::first();
        $Reward->delete();
        $num_Reward_deleted = Reward::all()->count();
        $this->assertTrue($num_Reward > $num_Reward_deleted);
    }

}
