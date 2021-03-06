<?php

use Illuminate\Database\Migrations\Migration;

class FromScratch extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$this->down();
		Schema::create('association', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('name');
			$table->string('slug');
			$table->string('acronym');
			$table->boolean('active');
			$table->integer('id_logo');
			$table->timestamps();
		});

		Schema::create('user', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');

			$table->string('username')->unique('username');
			$table->string('name');
			$table->string('email')->unique('email');
			$table->string('password',128);
			$table->string('level')->default('user');
			$table->string('firstname');
			$table->string('lastname');

			$table->timestamps();

			$table->integer('state');
		});

		Schema::create('connexion_tentative', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('ip',15);
			$table->timestamps();
		});

		Schema::create('evenement', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');

			$table->integer('id_assoc');
			$table->integer('id_user');
			$table->integer('id_lieu');

			$table->boolean('active');

			$table->timestamps();
			$table->dateTime('date_deb');
			$table->dateTime('date_fin');

			$table->string('titre', 100);
			$table->text('texte');
			$table->integer('type_repetition'); // ?????

			$table->integer('id_photo');
			$table->integer('id_type_evenement');
			$table->integer('id_type_sous_evenement');

			$table->string('ip', 15);
		});




		Schema::create('evenement_repete_jour', function($table){
			$table->engine = 'InnoDB';

			$table->integer('id_evenement');
			$table->integer('id_jour');

			$table->time('hd');
			$table->time('hf');
		});





		Schema::create('lieu', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');

			$table->string('libelle');
			$table->string('ville');
			$table->float('latitude');
			$table->float('longitude');
		});

		Schema::create('type_evenement', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');

			$table->string('libelle');
		});

		Schema::create('type_sous_evenement', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');

			$table->integer('id_type_evenement');
			$table->string('libelle');
		});


		


		Schema::create('user_association', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');

			$table->integer('id_user')->unsigned();
			$table->foreign('id_user')->references('id')->on('user');
			$table->integer('id_assoc')->unsigned();
			$table->foreign('id_assoc')->references('id')->on('association');
			$table->string('link',30);

			$table->timestamps();
		});


		Schema::create('user_token', function($table){
			$table->engine = 'InnoDB';
			$table->integer('id_user');
			$table->string('token',250);
			$table->timestamp('date_fin');
		});


	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('connexion_tentative');
		Schema::dropIfExists('evenement');
		Schema::dropIfExists('evenement_repete_jour');
		Schema::dropIfExists('image');
		Schema::dropIfExists('lieu');
		Schema::dropIfExists('type_evenement');
		Schema::dropIfExists('type_sous_evenement');
		Schema::dropIfExists('user_association');
		Schema::dropIfExists('user_token');
		Schema::dropIfExists('user');
		Schema::dropIfExists('association');
	}

}