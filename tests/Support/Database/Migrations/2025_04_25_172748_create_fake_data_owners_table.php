<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('fake_data_owners', function (Blueprint $table) {
            $table->id();
            $table->string('class')->nullable();
            $table->string('type')->nullable();
            $table->json('data_object')->nullable();
            $table->json('text_vo')->nullable();
            $table->json('boolean_vo')->nullable();
            $table->json('class_vo')->nullable();
            $table->json('company_vo')->nullable();
            $table->json('domain_vo')->nullable();
            $table->json('email_vo')->nullable();
            $table->json('encryptable_vo')->nullable();
            $table->json('firstname_vo')->nullable();
            $table->json('float_vo')->nullable();
            $table->json('fullname_vo')->nullable();
            $table->json('giturl_vo')->nullable();
            $table->json('password_vo')->nullable();
            $table->json('integer_vo')->nullable();
            $table->json('ip_vo')->nullable();
            $table->json('lastname_vo')->nullable();
            $table->json('name_vo')->nullable();
            $table->json('phone_vo')->nullable();
            $table->json('version_vo')->nullable();
            $table->json('timecode_vo')->nullable();
            $table->json('timeduration_vo')->nullable();
            $table->json('url_vo')->nullable();
            $table->json('uuid_vo')->nullable();
            $table->json('vat_number_vo')->nullable();
            $table->json('basic_auth_vo')->nullable();
            $table->json('s3_auth_vo')->nullable();
            $table->json('ssh_auth_vo')->nullable();
            $table->json('auth_vo')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fake_data_owners');
    }
};
