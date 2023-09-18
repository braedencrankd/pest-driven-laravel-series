@if ($courses->count() > 0)
	@foreach ($courses as $course)
		<h2>{{ $course->title }}</h2>
		<p>{{ $course->description }}</p>
	@endforeach
@endif
