<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
</head>
<body>
<div class="margin-top">
    <table class="products">
        <tr>
            <th>Name</th>
            <th>Description</th>
        </tr>
        @foreach($data as $item)
        <tr class="items">

                <td>
                    {{$item['name']}}
                </td>
                <td>
                    {{$item['description']}}
                </td>

        </tr>
        @endforeach
    </table>
</div>

<div class="footer margin-top">
    <div>Thank you</div>
</div>
</body>
</html>
