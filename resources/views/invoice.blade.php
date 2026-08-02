<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
     <h1>This is invoice page for {{$name}}</h1>

    <ul>
      @foreach ( $items as $item )
<li> {{ $item["name"]}} | {{$item["price"]}} </li>
      @endforeach
    </ul>

    <table border="1">
        <tr>
             <th>Id</th>
             <th>Name</th>
             <th>Price</th>
        </tr>

       @foreach ($items as $item)
           <tr>
             <th>{{$item["id"]}}</th>
             <th>{{$item["name"]}}</th>
             <th>{{$item["price"]}}</th>
             
        </tr>
       @endforeach




    </table>
   
    
</body>
</html>