<?php
use Database\Migration;

class User extends Migration
{
    public function change()
    {
        // create the table
        $table = $this->table('users', ['id' => true]);
        $table->addColumn('created', 'datetime')
              ->create();
    }
}
