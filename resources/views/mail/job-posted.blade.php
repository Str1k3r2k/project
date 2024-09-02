<h2>
    {{ $job->title }}
</h2>

<p>
    Congrats! Your job is now Live on our website.
</p>

<p>
    <a href="{{ url('/jobs/' . $job->id) }}">View Job</a>
</p>