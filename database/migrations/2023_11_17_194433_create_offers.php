<?php

use App\Enumerations\Offers\AvailabilityEnum;
use App\Enumerations\Offers\ConditionEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffers extends Migration
{
    /**
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id()->startingValue(1000);
            $table->bigInteger('product_id')->unsigned()->index();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->string('seller_id')->nullable();
            $table->decimal('price', 10);
            $table->enum('condition', [ConditionEnum::NEW, ConditionEnum::USED])->default(ConditionEnum::NEW);
            $table->enum('availability', [AvailabilityEnum::IN_STOCK, AvailabilityEnum::OUT_OF_STOCK])->default(AvailabilityEnum::IN_STOCK);
            $table->timestamps();
        });
    }

    /**
     * @return void
     */
    public function down()
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropIndex(['product_id']);
        });

        Schema::dropIfExists('offers');
    }
}
