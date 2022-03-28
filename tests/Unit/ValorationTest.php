<?php
// php artisan migrate:refresh --seed
namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Valoration;

class ValorationTest extends TestCase {
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreate(){
        $new_Valoration= new Valoration;
        $new_Valoration->value = 4;
        $new_Valoration->comment = 'Todo perfecto, mucho texto';
        $new_Valoration->isModerator = true;
        $new_Valoration->save();
        $valoration = Valoration::where('value', 4)-> first(); 
        $this->assertEquals($new_valoration->value, $valoration->value);
    }

    public function testRead() {
        $valoration = Valoration::where('comment','Todo perfecto, mucho texto')->first();
        $this->assertEquals($valoration->comment,'Todo perfecto, mucho texto');
    }

    public function testUpdate(){
        $valoration = Valoration::where('value',4)->first();
        $valoration->value = 5;
        $valoration->comment = 'Perfecto';
        $valoration->save();
        $updated_valoration = Valoration::where('value',5)->first();
        $this->assertEquals($updated_valoration->comment, 'Perfecto');
    }

    public function testDelete(){
        $num_valoration = Valoration::all()->count();
        $valoration = Valoration::first();
        $valoration->delete();
        $num_valoration_deleted = Valoration::all()->count();
        $this->assertTrue($num_valoration > $num_valoration_deleted);
    }
}
/* 
        $new_valoration->name = 'valorationname';
        $new_valoration->type = 'Lector';
        $new_valoration->email = 'name@domain.com ';
        $new_valoration->password = 'strongpassword';
        $new_valoration->telephone = '966999999';
        */