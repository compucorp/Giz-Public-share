#!/bin/bash
set -u          # Treat unset variables as an error when substituting
set -e          # Exit if any command returns a non-zero status
set -o pipefail # Same for piped commands

php ./sites/default/healthcheck.php
