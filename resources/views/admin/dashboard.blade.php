@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
<h1 class="text-2xl font-bold text-white mb-8">Dashboard</h1>

<!-- Stats -->
<div class="grid grid-cols-3 gap-6 mb-10">
  <div class="bg-gray-900 border border-gray-800 rounded-lg p-6">
    <div class="text-3xl font-black text-blue-400">{{ $stats['total_projects'] }}</div>
    <div class="text-gray-500 text-sm mt-1 uppercase tracking-wider">Total Projects</div>
  </div>
  <div class="bg-gray-900 border border-gray-800 rounded-lg p-6">
    <div class="text-3xl font-black text-green-400">{{ $stats['total_messages'] }}</div>
    <div class="text-gray-500 text-sm mt-1 uppercase tracking-wider">Messages</div>
  </div>
  <div class="bg-gray-900 border border-gray-800 rounded-lg p-6">
    <div class="text-3xl font-black text-yellow-400">{{ $stats['unread_messages'] }}</div>
    <div class="text-gray-500 text-sm mt-1 uppercase tracking-wider">Unread</div>
  </div>
</div>

<!-- Recent Messages -->
<div class="bg-gray-900 border border-gray-800 rounded-lg p-6">
  <h2 class="text-lg font-bold text-white mb-4">Recent Messages</h2>
  @forelse($recentMessages as $msg)
    <div class="flex items-center justify-between py-3 border-b border-gray-800 last:border-0">
      <div>
        <div class="text-white font-medium">{{ $msg->name }}</div>
        <div class="text-gray-500 text-sm">{{ $msg->email }} — {{ Str::limit($msg->message, 60) }}</div>
      </div>
      @if(!$msg->is_read)
        <span class="bg-blue-900 text-blue-400 text-xs px-2 py-0.5 rounded-full">New</span>
      @endif
    </div>
  @empty
    <p class="text-gray-500">No messages yet.</p>
  @endforelse
</div>
@endsection