<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManifestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manifests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('presentation_id')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('origin_port_id')->nullable();
            $table->unsignedBigInteger('destiny_port_id')->nullable();
            $table->unsignedBigInteger('shipper_id')->nullable();
            $table->unsignedBigInteger('consignee_id')->nullable();
            $table->boolean('is_organic');
            $table->timestamp('departured_at');
            $table->string('code');
            $table->string('ship');
            $table->string('variety');
            $table->string('company');
            $table->string('brand');
            $table->string('detail');
            $table->string('knowledge');
            $table->string('processing');
            $table->string('description');
            $table->string('master_direct');
            $table->integer('gross_weight');
            $table->integer('origin_weight');
            $table->integer('received_weight');
            $table->integer('manifested_weight');
            $table->integer('packages');
            $table->integer('origin_packages');
            $table->integer('received_packages');
            $table->integer('manifested_packages');
            $table->integer('terminal');
            $table->integer('total_detail');
            $table->integer('container_size');
            $table->float('container_qnty');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');
            $table->foreign('presentation_id')
                ->references('id')
                ->on('presentations')
                ->onDelete('cascade');
            $table->foreign('country_id')
                ->references('id')
                ->on('countries')
                ->onDelete('cascade');
            $table->foreign('origin_port_id')
                ->references('id')
                ->on('origin_ports')
                ->onDelete('cascade');
            $table->foreign('destiny_port_id')
                ->references('id')
                ->on('destiny_ports')
                ->onDelete('cascade');
            $table->foreign('shipper_id')
                ->references('id')
                ->on('shippers')
                ->onDelete('cascade');
            $table->foreign('consignee_id')
                ->references('id')
                ->on('consignees')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manifests');
    }
}
