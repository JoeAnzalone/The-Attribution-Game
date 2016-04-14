<h1>The Attribution Game™</h1>

<div class="post">

    <div class="text">{!! $post->text !!}</div>

</div>

<ul class="choices">
@foreach ($choices as $choice)
    <li>{{$choice}}</li>
@endforeach
</ul>

<footer>
    <p>This thing was created by Tumblr user <a href="https://HTMLbyJoe.tumblr.com" target="_blank">HTMLbyJoe</a> for funsies.</p>
</footer>
