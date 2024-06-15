<a href="{{ route('courses.show', $course->id) }}" class="text-decoration-none text-reset">
    <div class="card h-100">
        <div class="position-relative">
            <img class="card-img-top" src="{{ $course->picture }}" height="250" alt="">
            @if ($course->is_premium)
                <span class="badge bg-danger position-absolute top-0 start-0 py-2 ms-3 mt-3">PRO</span>
            @endif
        </div>
        <div class="card-body mb-4">
            <div class="d-flex justify-content-between">
                <span
                    class="d-inline-block border rounded-pill bg-light px-3 py-1 mb-3">{{ ucfirst($course->topic->name) }}</span>
                <span
                    class="d-inline-block border rounded-pill bg-light px-3 py-1 mb-3">{{ ucfirst($course->getLevelLabel()) }}</span>
            </div>
            <h5 class="card-title">{{ $course->title }}</h5>
            <p class="card-text line-clamp-3">{{ $course->short_description }}</p>
        </div>

        <div class="card-footer bg-white mx-3 px-0">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex">
                    @foreach ($course->trainers as $trainer)
                        <img src="{{ $trainer->photo }}" class="rounded-circle trainer-photo" alt="{{ $trainer->name }}"
                            title="{{ $trainer->name }}">
                    @endforeach
                </div>
                <div class="d-flex small text-muted">
                    <span>
                        <i class="far fa-clock text-primary"></i>
                        {{ $course->sections()->count() }} sections
                    </span>

                    <span class="border-start border-2 border-secondary-subtle mx-3 my-1"></span>

                    <span>
                        <i class="far fa-file-alt text-primary"></i>
                        {{ $course->tutorials()->count() }} leçons
                    </span>
                </div>
            </div>
        </div>
    </div>
</a>
