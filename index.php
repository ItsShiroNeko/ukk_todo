<?php
include 'koneksi.php';
$result = $conn->query("SELECT * FROM tasks");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi ToDo List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="card shadow-lg border-0 rounded-3">
                    <div class="card-header bg-primary text-white text-center py-3">
                        <h5 class="card-title mb-0"><i class="fas fa-plus-circle me-2"></i>Tambah Tugas</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" action="aksi_todo.php">
                            <div class="mb-3">
                                <label class="form-label text-muted">Tugas</label>
                                <input type="text" name="task" class="form-control shadow-sm" placeholder="Masukkan Task Baru" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-muted">Prioritas</label>
                                <select name="priority" class="form-select shadow-sm" required>
                                    <option value="">---</option>
                                    <option value="low">Low</option>
                                    <option value="Medium">Medium</option>
                                    <option value="High">High</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-muted">Tanggal</label>
                                <input type="date" name="date" class="form-control shadow-sm" value="<?php echo(date("Y-m-d",time()));?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 shadow-sm"><i class="fas fa-plus me-2"></i>Tambah</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card shadow-lg border-0 rounded-3">
                    <div class="card-header bg-primary text-white text-center py-3">
                        <h5 class="card-title mb-0"><i class="fas fa-tasks me-2"></i>Daftar Tugas</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Task</th>
                                        <th>Prioritas</th>
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
                                                        <button type="submit" name="done" value="<?= $row['id']; ?>" class="btn btn-success btn-sm"><i class="fas fa-check"></i></button>
                                                    </form>
                                                <?php endif; ?>
                                                <form method="post" class="d-inline" action="aksi_todo.php">
                                                    <button type="submit" name="delete" value="<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick=" return confirm('Apakah anda yakin menghapus data ini?')"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>