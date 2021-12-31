<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

    </style>

</head>

<body>
    <div class="container">
        {{-- pengecekan balance : saldo, dll --}}
        <form action="/check-balance" method="GET">
            @csrf
            <input class="btn btn-info" type="submit" value="cek balance">
        </form>
        <br>

        {{-- untuk mendemonstrasikan pembelian multiple produk --}}
        <form action="/buy-product" method="POST">
            @csrf
            <input type="submit" class="btn btn-primary" value="beli produk">
        </form>
        <br>


        {{-- untuk pengecekan transaksi --}}
        <form action="/check-trx-detail" method="POST">
            @csrf
            <input type="number" class="form-control" required name="trxId">
            <input type="submit" class="btn btn-danger" value="cek transaksi">
        </form>
        <br>


    </div>
</body>

</html>
