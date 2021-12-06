<?php

require_once('db.php');

function selectAsJson(object $db,string $sql): void {
    $query = $db->query($sql);
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    header('HTTP/1.1 200 OK');
    echo json_encode($results);
}

function returnError(PDOException $pdoex): void {
    header('HTTP/1.1 500 Internal Server Error');
    $error = array('error' => $pdoex->getMessage());
    echo json_encode($error);
    exit;
}

try {
$dbcon = createDbConnection();
selectAsJson($dbcon, 'SELECT titles.title_id, primary_title, start_year, average_rating 
    FROM titles, had_role, title_ratings
    WHERE titles.title_id = had_role.title_id AND role_ LIKE "%Mr. Bean%" AND titles.title_id =title_ratings.title_id
    group BY titles.title_id 
    order by average_rating DESC
    LIMIT 10');
  }  catch (PDOException $pdoex) {
        returnError($pdoex);
    }

    


