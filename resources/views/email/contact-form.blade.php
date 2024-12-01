<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>{{ $subject }}</title>
</head>

<body>
   <h1>{{ $subject }}</h1>
   <p><strong>Name:</strong> {{ $name }}</p>
   <p><strong>Phone:</strong> {{ $phone }}</p>
   <p><strong>Email:</strong> {{ $email }}</p>

   <h2>Selected Items:</h2>
 <ul>
  @if(is_array($selectedItems) || is_object($selectedItems))
    @foreach($selectedItems as $itemName => $itemDetails)
      <li>{{ $itemDetails['quantity'] }}x {{ $itemName }} (Price: ${{ $itemDetails['price'] }}, Time: {{ $itemDetails['time'] }} mins)</li>
    @endforeach
  @else
    <li>No items selected.</li>
  @endif
</ul>

@if($selectedDate)
  <h3>Appointment Date:</h3>
  <p>{{ $selectedDate['day'] }}, {{ $selectedDate['date'] }}</p>
@endif

@if($selectedAddress)
  <h3>Address:</h3>
  <p>{{ $selectedAddress['address'] }}, {{ $selectedAddress['aptUnitFloor'] }}</p>
@endif

</body>

</html>