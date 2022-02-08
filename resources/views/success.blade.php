<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Success</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        .custom-btn {
            margin-top: 14px;
        }

        .error {
            color: red !important;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-12 offset-col-4 mt-5">
               <div class="text-center">
               <p class="text-center"><b>Your order generatred succesfully!</b></p>
                <a class="btn btn-success" href="{{route('order.view')}}">Create New Order</a>
               </div>
            </div>
        </div>
    </div>

</body>

</html>