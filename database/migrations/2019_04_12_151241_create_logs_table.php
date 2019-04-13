<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'logs', function ( Blueprint $table ) {
			$table->bigIncrements( 'id' );
			$table->text( 'method' )->nullable();
			$table->text( 'url' )->nullable();
			$table->text( 'param' )->nullable();
			$table->text( 'ip' )->nullable();
			$table->text( 'user' )->nullable();
			$table->timestamps();
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists( 'logs' );
	}
}
