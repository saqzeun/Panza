<?php
require "db.php";
class Events
{
  private $id;
  private $title;
  private $type;
  private $date;

  public function getId()
  {
    return $this->id;
  }

  public function getTitle()
  {
    return $this->title;
  }

  public function getType()
  {
    return $this->type;
  }

  public function getDate()
  {
    return $this->date;
  }

  public function getEvent($id)
  {
    $data = Mysql::getInstance()->prepare("SELECT * FROM events WHERE id = ?");
    $data->execute([$id]);
    $event = $data->fetch(PDO::FETCH_ASSOC);

    if ($event) {
      $this->id = $event["id"];
      $this->title = $event["title"];
      $this->type = $event["type"];
      $this->date = $event["date"];
    }
  }

  public function getAllEvents()
  {
    $data = Mysql::getInstance()->prepare("SELECT * FROM events");
    $data->execute();
    return $data->fetchAll(PDO::FETCH_ASSOC);
  }
}

$events = new Events();
$allEvents = $events->getAllEvents();
?>

<!doctype html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Tableau de bord</title>
</head>

<body>
  <table>
    <tr>
      <th>Titre</th>
      <th>Type</th>
      <th>Date</th>
    </tr>

    <?php foreach ($allEvents as $event) : ?>
      <tr>
        <td><?= $event['title'] ?></td>
        <td><?= $event['type'] ?></td>
        <td><?= $event['date'] ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>

</html>