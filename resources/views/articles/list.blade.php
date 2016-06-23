@include ('articles.user')

<a href="/create"> Add new article </a>

<ul>
    @if(!$user->articles->isEmpty())
        <table>
            <caption>All the articles</caption>
            <thead>
                <tr><th> Title </th></tr>
                <tr><th> Action </th></tr>
                <tr><th> Status </th></tr>
            </thead>
            <tbody>
                @foreach($user->articles as $article)
                <tr>
                    <td>{{ $article->title }}</td>
                    <td>
                        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No articles</p>
    @endif
</ul>
