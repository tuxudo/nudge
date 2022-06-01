<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;

class NudgeAddDeferralsConfig extends Migration
{
    private $tableName = 'nudge';

    public function up()
    {
        $capsule = new Capsule();
        $capsule::schema()->table($this->tableName, function (Blueprint $table) {
            $table->integer('deferral_count')->nullable();
            $table->string('deferral_user')->nullable();
            $table->text('json_config')->nullable();
            $table->text('profile_config')->nullable();
            
            $table->index('deferral_count');
            $table->index('deferral_user');
        });
    }
    
    public function down()
    {
        $capsule = new Capsule();
        $capsule::schema()->table($this->tableName, function (Blueprint $table) {
            $table->dropColumn('deferral_count');
            $table->dropColumn('deferral_user');
            $table->dropColumn('json_config');
            $table->dropColumn('profile_config');
        });
    }
}
