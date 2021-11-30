<?php

    require_once('db.php');
    $dbcon = createDbConnection();
    $sql = "SELECT title FROM aliases WHERE (region = 'FI') GROUP BY title_id ORDER BY title LIMIT 10;";
    //$sql = "CALL GetAliasesByCountry('FI');";
    $prepare = $dbcon->prepare($sql);   //valmistellaan
        $prepare->execute();  //kysely tietokantaan
        $rows = $prepare->fetchAll(); //haetaan tulokset (voitaisiin hakea myös eka rivi fetch ja tarkistus)
        $html = '<h1>Top 10 Finnish titles</h1>';
        $html .= '<ul>';
        //Käydään rivit läpi (max yksi rivi tässä tapauksessa) 
        foreach($rows as $row){
            $html .= '<li>' . $row["title"] . '</li>';  
        }
        $html .= '</ul>';

        echo $html;