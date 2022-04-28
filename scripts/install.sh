#!/bin/bash

# nudge controller
CTL="${BASEURL}index.php?/module/nudge/"

# Get the scripts in the proper directories
"${CURL[@]}" "${CTL}get_script/nudge" -o "${MUNKIPATH}preflight.d/nudge"

# Check exit status of curl
if [ $? = 0 ]; then
	# Make executable
	chmod a+x "${MUNKIPATH}preflight.d/nudge"

	# Set preference to include this file in the preflight check
	setreportpref "nudge" "${CACHEPATH}nudge.plist"

else
	echo "Failed to download all required components!"
	rm -f "${MUNKIPATH}preflight.d/nudge"

	# Signal that we had an error
	ERR=1
fi
