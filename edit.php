<?php
include 'koneksi.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM tasks WHERE id = $id");
$task = $result->fetch_assoc();

if (!$task) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tugas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow-lg border-0 rounded-3">
                    <div class="card-header bg-warning text-white text-center py-3">
                        <h5 class="card-title mb-0"><i class="fas fa-edit me-2"></i>Edit Tugas</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" action="aksi_todo.php">
                            <input type="hidden" name="id" value="<?= $task['id']; ?>">
                            <div class="mb-3">
                                <label class="form-label text-muted">Tugas</label>
                                <input type="text" name="task" class="form-control shadow-sm" value="<?= $task['task_name']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-muted">Prioritas</label>
                                <select name="priority" class="form-select shadow-sm" required>
                                    <option value="low" <?= $task['priority'] == 'low' ? 'selected' : ''; ?>>Low</option>
                                    <option value="Medium" <?= $task['priority'] == 'Medium' ? 'selected' : ''; ?>>Medium</option>
                                    <option value="High" <?= $task['priority'] == 'High' ? 'selected' : ''; ?>>High</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-muted">Deadline</label>
                                <input type="date" name="date" class="form-control shadow-sm" value="<?= $task['due_date']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-muted">Status</label>
                                <select name="status" class="form-select shadow-sm" required>
                                    <option value="Belum Selesai" <?= $task['status'] == 'Belum Selesai' ? 'selected' : ''; ?>>Belum Selesai</option>
                                    <option value="Selesai" <?= $task['status'] == 'Selesai' ? 'selected' : ''; ?>>Selesai</option>
                                </select>
                            </div>
                            <button type="submit" name="update" class="btn btn-warning w-100 shadow-sm"><i class="fas fa-save me-2"></i>Simpan Perubahan</button>
                        </form>
                        <a href="index.php" class="btn btn-secondary w-100 mt-2 shadow-sm"><i class="fas fa-arrow-left me-2"></i>Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>