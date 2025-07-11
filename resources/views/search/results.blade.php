@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="text-center">Search result for : "{{ $query }}"</h4>

    @forelse($results as $result)
        <div class="card my-2">
            <div class="card-body">
                <span class="badge bg-secondary mb-2">{{ strtoupper($result['type']) }}</span>
                <h5><a href="{{ $result['url'] }}">{{ $result['title'] }}</a></h5>
                <small class="text-muted">{{ $result['created_at']->diffForHumans() }}</small>
            </div>
        </div>
    @empty
        <p class="text-muted">لم يتم العثور على نتائج.</p>
    @endforelse
</div>
@endsection
