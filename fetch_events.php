<?php
include 'koneksi.php';

$events = array();

// Ambil data kegiatan dari database
$stmt = $conn->prepare("SELECT title, start_date, end_date FROM events");
$stmt->execute();
$stmt->bind_result($title, $start_date, $end_date);

while ($stmt->fetch()) {
    $events[] = array(
        'title' => $title,
        'start' => $start_date,
        'end' => $end_date
    );
}

$stmt->close();
$conn->close();

// Kembalikan data kegiatan dalam format JSON
echo json_encode($events);
?>
