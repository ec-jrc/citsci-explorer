#!/bin/bash

bash create-index-pages.sh
php  create-project-pages.php
php  create-catalog-pages.php
php  create-chart-pages.php

