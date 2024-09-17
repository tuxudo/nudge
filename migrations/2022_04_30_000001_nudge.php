<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;

class Nudge extends Migration
{
    public function up()
    {
        $capsule = new Capsule();
        $capsule::schema()->create('nudge', function (Blueprint $table) {
            $table->increments('id');
            $table->string('serial_number');
            $table->boolean('past_required_install_date')->nullable(); // Device pastRequiredInstallationDate: false
            $table->string('current_os')->nullable(); // Current operating system (12.3.1) is greater than or equal to required operating system (12.3.1)
            $table->string('required_os')->nullable(); // 12.3.0
            $table->bigInteger('more_info_event')->nullable(); // User clicked moreInfo button
            $table->bigInteger('device_info_event')->nullable(); // User clicked deviceInfo
            $table->bigInteger('primary_quit_event')->nullable(); // User clicked primaryQuitButton
            $table->bigInteger('secondary_quit_event')->nullable(); // User clicked secondaryQuitButton
            $table->bigInteger('update_device_event')->nullable(); // User clicked updateDevice
            $table->bigInteger('deferral_initiated_event')->nullable(); // User initiated a deferral: 2022-04-29 15:24:12 +0000
            $table->bigInteger('deferral_date')->nullable(); 
            $table->bigInteger('synthetic_click_event')->nullable(); // Synthetically clicked updateDevice due to allowedDeferral count
            $table->bigInteger('command_quit_event')->nullable(); // Nudge detected an attempt to close the application
            $table->bigInteger('termination_event')->nullable(); // Nudge is terminating due to condition met
            $table->bigInteger('activation_event')->nullable(); // Activating Nudge Re-activating Nudge
            $table->bigInteger('new_nudge_event')->nullable(); // New Nudge event detected - resetting all deferral values
            $table->text('nudge_log')->nullable();

            // Create indexes
            $table->index('serial_number');
            $table->index('past_required_install_date');
            $table->index('current_os');
            $table->index('required_os');
        });
    }

    public function down()
    {
        $capsule = new Capsule();
        $capsule::schema()->dropIfExists('nudge');
    }
}
