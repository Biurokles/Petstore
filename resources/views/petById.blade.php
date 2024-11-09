<!DOCTYPE html>
<html lang="pl">
    <body>
      <p name="petId"><strong>ID:</strong> {{ $pet['id'] }}</p>
      <p><strong>Imie:</strong> {{ $pet['name'] ?? 'bezimienny'  }}
      <p><strong>Status:</strong> {{ $pet['status'] }}</p>
      <p><strong>Id Kategorii:</strong> {{ $pet['category']['id'] ?? '2137' }}</p>
      <p><strong>Kategoria</strong> {{ $pet['category']['name'] ?? 'Takiego zwierza nie da sie skategoryzować' }}</p>
      <ul>
        @foreach($pet['photoUrls'] ?? [] as $photoUrl)
        <li><img src="{{ $photoUrl }}" alt="{{ $photoUrl ?? 'Animal photo' }}"></li>
        @endforeach
      </ul>
      <p><strong>Tagi</strong>
      <ul>
        @if(isset($pet['tags']) && is_array($pet['tags']))
          @foreach($pet['tags'] as $tag)
            <li>{{ $tag['name'] ?? 'No tag name available' }}</li>
          @endforeach
          @else
            <p>No tags available.</p>
          @endif
        </ul>
        <h4>Aktualizuj peta</h4>
        <form action="{{ route('updatePet') }}" method="POST">
        @csrf
        @method('PUT')
          <input hidden type=text name="petId"  value="{{$pet['id']}}"/>
          <input type=text name="petName" placeholder="imie" value="{{$pet['name']}}" /><br>
          <input type=text name="petCategory" value="{{$pet['category']['name']}}" placeholder="kategoria"/><br>
          <p><strong>Tagi</strong><br>
          @foreach($pet['tags'] as $index => $tag)
           <input type=text name="petTag{{$index}}" value="{{$tag['name']}}"  /><input type="checkbox" name="petDelTag{{$index}}">Skasować?</input><br>
          @endforeach
          <input type=text name="newTag"  placeholder="Nowy tag" /><input name="addNewTag" type="checkbox">Dodać nowy tag?</input>
          <br><strong>Zdjecia</strong><br>
          @foreach($pet['photoUrls'] ?? [] as $index => $photoUrl)
            <input type=text name="petPhoto{{$index}}" placeholder="link do zdjecia" value="{{$photoUrl}}" /><input name="petDelPhoto{{$index}}" type="checkbox">Skasować?</input><br>
          @endforeach
          <input type=text name="newPhoto" placeholder="Nowy link do zdjecia" /><input type="checkbox" name="addNewPhoto" >Dodać nowe zdjecie?</input><br>
          <br><strong>Status</strong><br>
          <select name="petStatus">
                @foreach($status as $s)
                    <option value="{{$s}}">{{$s}}</option>
                @endforeach
          </select>
          <button type="submit">Aktualizuj</button><br>
        </form>
        <h4>Skasuj peta</h4>
        <form action="{{ route('deletePet', $pet['id']) }}" method="POST">
        @csrf
        @method('DELETE')
        <input hidden type=text name="id"  value="{{$pet['id']}}"/>
          <button type="submit" >Skasuj</button>
        </form>
    </body>
</html>
