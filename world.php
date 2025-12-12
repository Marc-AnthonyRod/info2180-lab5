<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

$country = $_GET["country"] ?? "";
$lookup = $_GET["lookup"] ?? "";

if ($lookup === "cities") {
  $stmt = $conn->prepare("SELECT cities.name AS city_name, cities.district, cities.population FROM cities JOIN countries ON cities.country_code = countries.code WHERE countries.name LIKE :country ORDER BY cities.name");
  $stmt->bindValue(':country', "%$country%");
  $stmt->execute();
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
      
      echo "<table border='1'>
          <thead>
              <tr>
                  <th>City Name</th>
                  <th>District</th>
                  <th>Population</th>
              </tr>
          </thead>
          <tbody>";
      foreach ($results as $row) {
          echo "<tr>
              <td>".htmlspecialchars($row['city_name'])."</td>
              <td>".htmlspecialchars($row['district'])."</td>
              <td>".htmlspecialchars($row['population'])."</td>
          </tr>";
      }
      echo "</tbody></table>";

} else {

  $stmt = $conn->prepare("SELECT name, continent, independence_year, head_of_state FROM countries WHERE name LIKE :country");
  $stmt->bindValue(':country', "%$country%");
  $stmt->execute();

  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);


  echo "<table border='1'>
      <thead>
          <tr>
              <th>Country Name</th>
              <th>Continent</th>
              <th>Independence Year</th>
              <th>Head of State</th>
          </tr>
      </thead>
      <tbody>";
  foreach ($results as $row){
        echo "<tr>
              <td>".htmlspecialchars($row['name'])."</td>
              <td>".htmlspecialchars($row['continent'])."</td>
              <td>".htmlspecialchars($row['independence_year'] ?? 'N/A')."</td>
              <td>".htmlspecialchars($row['head_of_state'] ?? 'N/A')."</td>
          </tr>";
  }
  echo "</tbody></table>";
}
?>