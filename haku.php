<?php

//otetaan yhteiset funktiot käyttöön
require('functions.php');

try {
//avataan tietokanta
$dbcon = createDbConnection();
//muodotetaan sql-lause, haetaan otsikot, vuosi, kesto, genre. Etsitään elokuvat, suomenkieliset nimet, aika 
//on yli nollan ja genrenä action. järjestetään nousevaan järjestykseen ajan mukaan
selectAsJson($dbcon, 'SELECT titles.title_id, primary_title, start_year, runtime_minutes, genre 
    FROM titles, aliases, title_genres
    WHERE titles.title_id = aliases.title_id AND titles.title_id = title_genres.title_id 
        AND title_type = "movie" AND region = "FI" AND runtime_minutes > 0 AND genre = "Action\r"
    group BY titles.title_id 
    order by runtime_minutes ASC
    LIMIT 10');
  }  catch (PDOException $pdoex) {
        returnError($pdoex);
    }
