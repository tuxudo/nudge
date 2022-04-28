Nudge Module
==============

Gathers logs on nudge. Requires nudge and the default nudge logging Launch Daemon [https://github.com/macadmins/nudge](https://github.com/macadmins/nudge) 

Table Schema
----

* past_required_install_date - BOOL - If Mac is past the required install date
* current_os - VARCHAR(255) - Current version of macOS
* required_os - VARCHAR(255) - Required version of macOS
* more_info_event - BIGINT - Timestamp of last moreInfo button click
* device_info_event - BIGINT - Timestamp of last deviceInfo button click
* primary_quit_event - BIGINT - Timestamp of last primaryQuitButton button click
* secondary_quit_event - BIGINT - Timestamp of last secondaryQuitButton button click
* update_device_event - BIGINT - Timestamp of last updateDevice button click
* deferral_initiated_event - BIGINT - Timestamp of user initiated deferral
* deferral_date - BIGINT - Timestamp of when deferral expires
* synthetic_click_event - BIGINT - Timestamp of last synthetic updateDevice button click
* command_quit_event - BIGINT - Timestamp of last attempt to close Nudge
* termination_event - BIGINT - Timestamp of when Nudge terminated last
* activation_event - BIGINT - Timestamp of when Nudge activated last
* new_nudge_event - BIGINT - Timestamp of when Nudge parsed its config last
* nudge_log - TEXT - Last 500 lines of Nudge.log

