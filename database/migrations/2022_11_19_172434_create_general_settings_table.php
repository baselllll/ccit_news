<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->float('maxDiscount')->nullable()->default(0);
            $table->float('VAT')->nullable()->default(0);
            $table->string('title')->nullable();
            $table->string('taxNumber')->nullable();
            $table->text('address')->nullable();
            $table->string('phoneNumber')->nullable();
            $table->string('email')->nullable();
            $table->text('invoiceFooter')->nullable();
            $table->string('black_logo')->nullable();
            $table->string('white_logo')->nullable();
            $table->timestamps();
        });
        \App\Models\GeneralSetting::create(
            [
                'maxDiscount' => 20.00,
                'VAT' => 15.00,
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('general_settings');
    }
};
