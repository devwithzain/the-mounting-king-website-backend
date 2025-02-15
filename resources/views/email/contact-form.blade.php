<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>{{ $subject }}</title>
   <style>
   body {
      font-family: sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
      line-height: 1.6;
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
      background-color: #f5f5f5;
   }

   .container {
      background-color: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
   }

   h1 {
      color: #2c3e50;
      border-bottom: 2px solid #3498db;
      padding-bottom: 10px;
      margin-bottom: 20px;
   }

   h2,
   h3 {
      color: #34495e;
      margin-top: 25px;
   }

   p {
      margin: 10px 0;
      color: #555;
   }

   strong {
      color: #2c3e50;
   }

   ul {
      list-style-type: none;
      padding: 0;
   }

   li {
      background-color: #f8f9fa;
      padding: 10px 15px;
      margin: 5px 0;
      border-radius: 5px;
      border-left: 3px solid #3498db;
   }

   .appointment-info,
   .address-info {
      background-color: #f8f9fa;
      padding: 15px;
      border-radius: 5px;
      margin-top: 10px;
   }
   </style>
</head>

<body>
   <div class="container">
      <p><strong>Name:</strong> {{ $name }}</p>
      <p><strong>Phone:</strong> {{ $phone }}</p>
      <p><strong>Email:</strong> {{ $email }}</p>

      <h2>Selected Items:</h2>
      <ul>
         @if(is_array($selectedItems) || is_object($selectedItems))
         @foreach($selectedItems as $itemName => $itemDetails)
         <li>{{ $itemDetails['quantity'] }}x {{ $itemName }} (Price: ${{ $itemDetails['price'] }}, Time:
            {{ $itemDetails['time'] }} mins)
         </li>
         @endforeach
         @else
         <li>No items selected.</li>
         @endif
      </ul>

      @if($selectedDate)
      <h3>Appointment Date:</h3>
      <div class="appointment-info">
         <p>{{ $selectedDate['day'] }}, {{ $selectedDate['date'] }}, {{ $selectedDate['time'] }}</p>
      </div>
      @endif

      @if($selectedAddress)
      <h3>Address:</h3>
      <div class="address-info">
         <p>{{ $selectedAddress['address'] }}, {{ $selectedAddress['aptUnitFloor'] }}</p>
      </div>
      @endif
   </div>
</body>

</html>