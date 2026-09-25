<?php
require_once 'config.php';
    require_once 'init.php';
require_once 'classes/Database.php';
require_once 'classes/User.php';
session_start();
if (empty($_SESSION['user'])) { header('Location: login.php'); exit; }
$db = new Database();
$records = $db->query(
    'SELECT a.*, s.full_name FROM attendance a JOIN students s ON s.id=a.student_id ORDER BY a.lesson_date DESC'
)->fetchAll();
require 'header.php';
?>
<div class="card">
  <h1>Посещаемость</h1>
  <table><tr><th>Студент</th><th>Дата</th><th>Статус</th><th>Комментарий</th></tr>
  <?php foreach ($records as $r): ?>
    <tr><td><?= htmlspecialchars($r['full_name']) ?></td><td><?= htmlspecialchars($r['lesson_date']) ?></td><td><?= htmlspecialchars($r['status']) ?></td><td><?= htmlspecialchars($r['comment']) ?></td></tr>
  <?php endforeach; ?>
  </table>
</div>
<?php require 'footer.php'; ?>
