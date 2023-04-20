#!/bin/bash
set -u          # Treat unset variables as an error when substituting
set -e          # Exit if any command returns a non-zero status
set -o pipefail # Same for piped commands

echo "Deployment Script | Lock granted 🔒"

set +e          # Do not exit if any command returns a non-zero status
set +o pipefail # Same for piped commands
echo "Deployment Script | Running release"
# Indefinatly try to run the release script until a database is available.
# This allows for larger databases to be imported without this timing out
while ! drush sql-query 'show tables;' >/dev/null 2>&1; do
  echo "Deployment Script | Could not connect to the drupal DB. Database could still be being imported, Retrying..."
  sleep 2
done
set -e          # Exit if any command returns a non-zero status
set -o pipefail # Same for piped commands

#
# ENTER RELEASE COMMANDS HERE
cd /var/www/default/htdocs/httpdocs/
# Setting image_uid to 0 so that the healthcheck does not report as healthy on restart
drush vset image_uid "0"
echo "Deployment Script | Release Started         [Step 1 of 10] ⏱️"
echo "Deployment Script | Clearing Caches 1/4...  [Step 2 of 10] 📤"
drush cc drush && drush cc all
echo "Deployment Script | Rebuilding Registry...  [Step 3 of 10] 📖"
drush help rr >/dev/null || (drush @none dl registry_rebuild-7.x && drush cc drush)
drush rr
echo "Deployment Script | Clearing Caches 2/4...  [Step 4 of 10] 📤"
drush cc all
echo "Deployment Script | Upgrading CiviCRM...    [Step 5 of 10] 🧑‍💻⤴️"
drush cvupdb -y
echo "Deployment Script | Upgrading Drupal...     [Step 6 of 10] 💧⤴️"
drush updb -y
echo "Deployment Script | Clearing Caches 3/4...  [Step 7 of 10] 📤"
drush cc drush && drush cc all && drush cc civicrm
echo "Deployment Script | Setting up logging      [Step 8 of 10] 📃🕵️"
drush pm-enable -y syslog
drush pm-disable -y dblog
echo "Deployment Script | Clearing Caches 4/4...  [Step 9 of 10] 📤"
drush cc drush && drush cc all
echo "Deployment Script | Release completed!      [Step 10 of 10] 🎉"
# END OF RELEASE BLOCK
#

# Used to update the docker health check
drush vset deployed_version "${APP_VERSION}"
drush vset image_uid "${IMAGE_UID}"
