<?php 

namespace App\tests;
use App\Controllers\Auth;
use PHPUnit\Framework\TestCase;

final class authTest extends testCase{

	public function testCanBeCreatedFromPushAlert()
    {
    	$actual = new Auth();
    	$actual = $actual->push();

        $this->assertEquals(
            1 , $actual
            
        );
    }

} 