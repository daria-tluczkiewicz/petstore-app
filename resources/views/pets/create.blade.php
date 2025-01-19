<x-layout>
  <h1>Add new pet</h1>
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <form method="POST" action={{ route('pets.store') }}>
    @csrf
    <input type="text" name="name" placeholder="Name" required>
    <input type="text" name="category" placeholder="Category">
    <input type="text" name="photoUrl" placeholder="Photo URL" required>
    <label for="status">Status</label>
    <select name="status">
      <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
      <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
      <option value="sold" {{ old('status') == 'sold' ? 'selected' : '' }}>Sold</option>
    </select>
    <button type="submit">Create new pet</button>
  </form>
</x-layout>
