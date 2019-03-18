#!/bin/bash

echo "Preparing data:"

echo "Normalising project records..."
php normalise-projects.php
echo "Done."

echo "Normalising catalog records..."
php normalise-catalogs.php
echo "Done."

echo "Merge project records..."
php merge-projects.php
echo "Done."

echo "Merge catalog records..."
php merge-catalogs.php
echo "Done."

