<x-layout>
  <ul>
    @foreach($pets as $pet)
      <li class="pet" data-id="{{ $pet->id }}">
        <h2>{{ $pet->name?? "noname"}}</h2>
        <span>Kategoria: {{ $pet->category->name ?? "Brak kategorii" }}</span>
        <select name="status" disabled>
          <option value="available" @selected($pet->status === "available")>Available</option>
          <option value="pending" @selected($pet->status === "pending")>Pending</option>
          <option value="sold" @selected($pet->status === "sold")>Sold</option>
        </select>
        <button class="delete">Delete</button>
        <a type="button" class="update" href="/edit/{{ $pet->id }}">Edit</a>
      </li>
    @endforeach
  </ul>
</x-layout>

