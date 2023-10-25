@extends('main')




@section('content')

    @if ($latestPost)
        <!-- Featured blog post for the latest post -->
        <div class="card mb-4">
            <a href="{{ route('blog.show', ['blogPost' => $latestPost->id]) }}"><img class="card-img-top" src="https://dummyimage.com/850x350/dee2e6/6c757d.jpg" alt="..." /></a>
            <div class="card-body">
                <div class="small text-muted">{{ $latestPost->created_at }} by {{ $latestPost->author->name }}</div>
                <h2 class="card-title">{{ ucfirst($latestPost->title) }}</h2>
                <p class="card-text">{{ Str::limit($latestPost->body, 100) }}</p>
                <a class="btn btn-primary" href="{{ route('blog.show', ['blogPost' => $latestPost->id]) }}">Read more →</a>
            </div>
        </div>
    @endif

    <!-- Nested row for non-featured blog posts -->
    <div class="row">
        @foreach ($posts as $post)
            @if (!$latestPost || $post->id !== $latestPost->id)
                <div class="col-lg-6">
                    <!-- Blog post -->
                    <div class="card mb-4">
                        <a href="{{ route('blog.show', ['blogPost' => $post->id]) }}"><img class="card-img-top" src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg" alt="..." /></a>
                        <div class="card-body">
                            <div class="small text-muted">{{ $post->created_at }} by {{ $post->author->name }}</div>
                            <h2 class="card-title h4" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-height: 2.4em;">{{ ucfirst($post->title) }}</h2>
                            <p class="card-text">{{ Str::limit($post->body, 100) }}</p>
                            <a class="btn btn-primary" href="{{ route('blog.show', ['blogPost' => $post->id]) }}">Read more →</a>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>




    <nav aria-label="Pagination">
        <hr class="my-0" />
        <ul class="pagination justify-content-center my-4">
            <!-- Previous Page Link -->
            @if ($posts->onFirstPage())
                <li class="page-item disabled"><span class="page-link">Newer</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $posts->previousPageUrl() }}">Newer</a></li>
            @endif

            <!-- Numbered Page Links -->
            @php
                $lastPage = $posts->lastPage();
                $currentPage = $posts->currentPage();
                $showOnly = 5; // Number of pages to display

                $start = max($currentPage - floor($showOnly / 2), 1);
                $end = min($start + $showOnly - 1, $lastPage);

                if ($start > 1) {
                    echo '<li class="page-item"><a class="page-link" href="' . $posts->url(1) . '">1</a></li>';
                    if ($start > 2) {
                        echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                    }
                }

                for ($i = $start; $i <= $end; $i++) {
                    if ($i == $currentPage) {
                        echo '<li class="page-item active" aria-current="page"><span class="page-link">' . $i . '</span></li>';
                    } else {
                        echo '<li class="page-item"><a class="page-link" href="' . $posts->url($i) . '">' . $i . '</a></li>';
                    }
                }

                if ($end < $lastPage) {
                    if ($end < $lastPage - 1) {
                        echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                    }
                    echo '<li class="page-item"><a class="page-link" href="' . $posts->url($lastPage) . '">' . $lastPage . '</a></li>';
                }
            @endphp

                <!-- Next Page Link -->
            @if ($posts->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $posts->nextPageUrl() }}">Older</a></li>
            @else
                <li class="page-item disabled"><span class="page-link">Older</span></li>
            @endif
        </ul>
    </nav>





@endsection
