

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1 class="my-5 text-center">Payment for required service</h1>
    <div class="row justify-content-center">
{{--        @foreach($services as $service)--}}
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $service->name }}</h5>

                        <a href="{{ route('stripe.checkout', ['service_id' => $service->id]) }}" class="btn btn-primary">Pay {{ $service->price }} €</a>
                    </div>
                </div>
            </div>
{{--        @endforeach--}}
    </div>
</div>
</body>
</html>

