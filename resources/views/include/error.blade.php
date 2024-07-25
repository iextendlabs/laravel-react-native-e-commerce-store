@if (count($errors) > 0)
<div class="alert alert-danger" role="alert">
  <ul class="list-disc pl-4 space-y-1">
    @foreach ($errors->all() as $error)
      <li class="text-red-500 text-sm">{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif
