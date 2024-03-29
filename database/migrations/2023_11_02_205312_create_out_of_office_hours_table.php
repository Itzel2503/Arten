<?php

use App\Models\OutOfOfficeHours;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutOfOfficeHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('out_of_office_hours', function (Blueprint $table) {
            $table->id();
            $table->enum('type', [
                OutOfOfficeHours::LATE,
                OutOfOfficeHours::EARLY,
                OutOfOfficeHours::BETWEEN,
            ]);
            $table->enum('reason', [
                OutOfOfficeHours::FAMILY,
                OutOfOfficeHours::PERSONAL,
                OutOfOfficeHours::DISEASE,
                OutOfOfficeHours::MEDICAL,
                OutOfOfficeHours::LEGAL,
                OutOfOfficeHours::OTHER,
            ]);
            $table->date('date');
            $table->float('take_hours');
            $table->integer('delegate_activities');
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
        Schema::dropIfExists('out_of_office_hours');
    }
}
