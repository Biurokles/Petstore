<!DOCTYPE html>
<html lang="pl">

    <body >
    <h1> Znajdź sobie peta! </h1>
    <form action="{{ route('findPetByStatus') }}" method="GET">
        <label> Znajdź peta po statusie </label>
        <select name="status">
            @foreach($status as $s)
                <option value="{{$s}}">{{$s}}</option>
            @endforeach
        </select>
        <button type="submit">Znajdź</button><br>
        </form>
        <form action="{{ route('findPetById') }}" method="GET">
        <input type="text" name="id"/>
        <button type="submit"><label>Znajdź peta po ID</label></button><br>
        </form>
        <h1> Stwórz sobie peta! </h1><br>
        <form action="{{ route('createPet') }}" method="POST">
            @csrf
            <input type="text" name="petName" placeholder="imie peta"/><br>
            <input type="text" name="petCategory" placeholder="kategoria"/><br>
            <select name="status">
                @foreach($status as $s)
                    <option value="{{$s}}">{{$s}}</option>
                @endforeach
            </select>
            <button type="submit">Stwórz</button>
        </form>

    </body>
</html>
