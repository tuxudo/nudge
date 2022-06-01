<?php

use CFPropertyList\CFPropertyList;

class Nudge_model extends \Model
{
    public function __construct($serial = '')
    {
        parent::__construct('id', 'nudge'); // Primary key, tablename
        $this->rs['id'] = '';
        $this->rs['serial_number'] = $serial;
        $this->rs['past_required_install_date'] = null;
        $this->rs['current_os'] = null;
        $this->rs['required_os'] = null;
        $this->rs['more_info_event'] = null;
        $this->rs['device_info_event'] = null;
        $this->rs['primary_quit_event'] = null;
        $this->rs['secondary_quit_event'] = null;
        $this->rs['update_device_event'] = null;
        $this->rs['deferral_initiated_event'] = null;
        $this->rs['deferral_date'] = null;
        $this->rs['synthetic_click_event'] = null;
        $this->rs['command_quit_event'] = null;
        $this->rs['termination_event'] = null;
        $this->rs['activation_event'] = null;
        $this->rs['new_nudge_event'] = null;
        $this->rs['nudge_log'] = null;
        $this->rs['deferral_count'] = null;
        $this->rs['deferral_user'] = null;
        $this->rs['json_config'] = null;
        $this->rs['profile_config'] = null;

        if ($serial) {
            $this->retrieve_record($serial);
        }

        $this->serial_number = $serial;
    }


    // ------------------------------------------------------------------------
    /**
     * Process data sent by postflight
     *
     * @param string data
     *
     **/
    public function process($data)
    {
        // If data is empty, echo out error
        if (! $data) {
            echo ("Error Processing nudge module: No data found");
        } else {
            
            // Delete previous entries
            $this->deleteWhere('serial_number=?', $this->serial_number);

            // Process incoming nudge.plist
            $parser = new CFPropertyList();
            $parser->parse($data, CFPropertyList::FORMAT_XML);
            $plist = $parser->toArray();

            foreach ($this->rs as $key => $value) {

                $this->rs[$key] = $value;
                if(array_key_exists($key, $plist))
                {
                    $this->rs[$key] = $plist[$key];
                } else if ($key != "serial_number") {
                    $this->rs[$key] = null;
                }
            }

            // Save the data, nudgin the Macs
            $this->id = '';
            $this->save(); 
        }
    }
}