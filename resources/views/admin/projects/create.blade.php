@extends('layouts.admin')
@section('title', 'Add Project')

@section('content')
<div class="flex items-center justify-between mb-8">
  <h1 class="text-2xl font-bold text-white">Add New Project</h1>
  <a href="{{ route('admin.projects.index') }}" class="text-gray-400 hover:text-white text-sm">← Back</a>
</div>

<form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data"
      class="bg-gray-900 border border-gray-800 rounded-lg p-8 space-y-6 max-w-2xl">
  @csrf
  <div>
    <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1.5">Project Title *</label>
    <input name="title" type="text" value="{{ old('title') }}" required
      class="w-full bg-gray-950 border border-gray-700 rounded px-4 py-2.5 text-white focus:outline-none focus:border-blue-500">
    @error('title') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
  </div>

  <div>
    <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1.5">Description *</label>
    <textarea name="description" rows="4" required
      class="w-full bg-gray-950 border border-gray-700 rounded px-4 py-2.5 text-white focus:outline-none focus:border-blue-500">{{ old('description') }}</textarea>
  </div>

  <div>
    <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1.5">Technologies * <span class="text-gray-500 normal-case">(comma-separated)</span></label>
    <input name="technologies" type="text" value="{{ old('technologies') }}"
      placeholder="Laravel, MySQL, Vue.js, Tailwind"
      class="w-full bg-gray-950 border border-gray-700 rounded px-4 py-2.5 text-white focus:outline-none focus:border-blue-500">
  </div>

  <div class="grid grid-cols-2 gap-6">
    <div>
      <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1.5">GitHub Link</label>
      <input name="github_link" type="url" value="{{ old('github_link') }}"
        class="w-full bg-gray-950 border border-gray-700 rounded px-4 py-2.5 text-white focus:outline-none focus:border-blue-500">
    </div>
    <div>
      <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1.5">Live Demo URL</label>
      <input name="live_demo" type="url" value="{{ old('live_demo') }}"
        class="w-full bg-gray-950 border border-gray-700 rounded px-4 py-2.5 text-white focus:outline-none focus:border-blue-500">
    </div>
  </div>

  <div>
    <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1.5">Screenshot <span class="text-gray-500 normal-case">(JPEG/PNG, max 2MB)</span></label>
    <input name="screenshot" type="file" accept="image/*"
      class="w-full bg-gray-950 border border-gray-700 rounded px-4 py-2.5 text-gray-400 file:mr-4 file:py-1 file:px-4 file:rounded file:border-0 file:bg-blue-900 file:text-blue-300">
  </div>

  <div class="flex items-center gap-3">
    <input type="hidden" name="is_featured" value="0">
    <input name="is_featured" type="checkbox" value="1" id="featured" {{ old('is_featured') ? 'checked' : '' }}
      class="w-4 h-4 accent-blue-500">
    <label for="featured" class="text-gray-300 text-sm">Featured project (shown on homepage)</label>
  </div>

  <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white font-bold px-8 py-3 rounded transition">
    Create Project
  </button>
</form>
@endsection