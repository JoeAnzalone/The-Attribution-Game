<h1 class="site-title">The Attribution Game™</h1>

@if (!isset($guess))
    <h2 class="prompt">Who said this?</h2>
@else
    @if ($is_correct)
        <h2 class="response">You got it!</h2>
    @else
        <h2 class="response">You're wrong!</h2>
    @endif
@endif

<div class="post">
    <blockquote class="text">{!! $post->text !!}</blockquote>
</div>

@if (isset($guess))
    <div class="prompt">
        <p><a target="_href" href="{{ $post->post_url }}">{{ $correct_answer }} said this!</a></p>
        <p><a href="/">Another!</a></p>
    </div>
@endif

<ul class="choices">
@foreach ($choices as $choice)
    <li><a href="/answer?post_id={{$post->id}}&amp;guess={{$choice}}">{{$choice}}</a></li>
@endforeach
</ul>

<footer>
    <p>This thing was created by Tumblr user <a href="https://HTMLbyJoe.tumblr.com" target="_blank">HTMLbyJoe</a> for funsies.</p>
</footer>
