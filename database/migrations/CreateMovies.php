<?php  
namespace IMDBParser\Database\Migrations;

use \Illuminate\Database\Migrations\Migration;

class CreateMovies extends Migration {

    protected $schemaBuilder = null;
    protected $tableName = 'movies';

    public function __construct($connection = null) {
        $this->connection = $connection;
        $this->schemaBuilder = $this->connection->getSchemaBuilder();
    }
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schemaBuilder->create($this->tableName, function($table)
        {
            $table->increments('id');
            $table->string('title');
            $table->string('year');
            $table->integer('season');
            $table->integer('episode_number');
            $table->string('episode_name');
            $table->string('country');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schemaBuilder->drop($this->tableName);
    }

    public function dropIfExists() {
        $this->schemaBuilder->dropIfExists($this->tableName);
    }

}