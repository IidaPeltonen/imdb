<?php

//otetaan funkitiot käyttöön
require('functions.php');

try {
//avataan kanta
$dbcon = createDbConnection();
//muodotetaan sql-lause, haetaan otsikot, vuosi, kesto, arvostelut. Etsitään elokuvat, joissa roolinimenä Bean 
// järjestetään nousevaan laskevaan järjestykseen arvosanan mukaan
selectAsJson($dbcon, 'SELECT titles.title_id, primary_title, start_year, average_rating 
    FROM titles, had_role, title_ratings
    WHERE titles.title_id = had_role.title_id AND role_ LIKE "%Mr. Bean%" AND titles.title_id =title_ratings.title_id
    group BY titles.title_id 
    order by average_rating DESC
    LIMIT 10');
  }  catch (PDOException $pdoex) {
        returnError($pdoex);
    }

    


