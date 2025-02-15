<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <style>
   body {
      font-family: sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
      line-height: 1.6;
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
      background-color: #f5f5f5;
   }

   h1 {
      color: #333;
      border-bottom: 2px solid #ddd;
      padding-bottom: 10px;
      margin-bottom: 20px;
   }

   p {
      background-color: white;
      padding: 10px;
      border-radius: 5px;
      margin: 10px 0;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
   }

   strong {
      color: #444;
      display: inline-block;
      width: 140px;
   }
   </style>
</head>

<body>
   <h1>{{ $subject }}</h1>
   <p><strong>Name:</strong> {{ $name }}</p>
   <p><strong>Phone:</strong> {{ $phone }}</p>
   <p><strong>Email:</strong> {{ $email }}</p>
   <p><strong>Postcode:</strong> {{ $postcode }}</p>
   <p><strong>Tv Size:</strong> {{ $tvsize }}</p>
   <p><strong>Special Request:</strong> {{ $specialRequest }}</p>

</body>

</html>