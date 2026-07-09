#!/bin/bash
cd /homepages/46/d4299033270/htdocs/rstest
git pull origin main --allow-unrelated-histories
/usr/bin/php8.4-cli composer.phar install
/usr/bin/php8.4-cli artisan view:clear

