#!/bin/bash

# Remove nudge script
rm -f "${MUNKIPATH}preflight.d/nudge"

# Remove nudge.plist cache file
rm -f "${MUNKIPATH}preflight.d/cache/nudge.plist"
