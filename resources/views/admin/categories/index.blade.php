{{-- resources/views/admin/categories/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Categories')
@section('page_title', 'Categories')
@section('page_icon', 'fas fa-layer-group')

@section('content')

    <div class="category-wrapper">

        {{-- Header --}}
        <div class="page-header">

            <div>
                <h2>Categories</h2>
                <p>Manage trekking gear categories</p>
            </div>

            <a href="{{ route('admin.categories.create') }}" class="add-btn">
                <i class="fas fa-plus"></i>
                Add Category
            </a>

        </div>

        {{-- Flash Messages --}}
        @if (session('success'))
            <div class="alert-box success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Filters --}}
        <div class="filter-card">

            <form method="GET" class="filter-form">

                <div class="filter-group">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search categories...">
                </div>

                <div class="filter-group">
                    <select name="status">
                        <option value="">All Status</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="filter-group">
                    <select name="parent">
                        <option value="">All Levels</option>
                        <option value="top" {{ request('parent') === 'top' ? 'selected' : '' }}>Top Level Only</option>
                        <option value="sub" {{ request('parent') === 'sub' ? 'selected' : '' }}>Subcategories Only
                        </option>
                    </select>
                </div>

                <button type="submit" class="filter-btn">
                    <i class="fas fa-filter"></i>
                    Filter
                </button>

                <a href="{{ route('admin.categories.index') }}" class="reset-btn">
                    Reset
                </a>

            </form>

        </div>

        {{-- Table --}}
        <div class="table-card">

            <table>

                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Parent</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($categories as $category)
                        <tr>
                            <td>
                                @if ($category->image)
                                    <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}"
                                        class="thumb">
                                @else
                                    <div class="thumb no-thumb">
                                        <i class="fas fa-image"></i>
                                    </div>
                                @endif
                            </td>

                            <td>
                                <span class="cell-title">{{ $category->name }}</span>
                            </td>

                            <td>
                                <span class="cell-muted">{{ $category->slug }}</span>
                            </td>

                            <td>
                                @if ($category->parent)
                                    <span class="parent-chip">{{ $category->parent->name }}</span>
                                @else
                                    <span class="cell-muted">—</span>
                                @endif
                            </td>

                            <td>
                                <span class="status-badge {{ $category->is_active ? 'active' : 'inactive' }}">
                                    {{ $category->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>

                            <td>
                                <span class="cell-muted">{{ $category->created_at->format('M d, Y') }}</span>
                            </td>

                            <td class="text-right">
                                <div class="action-group">

                                    <a href="{{ route('admin.categories.show', $category) }}" class="action-btn view"
                                        title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a href="{{ route('admin.categories.edit', $category) }}" class="action-btn edit"
                                        title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this category?');">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="action-btn delete" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <i class="fas fa-box-open"></i>
                                    <p>No categories found.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

        @if ($categories->hasPages())
            <div class="pagination-wrap">
                {{ $categories->links() }}
            </div>
        @endif

    </div>

@endsection

@push('styles')
    <style>
        .category-wrapper {
            max-width: 1300px;
            margin: auto;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            gap: 20px;
        }

        .page-header h2 {
            font-size: 28px;
            color: #1e293b;
            margin: 0;
        }

        .page-header p {
            margin-top: 5px;
            color: #64748b;
        }

        .add-btn {
            background: #1e293b;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .add-btn:hover {
            background: #0f172a;
            color: white;
        }

        .alert-box {
            padding: 16px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .alert-box.success {
            background: #dcfce7;
            border: 1px solid #bbf7d0;
            color: #16a34a;
        }

        .filter-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 18px 20px;
            margin-bottom: 20px;
        }

        .filter-form {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
            align-items: center;
        }

        .filter-group input,
        .filter-group select {
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 14px;
            min-width: 180px;
        }

        .filter-group input:focus,
        .filter-group select:focus {
            outline: none;
            border-color: #e9b35f;
            box-shadow: 0 0 0 3px rgba(233, 179, 95, 0.2);
        }

        .filter-btn {
            background: #e9b35f;
            color: #1e293b;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .filter-btn:hover {
            background: #dba236;
        }

        .reset-btn {
            color: #64748b;
            padding: 10px 14px;
            text-decoration: none;
            font-size: 14px;
        }

        .reset-btn:hover {
            color: #1e293b;
        }

        .table-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            text-align: left;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #64748b;
            padding: 14px 18px;
            border-bottom: 1px solid #e2e8f0;
            background: #f8fafc;
            white-space: nowrap;
        }

        tbody td {
            padding: 14px 18px;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        tbody tr:hover {
            background: #f8fafc;
        }

        .text-right {
            text-align: right;
        }

        .thumb {
            width: 48px;
            height: 48px;
            border-radius: 8px;
            object-fit: cover;
            border: 1px solid #e2e8f0;
        }

        .no-thumb {
            display: flex;
            align-items: center;
            justify-content: center;
            color: #cbd5e1;
            background: #f8fafc;
        }

        .cell-title {
            font-weight: 600;
            color: #1e293b;
        }

        .cell-muted {
            color: #64748b;
            font-size: 13px;
        }

        .parent-chip {
            background: #f1f5f9;
            color: #1e293b;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        .status-badge.active {
            background: #dcfce7;
            color: #16a34a;
        }

        .status-badge.inactive {
            background: #fee2e2;
            color: #dc2626;
        }

        .action-group {
            display: flex;
            gap: 8px;
            justify-content: flex-end;
        }

        .action-btn {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            cursor: pointer;
            text-decoration: none;
            font-size: 13px;
        }

        .action-btn.view {
            background: #eff6ff;
            color: #2563eb;
        }

        .action-btn.view:hover {
            background: #dbeafe;
        }

        .action-btn.edit {
            background: #fffbeb;
            color: #d97706;
        }

        .action-btn.edit:hover {
            background: #fef3c7;
        }

        .action-btn.delete {
            background: #fef2f2;
            color: #dc2626;
        }

        .action-btn.delete:hover {
            background: #fee2e2;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #94a3b8;
        }

        .empty-state i {
            font-size: 2.2rem;
            margin-bottom: 12px;
            color: #cbd5e1;
        }

        .pagination-wrap {
            margin-top: 24px;
            display: flex;
            justify-content: center;
        }

        @media(max-width: 768px) {

            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .add-btn {
                width: 100%;
                justify-content: center;
            }

            .filter-form {
                flex-direction: column;
                align-items: stretch;
            }

            .filter-group input,
            .filter-group select {
                min-width: 100%;
            }

            .filter-btn,
            .reset-btn {
                text-align: center;
                justify-content: center;
            }
        }
    </style>
@endpush
