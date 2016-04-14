<h1>Names for <a href="https://{{ $blog }}.tumblr.com" target="_blank">{{ $blog }}</a></h1>
<ul class="names">
@foreach ($names as $name)
    <li><a href="https://{{ $blog }}.tumblr.com/tagged/{{ $name }}" target="_blank">{{ $name }}</a></li>
@endforeach
</ul>

<p><a href="/" class="back"><span class="icon">&circlearrowleft;</span> Do again?</a></p>
