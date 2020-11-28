<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AuthTable extends Migration
{
	public function up()
	{
		/*
         * Auth Users
         */
		$this->forge->addField([
			'id'        => [
				'type'           => 'int',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true
			],
			'email'     => [
				'type'       => 'varchar',
				'constraint' => 100,
				'default'    => null,
				'null'       => true
			],
			'password'  => [
				'type'       => 'varchar',
				'constraint' => 255,
				'default'    => null,
				'null'       => true
			],
			'isactive'  => [
				'type' => 'tinyint',
				'constraint' => 1,
				'null' => false,
				'default' => '0'
			],
			'dt'        => [
				'type' => 'timestamp',
				'null' => false,
				'default' => 'CURRENT TIMESTAMP'
			]
		]);

		$this->forge->addKey('id', true);
		$this->forge->addKey('email');
		$this->forge->createTable('auth_users', true);

		/*
         * Auth Attempts
		 * 
         */
		$this->forge->addField([
			'id'         => [
				'type'           => 'int',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true
			],
			'ip'         => [
				'type'       => 'varchar',
				'constraint' => 39,
			],
			'expiredate' => [
				'type' => 'datetime'
			]
		]);
		$this->forge->addKey('id', true);
		$this->forge->addKey('ip');
		$this->forge->createTable('auth_attempts', true);

		/*
         * Auth Emails Banned
         */
		$this->forge->addField([
			'id'     => [
				'type'           => 'int',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true
			],
			'domain' => [
				'type'       => 'varchar',
				'constraint' => 100,
				'null'       => true,
				'default'    => null
			]
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('auth_emails_banned', true);

		/*
         * Auth Requests
		 * 
         */
		$this->forge->addField([
			'id'     => [
				'type'           => 'int',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true
			],
			'uid'    => [
				'type'       => 'int',
				'constraint' => 11,
				'unsigned'   => true
			],
			'token'  => [
				'type'       => 'char',
				'constraint' => 20
			],
			'expire' => [
				'type' => 'datetime'
			],
			'type'   => [
				'type'       => 'ENUM',
				'constraint' => ['activation', 'reset'],
				'null'       => false
			]
		]);
		$this->forge->addKey('id', true);
		$this->forge->addKey('token');
		$this->forge->addKey('type');
		// $this->forge->addForeignKey('uid', 'users', 'id', false, 'CASCADE');
		$this->forge->createTable('auth_requests', true);

		/*
         * Auth Sessions
		 * 
         */
		$this->forge->addField([
			'id'          => [
				'type'           => 'int',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true
			],
			'uid'         => [
				'type'       => 'int',
				'constraint' => 11,
				'unsigned'   => true
			],
			'hash'        => [
				'type'       => 'char',
				'constraint' => 40
			],
			'expiredate'  => [
				'type' => 'datetime',
				'null' => false
			],
			'ip'          => [
				'type'       => 'varchar',
				'constraint' => 39,
				'null'       => false
			],
			'device_id'   => [
				'type'       => 'varchar',
				'constraint' => 36,
				'null'       => true,
				'default'    => null
			],
			'agent'       => [
				'type'       => 'varchar',
				'constraint' => 200,
				'null'       => false
			],
			'cookie_crc'  => [
				'type'       => 'char',
				'constraint' => 40,
				'null'       => false
			],
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('auth_sessions');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('auth_users', true);
		$this->forge->dropTable('auth_attempts', true);
		$this->forge->dropTable('auth_emails_banned', true);
		$this->forge->dropTable('auth_requests', true);
		$this->forge->dropTable('auth_sessions', true);
	}
}
