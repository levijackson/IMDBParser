<?php  
namespace IMDBParser\Database\Migrations;

use \Illuminate\Database\Migrations\Migration;

class CreateGenreMovie extends Migration {

    protected $schemaBuilder = null;
    protected $tableName = 'genre_movie';

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
            $table->integer('genre_id');
            $table->integer('movie_id');
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