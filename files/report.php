<?php
require_once 'config.php';
    require_once 'init.php';
require_once 'classes/Database.php';
require_once 'classes/User.php';
require_once 'classes/Report.php';
session_start();
if (empty($_SESSION['user'])) { header('Location: login.php'); exit; }
if (!in_array($_SESSION['user']['role'], ['teacher','admin'], true)) { http_response_code(403); exit('Доступ запрещён'); }

$db = new Database();
$report = new Report($db);
$rows = $report->attendanceSummary();
require 'header.php';
?>
<div class="card">
  <h1>Отчёт по посещаемости</h1>
  <p class="small">Отдельный класс Report подготовлен как развитие задания.</p>
  <table><tr><th>Студент</th><th>Присутствий</th><th>Пропусков</th></tr>
  <?php foreach ($rows as $row): ?>
    <tr><td><?= htmlspecialchars($row['full_name']) ?></td><td><?= (int)$row['present_count'] ?></td><td><?= (int)$row['absent_count'] ?></td></tr>
  <?php endforeach; ?>
  </table>
</div>
<?php require 'footer.php'; ?>
