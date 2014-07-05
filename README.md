# IMDBParser (Alpha)
Makes parsing the IMBD text files much easier! Written in PHP 5.5.3. There is still quite a bit of work left to do on this. So far this only includes parsing and adding countries, genres, and movies.

## Configuration
1. Update config.php with your settings. If you want to fork and create you own branch just create devConfig.php and override settings there, that way it doesn't get pushed to GitHub.

## Installation
1. Run the migrations to create the tables in MySQL once you have updated config.php with your connection info.
php /path/to/IMDBParse/database/migrations/CreateGenreMovie.php
php /path/to/IMDBParse/database/migrations/CreateMovies.php
php /path/to/IMDBParse/database/migrations/CreateGenres.php

## Todo
1. Lots more to parse (actors, actresses, cast, etc...).
2. Expand on the tests to cover more situations, especially the movie tests.
3. Differentiate movies from television shows