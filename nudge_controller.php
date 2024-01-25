<?php
/**
 * nudge module class
 *
 * @package munkireport
 * @author tuxudo
 **/
class Nudge_controller extends Module_controller
{
    /*** Protect methods with auth! ****/
    public function __construct()
    {
        // Store module path
        $this->module_path = dirname(__FILE__);
    }

    /**
    * Default method
    *
    * @author AvB
    **/
    public function index()
    {
        echo "You've loaded the nudge module!";
    }

    /**
     * Get nudge data for scroll widget
     *
     * @return void
     * @author tuxudo
     **/
    public function get_scroll_widget($column)
    {
        $column = preg_replace("/[^A-Za-z0-9_\-]]/", '', $column);

        $sql = "SELECT COUNT(CASE WHEN `$column` = 1 THEN 1 END) AS 'Yes',
                    COUNT(CASE WHEN `$column` = 0 THEN 1 END) AS 'No'
                    from nudge
                    LEFT JOIN reportdata USING (serial_number)
                    WHERE ".get_machine_group_filter('');

        $out = [];
        $queryobj = new Nudge_model();
        foreach($queryobj->query($sql)[0] as $label => $value){
                $out[] = ['label' => $label, 'count' => $value];
        }

        jsonView($out);
    }

    /**
    * Retrieve data in json format
    *
    * @return void
    * @author tuxudo
    **/
    public function get_tab_data($serial_number = '')
    {
        $serial_number = preg_replace("/[^A-Za-z0-9_\-]]/", '', $serial_number);

        $sql = "SELECT past_required_install_date, required_os, deferral_count, deferral_user, more_info_event, device_info_event, primary_quit_event, 
                        secondary_quit_event, update_device_event, deferral_initiated_event, deferral_date, synthetic_click_event,
                        command_quit_event, termination_event, activation_event, new_nudge_event, nudge_log
                        FROM nudge 
                        WHERE serial_number = '$serial_number'";

        $queryobj = new Nudge_model();
        jsonView($queryobj->query($sql));
    }
} // End class Nudge_controller