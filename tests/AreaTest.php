<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class AreaTest extends TestCase
{
    /* apenas testando se consegue inserir e se utilizou o valor default em 'tipo' */
    public function test_create_area(){
        \App\Models\Area::create(['base'=>6,'altura'=>4,'area'=>24]);
        $this->seeInDatabase('areas', ['base'=>6,'altura'=>4,'area'=>24,'tipo'=>0]);
    }
}
