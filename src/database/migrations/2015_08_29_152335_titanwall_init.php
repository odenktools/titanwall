<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * @todo
 *
 * @license MIT
 *
 */
class TitanWallInit extends Migration
{
	public function __construct()
	{
		$this->prefix = Config::get('titanwall.prefix', '');
	}
	
    /**
     * Run the migrations.
     * @return void
     */
	public function up()
	{
		$prefix = $this->prefix;

		Schema::create($prefix . 'role', function($table)
		{
			$table->engine = 'InnoDB';
			
			//$table->primary('id_role');
			$table->increments('id_role');
			$table->string('role_name', 50)->index();
			$table->text('role_description')->nullable();
			$table->tinyInteger('is_active')->default(0);
			$table->tinyInteger('is_purchaseable')->default(0);
			$table->decimal('amount', 10,2)->nullable();
			$table->decimal('price', 10,2)->nullable();
			$table->integer('time_left')->default(0);
			$table->integer('quantity')->default(0);
			$table->string('period', 1)->nullable();
			$table->tinyInteger('is_builtin')->default(0);
			$table->string('backcolor', 24);
			$table->string('forecolor', 24);
			$table->timestamps();
			$table->softDeletes();

		});

		Schema::create($prefix . 'users', function($table)
		{
			$table->engine = 'InnoDB';
			
			//$table->primary('id_user');
			$table->increments('id_user');
			$table->string('username', 128)->index();
			$table->string('user_mail', 128)->unique();
			$table->string('email', 128)->unique();
			$table->string('password', 128);
			$table->string('salt', 50);
			$table->string('activation_code', 50)->nullable();
			$table->integer('is_builtin')->default(0);
			$table->integer('is_active')->default(0);
			$table->integer('verified')->default(0);
			$table->dateTime('expire_date')->nullable();
			$table->string('time_zone', 64)->nullable();
			$table->timestamp('last_login')->nullable();
			$table->rememberToken();
			$table->string('forgotten_password_code', 50)->nullable();
			$table->dateTime('forgotten_password_time')->nullable();
			$table->timestamps();
			
		});
		
		Schema::create($prefix . 'user_group_fields', function($table) use ($prefix)
		{
			$table->engine = 'InnoDB';
			
			//$table->primary('id_group_field');
			$table->increments('id_group_field');
			$table->string('group_name', 50)->index();
			$table->text('group_description')->nullable();
			$table->tinyInteger('group_order')->default(0);
			$table->tinyInteger('is_active')->default(0);
			$table->tinyInteger('admin_use_only')->default(0);
			
		});
		
		Schema::create($prefix . 'field_types', function($table) use ($prefix)
		{
			$table->engine = 'InnoDB';
			
			//$table->primary('id_group_field');
			$table->increments('id_field_type');
			$table->string('field_name', 50)->index();
			$table->text('field_description')->nullable();
			$table->integer('field_size')->default(0);
			$table->timestamps();
			
		});
		
		
		Schema::create($prefix . 'menu', function($table) use ($prefix)
		{
			$table->engine = 'InnoDB';
			
			//$table->primary('id_group_field');
			$table->increments('id_menu');
			$table->integer('parent_menu')->default(0);
			$table->string('menu_title', 50)->index();
			$table->string('menu_name', 50)->index();
			$table->string('menu_type', 50)->nullable();
			$table->string('js_module_name', 128)->nullable();
			$table->string('menu_route', 128)->nullable();
			$table->string('assets_url', 128)->nullable();
			$table->string('image', 128)->nullable();
			$table->tinyInteger('active')->default(0);
			$table->timestamps();
			
		});
		
		//========================= DETAIL ==================================
		
		Schema::create($prefix . 'user_roles', function($table) use ($prefix)
		{
			$table->engine = 'InnoDB';

			//$table->primary('id_user_roles');
			$table->increments('id_user_roles');
			$table->integer('user_id')->unsigned();
			$table->integer('roles_id')->unsigned();

			$table->foreign('user_id')->references('id_user')->on($prefix . 'users');
			$table->foreign('roles_id')->references('id_role')->on($prefix . 'role');
			
		});

		
		Schema::create($prefix . 'user_fields', function($table) use ($prefix)
		{
			$table->engine = 'InnoDB';
			
			$table->increments('id_user_field');
			$table->integer('field_type_id')->unsigned();
			$table->integer('group_field_id')->unsigned();
			$table->string('field_name', 50)->index();
			$table->text('field_comment', 50)->nullable();
			$table->string('possible_values', 50);
			$table->string('text_select_value', 50);
			$table->tinyInteger('is_mandatory')->default(0);
			$table->tinyInteger('field_order')->default(0);
			$table->tinyInteger('sort_values')->default(0);
			$table->tinyInteger('is_active')->default(0);
			$table->tinyInteger('show_in_signup')->default(0);
			$table->tinyInteger('admin_use_only')->default(0);
			$table->tinyInteger('vertical_layout')->default(0);
			$table->tinyInteger('is_encrypted')->default(0);
			$table->timestamps();
			$table->softDeletes();
			
			$table->foreign('field_type_id')->references('id_field_type')->on($prefix . 'field_types');
			$table->foreign('group_field_id')->references('id_group_field')->on($prefix . 'user_group_fields');
			
		});
		
		Schema::create($prefix . 'user_profile_fields', function($table) use ($prefix)
		{
			$table->engine = 'InnoDB';
			
			$table->increments('id_profile');
			$table->integer('user_id')->unsigned();
			$table->integer('userfield_id')->unsigned();
			$table->text('field_value')->nullable();
			
			$table->foreign('user_id')->references('id_user')->on($prefix . 'users');
			$table->foreign('userfield_id')->references('id_user_field')->on($prefix . 'user_fields');
			
		});		

		
		

	}
	
    /**
     * Reverse the migrations.
     * @return void
     */
	public function down()
	{
		
		Schema::drop($this->prefix . 'user_profile_fields');
		Schema::drop($this->prefix . 'user_fields');
		Schema::drop($this->prefix . 'user_roles');
		Schema::drop($this->prefix . 'users');
		Schema::drop($this->prefix . 'role');
		Schema::drop($this->prefix . 'field_types');
		Schema::drop($this->prefix . 'menu');
		Schema::drop($this->prefix . 'user_group_fields');
		
	}
}
