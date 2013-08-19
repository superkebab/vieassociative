<?php

use Illuminate\Database\Migrations\Migration;

class CompleteAssociationProfile extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('association', function($table)
		{
			$table->string('legal_name');
			$table->string('goal');
			$table->string('website_url');
			$table->date('official_date_creation');
			$table->string('headquater');
			$table->boolean('admitted_public_utility');
			$table->integer('general_information_completed');
			$table->integer('vieassociative_page_completed');
			$table->integer('nb_publications');
			$table->integer('nb_photos');
			$table->integer('nb_evenements');
			$table->integer('nb_social_connected');
			$table->integer('nb_administrator');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}