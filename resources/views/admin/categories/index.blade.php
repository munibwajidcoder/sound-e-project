@extends('layouts.admin')
@section('title', 'Manage Categories')
@section('page-title', 'Categories')
@section('top-action')
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">+ Add Category</a>
@endsection

@section('content')
<div class="card">
    <div style="overflow-x:auto">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Slug</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                <tr>
                    <td>#{{ $category->id }}</td>
                    <td style="font-weight:600; color:#fff;">{{ $category->name }}</td>
                    <td>
                        <span class="badge badge-info" style="text-transform:capitalize;">{{ $category->type }}</span>
                    </td>
                    <td style="color:#aaa;">{{ $category->slug }}</td>
                    <td style="color:#aaa;">{{ Str::limit($category->description, 40) ?: 'N/A' }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-secondary">Edit</a>
                            <form method="POST" action="{{ route('admin.categories.destroy', $category->id) }}" onsubmit="return confirm('Delete category?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center; color:#888; padding:30px;">No categories found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="margin-top:20px;">
        {{ $categories->links() }}
    </div>
</div>
@endsection
