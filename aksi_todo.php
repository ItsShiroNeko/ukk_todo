<?php 
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['task']) && isset($_POST['priority']) && isset($_POST['date']) && isset($_POST['insert'])) {
        $task = $_POST['task'];
        $priority = $_POST['priority'];
        $date = $_POST['date'];
        $datenow = date("Y-m-d");
        if ($date >= $datenow) {
            $sql = "INSERT INTO tasks (task_name, priority, due_date, status) VALUES ('$task', '$priority', '$date', 'Belum Selesai')";
        $conn->query($sql);
        header('Location: index.php');
        } else {
            echo "<script>alert('masukan tanggal yang sesuai');</script>";
            header('Location: index.php');
        }
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
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $task = $_POST['task'];
        $priority = $_POST['priority'];
        $date = $_POST['date'];
        $status = $_POST['status'];

        $sql = "UPDATE tasks SET task_name='$task', priority='$priority', due_date='$date', status='$status' WHERE id=$id";
        $conn->query($sql);
        header('Location: index.php');
    }
}

?>