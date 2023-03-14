<?php
$server = "127.0.0.1:8080";
$database = "mobile";
$user = "root";
$password = "example";
$mysqli = new mysqli($server, $user, $password, $database);

$manufacturers = array();
$manufacturer_handle = $mysqli->query("select id, title from manufacturers
order by title");
while ($row = $manufacturer_handle->fetch_assoc()) {
    $manufacturers[$row["id"]] = $row["title"];
}

$colors = array();
$colors_handle = $mysqli->query("select id, title from colors
order by title");
while ($row = $colors_handle->fetch_assoc()) {
    $colors[$row["id"]] = $row["title"];
}


$year = "";
$manufacturer = "";
$color = "";

$error = "";

if (
    isset($_GET['year']) && $_GET['year']
    && isset($_GET['manufacturer']) && $_GET['manufacturer'] &&
    isset($_GET['color']) && $_GET['color']
) {
    $year = $_GET['year'];
    $manufacturer = $_GET['manufacturer'];
    $color = $_GET['color'];
} else {
    $error = "Parameter(s) missing!";
}

if (!$error && !is_numeric($year)) {
    $error = "Year not a numeric!";
}

$results = array();

if (!$error) {
    $statement = $mysqli->prepare(
        "SELECT
            manufacturers.title AS manufacturer,
            models.title AS model,
            count(*) AS count
        FROM
            manufacturers
            INNER JOIN models ON manufacturer_id = manufacturers.id
            INNER JOIN cars ON cars.model_id = models.id
        WHERE
            manufacturer_id = ?
            AND color_id = ?
            AND cars.registration_year = ?
        GROUP BY
            manufacturers.title,
            models.title
        ORDER BY
            count DESC"
    );

    $statement->bind_param("iii", $manufacturer, $color, $year);
    $statement->execute();

    $temp = $statement->get_result();
    while ($row = $temp->fetch_assoc()) {
        $results[] = $row;
    }
}

require("view.php");

require("../task2/logger.php");
$logger = new Logger(getcwd() . "\..\log.txt");
if ($error) {
    $logger->log("ERROR");
} else {
    $logger->log("OK");
}
