<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
   
     <form action="{{route("roles.store")}}" method="post">
     {{-- <form action="{{url("roles")}}" method="post"> --}}
        @csrf

        <div>
            <label for="name">Name</label> <br>
            <input type="text" name="name">
        </div>
        <div>
            
            <input type="submit" name="btn_submit">
        </div>
     </form>


</body>
</html>
