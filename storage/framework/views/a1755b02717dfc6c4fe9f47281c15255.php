<?php $__env->startSection('title', 'Manajemen Foto'); ?>

<?php $__env->startSection('page-title', 'Manajemen Foto'); ?>

<?php $__env->startSection('content'); ?>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<style>
        /* Page Header */
        .page-header-modern {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 20px;
            padding: 40px;
            margin-bottom: 32px;
            color: white;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
            position: relative;
            overflow: hidden;
        }

        .page-header-modern::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .page-header-modern h1 {
            font-size: 36px;
            font-weight: 800;
            margin: 0 0 12px 0;
            position: relative;
            z-index: 1;
            letter-spacing: -0.02em;
        }

        .page-header-modern p {
            font-size: 16px;
            opacity: 0.95;
            margin: 0;
            position: relative;
            z-index: 1;
        }

        /* Stats Overview */
        .stats-overview {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 24px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 28px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border: 1px solid #e2e8f0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #3b82f6, #8b5cf6);
        }

        .stat-card:nth-child(1)::before { background: linear-gradient(90deg, #3b82f6, #2563eb); }
        .stat-card:nth-child(2)::before { background: linear-gradient(90deg, #8b5cf6, #7c3aed); }
        .stat-card:nth-child(3)::before { background: linear-gradient(90deg, #06b6d4, #0891b2); }
        .stat-card:nth-child(4)::before { background: linear-gradient(90deg, #10b981, #059669); }

        .stat-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.12);
        }

        .stat-icon-wrapper {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
            font-size: 28px;
        }

        .stat-card:nth-child(1) .stat-icon-wrapper { 
            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
            color: #1e40af;
        }
        .stat-card:nth-child(2) .stat-icon-wrapper { 
            background: linear-gradient(135deg, #ede9fe, #ddd6fe);
            color: #6d28d9;
        }
        .stat-card:nth-child(3) .stat-icon-wrapper { 
            background: linear-gradient(135deg, #cffafe, #a5f3fc);
            color: #0e7490;
        }
        .stat-card:nth-child(4) .stat-icon-wrapper { 
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
            color: #065f46;
        }

        .stat-number {
            font-size: 32px;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 6px;
            line-height: 1;
        }

        .stat-label {
            color: #64748b;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .search-filter-section {
            background: white;
            border-radius: 20px;
            padding: 32px;
            margin-bottom: 32px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
            border: 1px solid #e2e8f0;
            position: relative;
            overflow: hidden;
        }

        .search-filter-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2, #f093fb);
        }

        .search-container {
            margin-bottom: 24px;
        }

        .search-form {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        
        .search-controls {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }
        
        @media (max-width: 768px) {
            .search-controls {
                flex-direction: column;
            }
        }

        .search-input-group {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            align-items: center;
        }

        .search-input {
            flex: 1;
            padding: 14px 16px 14px 48px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #f8fafc;
            color: #1e293b;
            position: relative;
        }

        .search-input-wrapper {
            position: relative;
            flex: 1;
        }

        .search-input-wrapper::before {
            content: '\f002';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            z-index: 1;
            pointer-events: none;
            color: #94a3b8;
        }

        .search-input:focus {
            outline: none;
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        .search-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 14px 24px;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 15px;
        }

        .search-btn:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        .filter-group {
            display: flex;
            gap: 12px;
            align-items: center;
            flex-wrap: wrap;
        }

        .category-filter {
            padding: 10px 16px;
            border: 1px solid var(--secondary-300);
            border-radius: 8px;
            font-size: 14px;
            background: white !important;
            color: #1e293b !important;
            transition: all 0.2s ease;
            min-width: 200px;
        }

        .category-filter option {
            background: white !important;
            color: #1e293b !important;
        }

        .category-filter:focus {
            outline: none;
            border-color: #10b981;
            background: white !important;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        .filter-btn {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 15px;
        }

        .filter-btn:hover {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
        }

        .clear-btn {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 15px;
        }

        .clear-btn:hover {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
        }

        .search-results-info {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            color: #0c4a6e;
            padding: 16px 20px;
            border-radius: 8px;
            text-align: center;
            border: 1px solid #7dd3fc;
        }

        .results-count {
            font-size: 14px;
            font-weight: 500;
        }

        .results-count strong {
            color: #1e293b;
        }

        .results-count .category-badge {
            background: #3b82f6;
            color: #1e40af;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 500;
            margin-left: 5px;
        }

        .main-content {
            display: block;
            margin-bottom: 32px;
        }

        .upload-section {
            background: white;
            border-radius: 20px;
            padding: 32px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
            height: fit-content;
            border: 1px solid #e2e8f0;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .upload-section:hover {
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
        }

        .upload-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #10b981, #06b6d4);
        }

        .upload-section h2 {
            color: #1e293b !important;
            font-size: 20px;
            margin-bottom: 28px;
            padding-bottom: 16px;
            border-bottom: 2px solid #f1f5f9;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .upload-section h2::before {
            content: '\f093';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            font-size: 24px;
            margin-right: 8px;
        }

        /* Alert Messages */
        .alert-modern {
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 24px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            font-weight: 500;
            font-size: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-modern i {
            font-size: 20px;
            margin-top: 2px;
        }

        .alert-success-modern {
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
            color: #065f46;
            border: 2px solid #6ee7b7;
        }

        .alert-success-modern i {
            color: #059669;
        }

        .alert-error-modern {
            background: linear-gradient(135deg, #fee2e2, #fecaca);
            color: #991b1b;
            border: 2px solid #fca5a5;
        }

        .alert-error-modern i {
            color: #dc2626;
        }

        .alert-warning-modern {
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            color: #92400e;
            border: 2px solid #fcd34d;
        }

        .alert-warning-modern i {
            color: #d97706;
        }

        .alert-warning-modern ul {
            margin: 8px 0 0 20px;
            padding: 0;
        }

        .alert-warning-modern li {
            margin: 4px 0;
        }

        .form-group {
            margin-bottom: 24px;
            position: relative;
        }

        .form-group label {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 10px;
            color: #1e293b;
            font-weight: 600;
            font-size: 14px;
            letter-spacing: -0.01em;
        }

        .form-group label::before {
            content: '';
            width: 4px;
            height: 16px;
            background: linear-gradient(135deg, #10b981, #06b6d4);
            border-radius: 2px;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            color: #64748b;
            font-size: 18px;
            pointer-events: none;
            transition: all 0.2s ease;
            z-index: 1;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 14px 16px 14px 48px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: #ffffff !important;
            color: #1e293b !important;
            font-family: 'Inter', sans-serif;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .form-group textarea {
            padding: 14px 16px;
            min-height: 100px;
            resize: vertical;
            line-height: 1.6;
        }

        .form-group select {
            padding: 14px 16px 14px 48px;
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2364748b' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 16px center;
            background-size: 12px;
            padding-right: 40px;
        }

        .form-group select option {
            background: white !important;
            color: #1e293b !important;
            padding: 12px;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #10b981;
            background: #ffffff !important;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1), 0 4px 12px rgba(0, 0, 0, 0.08);
            transform: translateY(-1px);
        }

        .form-group input:focus ~ .input-icon,
        .form-group textarea:focus ~ .input-icon,
        .form-group select:focus ~ .input-icon {
            color: #10b981;
            transform: scale(1.1);
        }

        .form-group textarea ~ .input-icon {
            top: 16px;
        }

        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: #94a3b8;
            font-weight: 400;
        }

        .upload-btn {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border: none;
            padding: 14px 20px;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .upload-btn:hover {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
        }

        /* Drag and Drop Styles */
        .drag-drop-area {
            border: 2px dashed var(--secondary-300);
            border-radius: 12px;
            padding: 40px 20px;
            text-align: center;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .drag-drop-area:hover {
            border-color: #10b981;
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            transform: translateY(-2px);
        }

        .drag-drop-area.dragover {
            border-color: #10b981;
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            border-width: 3px;
            transform: scale(1.02);
        }

        .drag-drop-icon {
            font-size: 48px;
            margin-bottom: 16px;
            color: #10b981;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .drag-drop-text {
            color: var(--secondary-700);
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .drag-drop-hint {
            color: var(--secondary-500);
            font-size: 13px;
        }

        .file-input-hidden {
            display: none;
        }

        .preview-container {
            margin-top: 20px;
            display: none;
        }

        .preview-container.active {
            display: block;
        }

        .preview-image-wrapper {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            border: 2px solid var(--secondary-200);
            background: white;
            padding: 8px;
        }

        .preview-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
        }

        .preview-info {
            margin-top: 12px;
            padding: 12px;
            background: #f0f9ff;
            border-radius: 8px;
            border: 1px solid #bae6fd;
        }

        .preview-filename {
            font-size: 13px;
            color: #0c4a6e;
            font-weight: 600;
            margin-bottom: 4px;
            word-break: break-all;
        }

        .preview-filesize {
            font-size: 12px;
            color: #0369a1;
        }

        .remove-preview {
            position: absolute;
            top: 16px;
            right: 16px;
            background: rgba(239, 68, 68, 0.9);
            color: white;
            border: none;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            z-index: 10;
        }

        .remove-preview:hover {
            background: rgba(220, 38, 38, 1);
            transform: scale(1.1);
        }

        .photos-section {
            background: white;
            border-radius: 20px;
            padding: 32px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
            border: 1px solid #e2e8f0;
            position: relative;
            overflow: hidden;
        }

        .photos-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #8b5cf6, #3b82f6);
        }

        .photos-section h2 {
            color: #1e293b !important;
            font-size: 22px;
            margin-bottom: 28px;
            padding-bottom: 16px;
            border-bottom: 2px solid #f1f5f9;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .photos-section h2::before {
            content: '\f03e';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            font-size: 24px;
            margin-right: 8px;
        }

        /* Section Header */
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f1f5f9;
        }

        .section-header h2 {
            margin: 0;
            color: #1e293b !important;
            font-size: 22px;
            font-weight: 700;
        }

        .photo-count {
            display: flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, #f0f9ff, #e0f2fe);
            padding: 10px 18px;
            border-radius: 12px;
            border: 1px solid #bae6fd;
        }

        .count-badge {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
            padding: 6px 14px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.95rem;
            box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3);
        }

        .count-text {
            color: #0c4a6e;
            font-size: 0.95rem;
            font-weight: 600;
        }

        /* Photos Table */
        .photos-table-container {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border: 1px solid #e2e8f0;
        }

        .photos-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            font-size: 0.9rem;
        }

        .photos-table th {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            padding: 18px 16px;
            text-align: left;
            font-weight: 700;
            color: #1e293b;
            border-bottom: 2px solid #e2e8f0;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .photos-table th:first-child {
            border-top-left-radius: 16px;
        }

        .photos-table th:last-child {
            border-top-right-radius: 16px;
        }

        .photos-table td {
            padding: 20px 16px;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
            color: #475569;
            transition: all 0.2s ease;
        }

        .photo-row {
            transition: all 0.2s ease;
        }

        .photo-row:hover {
            background: linear-gradient(90deg, rgba(59, 130, 246, 0.05) 0%, rgba(139, 92, 246, 0.05) 100%);
            transform: scale(1.01);
        }

        .photo-row:last-child td {
            border-bottom: none;
        }

        /* Photo Thumbnail */
        .photo-thumbnail {
            width: 100px;
            height: 75px;
            border-radius: 12px;
            overflow: hidden;
            border: 3px solid #e2e8f0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .photo-row:hover .photo-thumbnail {
            border-color: #3b82f6;
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .thumbnail-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .photo-row:hover .thumbnail-image {
            transform: scale(1.1);
        }

        /* Info Cell */
        .info-cell {
            min-width: 200px;
        }

        .photo-title {
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 6px;
            font-size: 1rem;
            line-height: 1.3;
        }

        .photo-description {
            color: #64748b;
            font-size: 0.85rem;
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Category Cell */
        .category-cell {
            min-width: 120px;
        }

        .category-badge {
            padding: 8px 14px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-block;
            text-align: center;
            min-width: 110px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: all 0.2s ease;
        }

        .photo-row:hover .category-badge {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        /* Category Colors */
        .category-kegiatan { background: #3b82f6; color: #ffffff; font-weight: 600; }
        .category-prestasi { background: #f59e0b; color: #ffffff; font-weight: 600; }
        .category-fasilitas { background: #10b981; color: #ffffff; font-weight: 600; }
        .category-guru { background: #8b5cf6; color: #ffffff; font-weight: 600; }
        .category-siswa { background: #ef4444; color: #ffffff; font-weight: 600; }
        .category-ekstrakurikuler { background: #06b6d4; color: #ffffff; font-weight: 600; }
        .category-olahraga { background: #22c55e; color: #ffffff; font-weight: 600; }
        .category-seni { background: #ec4899; color: #ffffff; font-weight: 600; }
        .category-teknologi { background: #0ea5e9; color: #ffffff; font-weight: 600; }
        .category-perpustakaan { background: #eab308; color: #ffffff; font-weight: 600; }
        .category-upacara { background: #f97316; color: #ffffff; font-weight: 600; }
        .category-general { background: #64748b; color: #ffffff; font-weight: 600; }

        /* Uploader Cell */
        .uploader-cell {
            min-width: 120px;
        }

        .uploader-info {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .uploader-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 0.75rem;
        }

        .uploader-name {
            color: #1e293b;
            font-weight: 600;
            font-size: 0.9rem;
        }

        /* Date Cell */
        .date-cell {
            min-width: 100px;
        }

        .date-info {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .date-main {
            font-weight: 700;
            color: #1e293b;
            font-size: 0.9rem;
        }

        .date-time {
            color: #64748b;
            font-size: 0.75rem;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .date-time::before {
            content: '🕐';
            font-size: 0.7rem;
        }

        /* Actions Cell */
        .actions-cell {
            min-width: 140px;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .action-btn {
            padding: 10px 16px;
            border: none;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            transition: all 0.3s ease;
            min-width: 70px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .edit-btn {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
        }

        .edit-btn:hover {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
        }

        .delete-btn {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }

        .delete-btn:hover:not(:disabled) {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
        }

        .delete-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        /* Responsive Table */
        @media (max-width: 1024px) {
            .photos-table-container {
                overflow-x: auto;
            }
            
            .photos-table {
                min-width: 800px;
            }
        }

        @media (max-width: 768px) {
            .section-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }
            
            .photos-table th,
            .photos-table td {
                padding: 12px 8px;
                font-size: 0.8rem;
            }
            
            .photo-thumbnail {
                width: 60px;
                height: 45px;
            }
            
            .action-buttons {
                flex-direction: column;
                gap: 4px;
            }
            
            .action-btn {
                padding: 6px 8px;
                font-size: 0.75rem;
                min-width: 50px;
            }
        }

        .no-photos {
            text-align: center;
            padding: 64px 32px;
            color: #64748b;
        }

        .no-photos-icon {
            font-size: 72px;
            margin-bottom: 24px;
            opacity: 0.6;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .no-photos h3 {
            color: #1e293b;
            font-size: 24px;
            font-weight: 700;
            margin: 0 0 12px 0;
        }

        .no-photos p {
            color: #64748b;
            font-size: 16px;
            margin: 0 0 24px 0;
        }

        .upload-suggestion {
            margin-top: 24px;
            padding: 16px 24px;
            background: linear-gradient(135deg, #f0f9ff, #e0f2fe);
            border: 2px solid #bae6fd;
            border-radius: 12px;
            color: #0c4a6e;
            font-size: 0.95rem;
            font-weight: 500;
            display: inline-block;
            box-shadow: 0 2px 8px rgba(14, 165, 233, 0.2);
        }


        @media (max-width: 1024px) {
            .main-content {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .stats-overview {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .search-input-group {
                flex-direction: column;
                align-items: stretch;
            }
            
            .category-filter {
                min-width: auto;
            }
            
            .search-btn, .clear-btn {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .stats-overview {
                grid-template-columns: 1fr;
            }
        }

        /* Modal Styles */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            padding: 20px;
            animation: fadeIn 0.3s ease;
        }

        .modal-overlay.active {
            display: flex;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal-container {
            background: white;
            border-radius: 20px;
            width: 100%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: slideUp 0.3s ease;
            position: relative;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header {
            padding: 24px 32px;
            border-bottom: 2px solid #f1f5f9;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            background: white;
            z-index: 10;
            border-radius: 20px 20px 0 0;
        }

        .modal-header h2 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            color: #1e293b;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .modal-header h2::before {
            content: '\f093';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            font-size: 28px;
            margin-right: 8px;
        }

        .modal-close {
            background: #f1f5f9;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            color: #64748b;
            font-size: 20px;
        }

        .modal-close:hover {
            background: #e2e8f0;
            color: #1e293b;
            transform: rotate(90deg);
        }

        .modal-body {
            padding: 32px;
        }

        .add-photo-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 14px 28px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 24px;
        }

        .add-photo-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        .add-photo-btn i {
            font-size: 18px;
        }

        .main-content {
            display: block;
        }

        .upload-section {
            display: none;
        }

        /* Responsive Styles */
        @media (max-width: 1024px) {
            .page-header-modern {
                padding: 30px;
            }
            
            .page-header-modern h1 {
                font-size: 32px;
            }
            
            .stats-overview {
                grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
                gap: 16px;
            }
            
            .stat-card {
                padding: 20px;
            }
            
            .stat-number {
                font-size: 28px;
            }
            
            .search-filter-section {
                padding: 24px;
            }
            
            .section-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }
            
            .photo-count {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 768px) {
            .page-header-modern {
                padding: 24px;
                text-align: center;
            }
            
            .page-header-modern h1 {
                font-size: 28px;
            }
            
            .page-header-modern p {
                font-size: 14px;
            }
            
            .stats-overview {
                grid-template-columns: 1fr 1fr;
                gap: 12px;
            }
            
            .stat-card {
                padding: 16px;
            }
            
            .stat-number {
                font-size: 24px;
            }
            
            .stat-label {
                font-size: 12px;
            }
            
            .search-filter-section {
                padding: 20px;
            }
            
            .search-input-group {
                flex-direction: column;
            }
            
            .search-btn {
                width: 100%;
                justify-content: center;
            }
            
            .filter-group {
                flex-direction: column;
                align-items: stretch;
            }
            
            .category-filter {
                min-width: auto;
                width: 100%;
            }
            
            .filter-btn {
                width: 100%;
                justify-content: center;
            }
            
            .photos-table-container {
                overflow-x: auto;
            }
            
            .photos-table {
                min-width: 600px;
            }
            
            .photo-thumbnail {
                width: 80px;
                height: 60px;
            }
            
            .info-cell {
                min-width: 150px;
            }
        }

        @media (max-width: 480px) {
            .page-header-modern {
                padding: 20px;
            }
            
            .page-header-modern h1 {
                font-size: 24px;
            }
            
            .stats-overview {
                grid-template-columns: 1fr;
            }
            
            .stat-card {
                padding: 16px;
            }
            
            .stat-number {
                font-size: 20px;
            }
            
            .search-filter-section {
                padding: 16px;
            }
            
            .search-input {
                padding: 12px 16px 12px 40px;
                font-size: 14px;
            }
            
            .search-input-wrapper::before {
                font-size: 16px;
                left: 12px;
            }
            
            .search-btn, .filter-btn {
                padding: 12px;
                font-size: 14px;
            }
            
            .photos-table th,
            .photos-table td {
                padding: 12px 8px;
                font-size: 0.8rem;
            }
            
            .photo-thumbnail {
                width: 60px;
                height: 45px;
            }
            
            .photo-title {
                font-size: 0.9rem;
            }
            
            .photo-description {
                font-size: 0.75rem;
            }
            
            .action-buttons {
                flex-direction: column;
                gap: 4px;
            }
            
            .action-btn {
                padding: 6px 10px;
                font-size: 0.75rem;
            }
            
            .add-photo-btn {
                padding: 12px 20px;
                font-size: 14px;
            }
        }
</style>

        <div class="page-header-modern">
            <h1><i class="fas fa-camera"></i> Manajemen Foto</h1>
            <p>Kelola dan atur semua foto galeri sekolah dengan mudah</p>
        </div>

        <div class="stats-overview">
            <div class="stat-card">
                <div class="stat-number"><?php echo e($totalPhotos ?? $photos->total()); ?></div>
                <div class="stat-label">Total Foto</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo e($activeCategories ?? $photos->groupBy('category')->count()); ?></div>
                <div class="stat-label">Kategori Aktif</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo e($activeAdmins ?? $photos->groupBy('uploaded_by')->count()); ?></div>
                <div class="stat-label">Admin Aktif</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo e($photosThisWeek ?? $photos->where('created_at', '>=', now()->subDays(7))->count()); ?></div>
                <div class="stat-label">Foto Minggu Ini</div>
            </div>
        </div>

        <div class="search-filter-section">
            <div class="search-container">
                <form method="GET" action="<?php echo e(route('admin.photos.index')); ?>" class="search-form" onsubmit="saveScrollPosition()">
                    <div class="search-input-group">
                        <div class="search-input-wrapper">
                            <input type="text" 
                                   name="search" 
                                   value="<?php echo e(request('search')); ?>" 
                                   placeholder="Cari foto berdasarkan judul atau deskripsi..."
                                   class="search-input">
                        </div>
                        <select name="category" class="category-filter">
                            <option value="all" <?php echo e(request('category') == 'all' || !request('category') ? 'selected' : ''); ?>>
                                Semua Kategori
                            </option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($key); ?>" <?php echo e(request('category') == $key ? 'selected' : ''); ?>>
                                    <?php echo e($category); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <button type="submit" class="search-btn">
                            <i class="fas fa-search"></i> Cari
                        </button>
                        <?php if(request('search') || (request('category') && request('category') !== 'all')): ?>
                            <a href="<?php echo e(route('admin.photos.index')); ?>" class="clear-btn">
                                <i class="fas fa-times"></i> Bersihkan
                            </a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
            
            <?php if(request('search') || (request('category') && request('category') !== 'all')): ?>
                <div class="search-results-info">
                    <div class="results-count">
                        Ditemukan <strong><?php echo e($photos->count()); ?></strong> foto
                        <?php if(request('search')): ?>
                            untuk pencarian: "<strong><?php echo e(request('search')); ?></strong>"
                        <?php endif; ?>
                        <?php if(request('category') && request('category') !== 'all'): ?>
                            dalam kategori: <span class="category-badge"><?php echo e(\App\Helpers\CategoryHelper::getCategoryName(request('category'))); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <?php if(session('success')): ?>
            <div class="alert-modern alert-success-modern" style="margin-bottom: 24px;">
                <span><?php echo e(session('success')); ?></span>
            </div>
        <?php endif; ?>
        
        <?php if(session('error')): ?>
            <div class="alert-modern alert-error-modern" style="margin-bottom: 24px;">
                <span><?php echo e(session('error')); ?></span>
            </div>
        <?php endif; ?>

        <button type="button" class="add-photo-btn" onclick="openModal()">
            Tambah Foto Baru
        </button>

        <!-- Modal -->
        <div class="modal-overlay" id="uploadModal" onclick="closeModalOnOverlay(event)">
            <div class="modal-container" onclick="event.stopPropagation()">
                <div class="modal-header">
                    <h2>Tambah Foto Baru</h2>
                    <button type="button" class="modal-close" onclick="closeModal()">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <?php if($errors->any()): ?>
                        <div class="alert-modern alert-warning-modern" style="margin-bottom: 24px;">
                            <div>
                                <strong>Terjadi kesalahan:</strong>
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <form method="POST" action="<?php echo e(route('admin.photos.store')); ?>" enctype="multipart/form-data" id="uploadForm" onsubmit="saveScrollPosition()">
                    <?php echo csrf_field(); ?>
                    
                    <div class="form-group">
                        <label for="title">Judul Foto</label>
                        <div class="input-wrapper">
                            <input type="text" id="title" name="title" value="<?php echo e(old('title')); ?>" required placeholder="Masukkan judul foto">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <div class="input-wrapper">
                            <textarea id="description" name="description" rows="4" placeholder="Deskripsi foto (opsional)"><?php echo e(old('description')); ?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="category">Kategori</label>
                        <div class="input-wrapper">
                            <select id="category" name="category" required>
                                <option value="">Pilih Kategori</option>
                                <?php $__currentLoopData = \App\Helpers\CategoryHelper::getCategories(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($key); ?>" <?php echo e(old('category') == $key ? 'selected' : ''); ?>><?php echo e($name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="photo">Pilih Foto</label>
                        <div class="drag-drop-area" id="dragDropArea">
                            <div class="drag-drop-icon"><i class="fas fa-camera" style="font-size: 48px; color: #94a3b8;"></i></div>
                            <div class="drag-drop-text">Drag & Drop foto di sini</div>
                            <div class="drag-drop-hint">atau klik untuk memilih file</div>
                        </div>
                        <input type="file" id="photo" name="photo" accept="image/*" class="file-input-hidden">
                        
                        <div class="preview-container" id="previewContainer">
                            <div class="preview-image-wrapper">
                                <img id="previewImage" class="preview-image" src="" alt="Preview">
                                <button type="button" class="remove-preview" id="removePreview" title="Hapus foto">×</button>
                            </div>
                            <div class="preview-info">
                                <div class="preview-filename" id="previewFilename"></div>
                                <div class="preview-filesize" id="previewFilesize"></div>
                            </div>
                        </div>
                    </div>

                    <div style="display: flex; gap: 12px; margin-top: 24px;">
                        <button type="submit" class="upload-btn" style="flex: 1;">
                            Upload Foto
                        </button>
                        <button type="button" class="cancel-btn" onclick="closeModal()" style="flex: 1; background: #f1f5f9; color: #475569; border: 2px solid #e2e8f0; padding: 14px; border-radius: 10px; font-weight: 600; cursor: pointer; transition: all 0.3s ease;">
                            Batal
                        </button>
                    </div>
                </form>
                </div>
            </div>
        </div>

<script>
// Save scroll position before form submit
function saveScrollPosition() {
    sessionStorage.setItem('scrollPosition', window.scrollY);
}

// Restore scroll position after page load
window.addEventListener('load', function() {
    const scrollPosition = sessionStorage.getItem('scrollPosition');
    if (scrollPosition) {
        window.scrollTo(0, parseInt(scrollPosition));
        sessionStorage.removeItem('scrollPosition');
    }
});

// Drag and Drop Functionality
const dragDropArea = document.getElementById('dragDropArea');
const fileInput = document.getElementById('photo');
const previewContainer = document.getElementById('previewContainer');
const previewImage = document.getElementById('previewImage');
const previewFilename = document.getElementById('previewFilename');
const previewFilesize = document.getElementById('previewFilesize');
const removePreview = document.getElementById('removePreview');

// Track if file is selected
let selectedFile = null;

// Click to select file
dragDropArea.addEventListener('click', () => {
    fileInput.click();
});

// Reset selectedFile when input is cleared
fileInput.addEventListener('click', function() {
    // Reset when user clicks to select new file
    if (this.value === '') {
        selectedFile = null;
        previewContainer.classList.remove('active');
        dragDropArea.style.display = 'block';
    }
});

// Prevent default drag behaviors
['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    dragDropArea.addEventListener(eventName, preventDefaults, false);
    document.body.addEventListener(eventName, preventDefaults, false);
});

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

// Highlight drop area when item is dragged over it
['dragenter', 'dragover'].forEach(eventName => {
    dragDropArea.addEventListener(eventName, highlight, false);
});

['dragleave', 'drop'].forEach(eventName => {
    dragDropArea.addEventListener(eventName, unhighlight, false);
});

function highlight(e) {
    dragDropArea.classList.add('dragover');
}

function unhighlight(e) {
    dragDropArea.classList.remove('dragover');
}

// Handle dropped files
dragDropArea.addEventListener('drop', handleDrop, false);

function handleDrop(e) {
    const dt = e.dataTransfer;
    const files = dt.files;
    
    if (files.length > 0) {
        const file = files[0];
        selectedFile = file;
        
        // Set file to input using DataTransfer
        try {
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            fileInput.files = dataTransfer.files;
            console.log('File set to input via DataTransfer:', file.name);
        } catch (error) {
            console.log('DataTransfer not supported, using manual tracking');
            // Fallback: trigger change event manually
            const event = new Event('change', { bubbles: true });
            fileInput.dispatchEvent(event);
        }
        
        handleFiles(files);
    }
}

// Handle file input change
fileInput.addEventListener('change', function(e) {
    if (this.files && this.files.length > 0) {
        selectedFile = this.files[0];
        console.log('File selected via input:', selectedFile.name, selectedFile.size);
        handleFiles(this.files);
    } else {
        console.log('No file in input');
    }
});

function handleFiles(files) {
    const file = files[0];
    
    // Validate file type
    if (!file.type.startsWith('image/')) {
        alert('Hanya file gambar yang diperbolehkan!');
        selectedFile = null;
        return;
    }
    
    // Validate file size (max 5MB)
    const maxSize = 5 * 1024 * 1024; // 5MB
    if (file.size > maxSize) {
        alert('Ukuran file maksimal 5MB!');
        selectedFile = null;
        return;
    }
    
    // Show preview
    const reader = new FileReader();
    reader.onload = function(e) {
        previewImage.src = e.target.result;
        previewContainer.classList.add('active');
        dragDropArea.style.display = 'none';
    };
    reader.readAsDataURL(file);
    
    // Show file info
    previewFilename.textContent = file.name;
    previewFilesize.textContent = formatFileSize(file.size);
}

// Remove preview
removePreview.addEventListener('click', function(e) {
    e.stopPropagation();
    fileInput.value = '';
    selectedFile = null;
    previewContainer.classList.remove('active');
    dragDropArea.style.display = 'block';
    previewImage.src = '';
});

// Format file size
function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
}

// Form validation
const uploadForm = document.getElementById('uploadForm');
uploadForm.addEventListener('submit', function(e) {
    console.log('=== FORM SUBMIT DEBUG ===');
    console.log('Selected file:', selectedFile ? selectedFile.name : 'null');
    console.log('File input files length:', fileInput.files ? fileInput.files.length : 0);
    
    // Ensure file is properly attached to input
    if (selectedFile && (!fileInput.files || fileInput.files.length === 0)) {
        console.log('File not in input, attempting to set...');
        try {
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(selectedFile);
            fileInput.files = dataTransfer.files;
            console.log('File set successfully');
        } catch (error) {
            console.error('Failed to set file:', error);
        }
    }
    
    // Final check
    const hasFile = (fileInput.files && fileInput.files.length > 0) || selectedFile !== null;
    
    if (!hasFile) {
        e.preventDefault();
        alert('Silakan pilih foto terlebih dahulu!');
        return false;
    }
    
    // Verify file is in input before submit
    if (!fileInput.files || fileInput.files.length === 0) {
        e.preventDefault();
        console.error('File not properly attached to input!');
        alert('Terjadi kesalahan: File tidak ter-attach dengan benar. Silakan pilih file lagi.');
        return false;
    }
    
    console.log('File verified:', fileInput.files[0].name, fileInput.files[0].size, 'bytes');
    console.log('Form submitting normally...');
    return true;
});

// Modal Functions
function openModal() {
    const modal = document.getElementById('uploadModal');
    if (modal) {
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
}

function closeModal() {
    const modal = document.getElementById('uploadModal');
    if (modal) {
        modal.classList.remove('active');
        document.body.style.overflow = '';
        // Reset form
        const form = document.getElementById('uploadForm');
        if (form) {
            form.reset();
            // Reset preview
            const previewContainer = document.getElementById('previewContainer');
            const dragDropArea = document.getElementById('dragDropArea');
            if (previewContainer) previewContainer.classList.remove('active');
            if (dragDropArea) dragDropArea.style.display = 'block';
            selectedFile = null;
        }
    }
}

function closeModalOnOverlay(event) {
    if (event.target.id === 'uploadModal') {
        closeModal();
    }
}

// Close modal on ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeModal();
    }
});

// Auto open modal if there are errors
<?php if($errors->any()): ?>
    document.addEventListener('DOMContentLoaded', function() {
        openModal();
    });
<?php endif; ?>

// Delete photo with AJAX (no page refresh)
function deletePhoto(photoId, button) {
    if (!confirm('Apakah Anda yakin ingin menghapus foto ini?')) {
        return;
    }
    
    // Disable button and show loading
    button.disabled = true;
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menghapus...';
    
    // Get CSRF token
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    // Send DELETE request
    fetch(`/admin/photos/${photoId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': token,
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Find and remove the row with animation
            const row = button.closest('tr');
            row.style.transition = 'all 0.3s ease';
            row.style.opacity = '0';
            row.style.transform = 'translateX(-20px)';
            
            setTimeout(() => {
                row.remove();
                
                // Update photo count
                const countBadge = document.querySelector('.count-badge');
                if (countBadge) {
                    const currentCount = parseInt(countBadge.textContent);
                    countBadge.textContent = currentCount - 1;
                }
                
                // Check if no photos left
                const tbody = document.querySelector('.photos-table tbody');
                if (tbody && tbody.children.length === 0) {
                    location.reload(); // Reload to show "no photos" message
                }
                
                // Show success notification
                showNotification('Foto berhasil dihapus!', 'success');
            }, 300);
        } else {
            throw new Error(data.message || 'Gagal menghapus foto');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        button.disabled = false;
        button.innerHTML = 'Hapus';
        showNotification(error.message || 'Terjadi kesalahan saat menghapus foto', 'error');
    });
}

// Show notification
function showNotification(message, type = 'success') {
    // Remove existing notification if any
    const existingNotif = document.querySelector('.notification-toast');
    if (existingNotif) {
        existingNotif.remove();
    }
    
    // Create notification
    const notification = document.createElement('div');
    notification.className = `notification-toast notification-${type}`;
    notification.innerHTML = `
        <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
        <span>${message}</span>
    `;
    
    // Add styles
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: ${type === 'success' ? '#10b981' : '#ef4444'};
        color: white;
        padding: 16px 24px;
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.2);
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 15px;
        font-weight: 500;
        z-index: 10000;
        animation: slideInRight 0.3s ease;
    `;
    
    document.body.appendChild(notification);
    
    // Auto remove after 3 seconds
    setTimeout(() => {
        notification.style.animation = 'slideOutRight 0.3s ease';
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

// Add animation styles
const style = document.createElement('style');
style.textContent = `
    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    @keyframes slideOutRight {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);
</script>

        <div class="photos-section">
            <div class="section-header">
                <h2>Daftar Foto</h2>
                <div class="photo-count">
                    <span class="count-badge"><?php echo e($totalPhotos ?? $photos->total()); ?></span>
                    <span class="count-text">foto tersedia</span>
                </div>
            </div>
                
                <?php if($photos->count() > 0): ?>
                    <div class="photos-table-container">
                        <table class="photos-table">
                            <thead>
                                <tr>
                                    <th>Foto</th>
                                    <th>Informasi</th>
                                    <th>Kategori</th>
                                    <th>Uploader</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="photo-row">
                                        <td class="photo-cell">
                                            <div class="photo-thumbnail">
                                                <img src="<?php echo e($photo->photo_url); ?>" 
                                                     alt="<?php echo e($photo->title); ?>" 
                                                     class="thumbnail-image"
                                                     onerror="this.src='<?php echo e(asset('images/no-image.png')); ?>'; this.onerror=null;">
                                            </div>
                                        </td>
                                        <td class="info-cell">
                                            <div class="photo-title"><?php echo e($photo->title); ?></div>
                                            <?php if($photo->description): ?>
                                                <div class="photo-description"><?php echo e(Str::limit($photo->description, 100)); ?></div>
                                            <?php endif; ?>
                                        </td>
                                        <td class="category-cell">
                                            <span class="category-badge category-<?php echo e($photo->category); ?>">
                                                <?php echo e(\App\Helpers\CategoryHelper::getCategoryName($photo->category)); ?>

                                            </span>
                                        </td>
                                        <td class="uploader-cell">
                                            <div class="uploader-info">
                                                <div class="uploader-avatar">
                                                    <?php echo e(strtoupper(substr($photo->user->name ?: $photo->user->username, 0, 1))); ?>

                                                </div>
                                                <span class="uploader-name"><?php echo e($photo->user->name ?: $photo->user->username); ?></span>
                                            </div>
                                        </td>
                                        <td class="date-cell">
                                            <div class="date-info">
                                                <div class="date-main"><?php echo e($photo->created_at->format('d/m/Y')); ?></div>
                                                <div class="date-time"><?php echo e($photo->created_at->format('H:i')); ?></div>
                                            </div>
                                        </td>
                                        <td class="actions-cell">
                                            <div class="action-buttons">
                                                <a href="<?php echo e(route('admin.photos.edit', $photo->id)); ?>" 
                                                   class="action-btn edit-btn" 
                                                   title="Edit Foto">
                                                    Edit
                                                </a>
                                                <button type="button" 
                                                        class="action-btn delete-btn" 
                                                        title="Hapus Foto"
                                                        onclick="deletePhoto(<?php echo e($photo->id); ?>, this)">
                                                    Hapus
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="no-photos">
                        <div class="no-photos-icon"><i class="fas fa-camera" style="font-size: 4rem; opacity: 0.5;"></i></div>
                        <h3>Belum ada foto</h3>
                        <p>Mulai dengan mengupload foto pertama Anda!</p>
                        <div class="upload-suggestion">
                            <span><i class="fas fa-lightbulb"></i> Klik tombol "Tambah Foto Baru" di atas untuk menambahkan foto</span>
                        </div>
                    </div>
                <?php endif; ?>
        </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ujikomrasya\resources\views/admin/photos/index.blade.php ENDPATH**/ ?>