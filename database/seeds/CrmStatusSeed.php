<?php

use Illuminate\Database\Seeder;

class CrmStatusSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'title' => 'Lead',],
            ['id' => 2, 'title' => 'Customer',],
            ['id' => 3, 'title' => 'Partner',],

        ];

        foreach ($items as $item) {
            \App\CrmStatus::create($item);
        }
    }
}
