<?php
include 'koneksi.php';

// Fetch tasks
$result = $conn->query("SELECT * FROM tasks");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi ToDo List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">
    <h2 class="text-center">Aplikasi ToDo List</h2>
    <form method="post" class="mb-4" action="aksi_todo.php">
        <div class="mb-2">
            <label for="task" class="form-label text-muted"> Tugas</label>
            <input type="text" name="task" class="form-control shadow-sm" placeholder="Masukkan Task Baru" required>
        </div>
        <div class="mb-2">
            <label for="priority" class="form-label text-muted">Priority</label>
            <select name="priority" id="priority" class="form-control shadow-sm" required>
                <option value="">---</option>
                <option value="low">low</option>
                <option value="Medium">Medium</option>
                <option value="High">High</option>
            </select>
        </div>
        <div class="mb-2">
            <label for="date" class="form-label text-muted">Tanggal</label>
            <input type="date" name="date" class="form-control shadow-sm" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Task</th>
                <th>Priority</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['task_name']; ?></td>
                    <td><span class="badge bg-<?php if($row['priority'] == 'low') {echo 'primary';} else { if($row['priority'] == 'Medium'){echo 'warning';} else {echo 'danger';}}?>"><?= $row['priority']; ?></span></td>
                    <td><?= $row['due_date']; ?></td>
                    <td>
                        <span class="badge bg-<?= $row['status'] == 'Selesai' ? 'success' : 'secondary'; ?>">
                            <?= $row['status']; ?>
                        </span>
                    </td>
                    <td>
                        <?php if ($row['status'] == 'Belum Selesai'): ?>
                            <form method="post" class="d-inline" action="aksi_todo.php">
                                <button type="submit" name="done" value="<?= $row['id']; ?>" class="btn btn-success btn-sm">Selesai</button>
                            </form>
                        <?php endif; ?>
                        <form method="post" class="d-inline" action="aksi_todo.php">
                            <button type="submit" name="delete" value="<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick=" return confirm('Apakah anda yakin menghapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>