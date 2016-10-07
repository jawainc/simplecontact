<?php namespace Zainab\SimpleContact\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateZainabSimplecontactContact extends Migration
{
    public function up()
    {
        Schema::create('zainab_simplecontact_contact', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('subject')->nullable();
            $table->text('message')->nullable();
            $table->boolean('is_new')->default(1);
            $table->timestamp('created_at')->default('0000-00-00');
            $table->timestamp('updated_at')->default('0000-00-00');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('zainab_simplecontact_contact');
    }
}
