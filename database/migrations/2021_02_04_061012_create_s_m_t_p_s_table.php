<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSMTPSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_m_t_p_s', function (Blueprint $table) {
            $table->id();
            $table->enum('smtp_status',['on','off']);
            $table->string('host_name',20);
            $table->integer('port',10);
            $table->string('username',20);
            $table->string('password',20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('s_m_t_p_s');
    }
}
