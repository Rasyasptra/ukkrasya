<?php $__env->startSection('title', 'Laporan Statistik Galeri'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <div class="page-header-content">
        <div>
            <h1 class="page-title" style="color: #000000 !important;">
                <i class="fas fa-chart-bar"></i>
                Laporan Statistik Galeri
            </h1>
            <p class="page-description">Analisis lengkap data galeri foto sekolah</p>
        </div>
        <div class="page-actions">
            <a href="<?php echo e(route('admin.statistics.pdf')); ?>" class="btn btn-primary">
                <i class="fas fa-file-pdf"></i>
                Export PDF
            </a>
        </div>
    </div>
</div>

<div class="stats-container">
    <!-- Overview Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <i class="fas fa-images"></i>
            </div>
            <div class="stat-content">
                <h3><?php echo e(number_format($stats['total_photos'])); ?></h3>
                <p>Total Foto</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-content">
                <h3><?php echo e(number_format($stats['total_users'])); ?></h3>
                <p>Total Pengguna</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                <i class="fas fa-heart"></i>
            </div>
            <div class="stat-content">
                <h3><?php echo e(number_format($stats['total_likes'])); ?></h3>
                <p>Total Like</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                <i class="fas fa-comments"></i>
            </div>
            <div class="stat-content">
                <h3><?php echo e(number_format($stats['total_comments'])); ?></h3>
                <p>Total Komentar</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                <i class="fas fa-info-circle"></i>
            </div>
            <div class="stat-content">
                <h3><?php echo e(number_format($stats['total_information'])); ?></h3>
                <p>Total Informasi</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);">
                <i class="fas fa-tags"></i>
            </div>
            <div class="stat-content">
                <h3><?php echo e(number_format($stats['total_categories'])); ?></h3>
                <p>Total Kategori</p>
            </div>
        </div>
    </div>

    <!-- Top Content -->
    <div class="stats-row">
        <!-- Most Liked Photos -->
        <div class="stats-card">
            <div class="card-header">
                <h3><i class="fas fa-heart"></i> Foto Terbanyak Disukai</h3>
            </div>
            <div class="card-content">
                <?php if($mostLikedPhotos->count() > 0): ?>
                    <?php $__currentLoopData = $mostLikedPhotos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="top-photo">
                            <div class="photo-info">
                                <span class="photo-title"><?php echo e(Str::limit($photo->title, 30)); ?></span>
                                <span class="photo-stats"><?php echo e($photo->likes_count); ?> like</span>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <p class="no-data">Belum ada foto yang disukai</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Most Commented Photos -->
        <div class="stats-card">
            <div class="card-header">
                <h3><i class="fas fa-comments"></i> Foto Terbanyak Dikomentari</h3>
            </div>
            <div class="card-content">
                <?php if($mostCommentedPhotos->count() > 0): ?>
                    <?php $__currentLoopData = $mostCommentedPhotos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="top-photo">
                            <div class="photo-info">
                                <span class="photo-title"><?php echo e(Str::limit($photo->title, 30)); ?></span>
                                <span class="photo-stats"><?php echo e($photo->comments_count); ?> komentar</span>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <p class="no-data">Belum ada foto yang dikomentari</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="stats-row">
        <!-- Recent Photos -->
        <div class="stats-card">
            <div class="card-header">
                <h3><i class="fas fa-clock"></i> Foto Terbaru</h3>
            </div>
            <div class="card-content">
                <?php if($recentPhotos->count() > 0): ?>
                    <?php $__currentLoopData = $recentPhotos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="recent-item">
                            <div class="recent-info">
                                <span class="recent-title"><?php echo e(Str::limit($photo->title, 25)); ?></span>
                                <span class="recent-meta"><?php echo e($photo->created_at->diffForHumans()); ?></span>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <p class="no-data">Belum ada foto</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Recent Users -->
        <div class="stats-card">
            <div class="card-header">
                <h3><i class="fas fa-user-plus"></i> Pengguna Terbaru</h3>
            </div>
            <div class="card-content">
                <?php if($recentUsers->count() > 0): ?>
                    <?php $__currentLoopData = $recentUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="recent-item">
                            <div class="recent-info">
                                <span class="recent-title"><?php echo e($user->name); ?></span>
                                <span class="recent-meta"><?php echo e($user->created_at->diffForHumans()); ?></span>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <p class="no-data">Belum ada pengguna</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Recent Comments -->
        <div class="stats-card">
            <div class="card-header">
                <h3><i class="fas fa-comment"></i> Komentar Terbaru</h3>
            </div>
            <div class="card-content">
                <?php if($recentComments->count() > 0): ?>
                    <?php $__currentLoopData = $recentComments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="recent-item">
                            <div class="recent-info">
                                <span class="recent-title"><?php echo e(Str::limit($comment->comment, 25)); ?></span>
                                <span class="recent-meta"><?php echo e($comment->name); ?> • <?php echo e($comment->created_at->diffForHumans()); ?></span>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <p class="no-data">Belum ada komentar</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<style>
.stats-container {
    padding: 20px;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.stat-card {
    background: white;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    display: flex;
    align-items: center;
    gap: 15px;
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 24px;
}

.stat-content h3 {
    font-size: 28px;
    font-weight: bold;
    margin: 0;
    color: #1f2937;
}

.stat-content p {
    margin: 5px 0 0 0;
    color: #6b7280;
    font-size: 14px;
}

.stats-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.stats-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    overflow: hidden;
}

.card-header {
    padding: 20px;
    background: #f8fafc;
    border-bottom: 1px solid #e5e7eb;
}

.card-header h3 {
    margin: 0;
    color: #1f2937;
    font-size: 16px;
    font-weight: 600;
}

.card-header i {
    margin-right: 8px;
    color: #6366f1;
}

.card-content {
    padding: 20px;
}

.category-stat, .monthly-stat, .growth-stat {
    margin-bottom: 15px;
}

.category-info, .monthly-info, .growth-info {
    display: flex;
    justify-content: space-between;
    margin-bottom: 5px;
}

.category-name, .monthly-month, .growth-month {
    font-weight: 500;
    color: #374151;
}

.category-count, .monthly-count, .growth-count {
    color: #6b7280;
    font-size: 14px;
}

.progress-bar {
    height: 6px;
    background: #e5e7eb;
    border-radius: 3px;
    overflow: hidden;
}

.progress-fill {
    height: 100%;
    background: linear-gradient(90deg, #6366f1 0%, #8b5cf6 100%);
    border-radius: 3px;
    transition: width 0.3s ease;
}

.top-photo, .recent-item {
    padding: 12px 0;
    border-bottom: 1px solid #f3f4f6;
}

.top-photo:last-child, .recent-item:last-child {
    border-bottom: none;
}

.photo-info, .recent-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.photo-title, .recent-title {
    font-weight: 500;
    color: #374151;
}

.photo-stats, .recent-meta {
    color: #6b7280;
    font-size: 14px;
}

.no-data {
    text-align: center;
    color: #9ca3af;
    padding: 40px 0;
}

.page-header {
    background: white;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 30px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.page-header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.page-title {
    margin: 0 0 5px 0;
    color: #000000 !important;
    font-size: 24px;
    font-weight: 700;
}

.page-title i {
    margin-right: 10px;
    color: #6366f1;
}

.page-description {
    margin: 0;
    color: #6b7280;
    font-size: 14px;
}

.btn {
    padding: 10px 20px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s;
}

.btn-primary {
    background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
    color: white;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ujikomrasya\resources\views/admin/statistics/index.blade.php ENDPATH**/ ?>