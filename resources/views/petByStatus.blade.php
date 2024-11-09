<!DOCTYPE html>
<html lang="pl">

    <body>
        @foreach($pet as $p)
        <div >
            <p><strong>ID:</strong> {{ $p['id'] }}</p>
            <p><strong>Name:</strong> {{ $p['name'] ?? 'No name available'  }}</p>
            <p><strong>Status:</strong> {{ $p['status'] }}</p>
            <p><strong>Category ID:</strong> {{ $p['category']['id'] ?? 'No category ID available' }}</p>
            <p><strong>Category Name:</strong> {{ $p['category']['name'] ?? 'No category name available' }}</p>
        <ul>
            @foreach($p['photoUrls'] ?? [] as $photoUrl)
                <li><img src="{{ $photoUrl }}" alt="{{ $p['name'] ?? 'Animal photo'  }}"></li>
            @endforeach
        </ul>
        <ul>
        @if(isset($pet['tags']) && is_array($pet['tags']))
            @foreach($pet['tags'] as $tag)
                <li>{{ $tag['name'] ?? 'No tag name available' }}</li>
            @endforeach
          @else
            <p>No tags available.</p>
          @endif
        </ul>
</div>
        @endforeach
    </body>
</html>
