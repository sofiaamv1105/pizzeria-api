<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Modificar columna role para incluir 'empleado'
        DB::statement("ALTER TABLE users MODIFY role ENUM('admin', 'cliente', 'vendedor', 'secretaria', 'cajero', 'empleado') NOT NULL DEFAULT 'cliente'");
    }

    public function down()
    {
        // Volver a la definición anterior
        DB::statement("ALTER TABLE users MODIFY role ENUM('admin', 'cliente', 'vendedor', 'secretaria', 'cajero') NOT NULL DEFAULT 'cliente'");
    }
};