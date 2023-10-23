<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   @foreach($lists as $list)
   <h1>
        {{ $list->title }} {{ $list->content }} {{ $list->user_id }}
   </h1>
   @endforeach
</body>
</html>
