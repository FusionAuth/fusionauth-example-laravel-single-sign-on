<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * When running this migration, we want to create three new columns and change the password so it can be NULL
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users',  function (Blueprint $table) {
            $table->string('fusionauth_id', 36)->unique();
            $table->text('fusionauth_access_token');
            $table->text('fusionauth_refresh_token')->nullable();
            $table->string('password')->nullable()->change();
        });
    }

    /**
     * When rolling back this migration, we want to drop the added columns and revert the password to NOT NULL again
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users',  function (Blueprint $table) {
            $table->dropColumn('fusionauth_id');
            $table->dropColumn('fusionauth_access_token');
            $table->dropColumn('fusionauth_refresh_token');
            $table->string('password')->nullable(false)->change();
        });
    }
};
