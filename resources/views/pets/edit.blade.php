<x-layout>
  <h1>{{ $pet->name }}</h1>
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <form method="POST" action="{{ route('pets.update') }}">
    @csrf
    <input type="hidden" name="id" value="{{ $pet->id }}">
    <input type="text" name="category" placeholder="Category" value="{{ $pet->category->name ?? "" }}">
    <input type="text" name="name" placeholder="Name" value="{{ $pet->name ?? "" }}" required>
    <input type="text" name="photoUrl" placeholder="Photo URL" value="{{ $pet->photoUrls[0] ?? "" }}" required>
    <select name="status">
      <option value="available" {{ $pet->status === 'available' ? 'selected' : '' }}>Available</option>
      <option value="pending" {{ $pet->status === 'pending' ? 'selected' : '' }}>Pending</option>
      <option value="sold" {{ $pet->status === 'sold' ? 'selected' : '' }}>Sold</option>
    </select>
    <button type="submit">Update</button>
  </form>
</x-layout>
