<?php 
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['task']) && isset($_POST['priority']) && isset($_POST['date'])) {
        $task = $_POST['task'];
        $priority = $_POST['priority'];
        $date = $_POST['date'];
        
        $sql = "INSERT INTO tasks (task_name, priority, due_date, status) VALUES ('$task', '$priority', '$date', 'Belum Selesai')";
        $conn->query($sql);
        header('Location: index.php');
    }
    if (isset($_POST['done'])) {
        $id = $_POST['done'];
        $sql = "UPDATE tasks SET status='Selesai' WHERE id=$id";
        $conn->query($sql);
        header('Location: index.php');
    }
    if (isset($_POST['delete'])) {
        $id = $_POST['delete'];
        $sql = "DELETE FROM tasks WHERE id=$id";
        $conn->query($sql);
        header('Location: index.php');
    }
}

?>