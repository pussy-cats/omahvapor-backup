<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Invoice - {{ $checkoutData->id }} - InsomniaVS</title>

<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }
    .gray {
        background-color: lightgray
    }
</style>

</head>
<body>

  <table width="100%">
    <tr>
        <td valign="top"><img src="" alt="" width="150"/></td>
        <td align="right">
            <h3>Insomnia Vapestore</h3>
            <pre>
                InsomniaVS
                Surakarta
                081234567890
            </pre>
        </td>
    </tr>

  </table>

  <table width="100%">
    <tr>
        <td><strong>Dari:</strong> Insomnia Vapestore - Surakarta</td>
        <td><strong>Ke:</strong> {{ $checkoutData->user->name }} - {{ $checkoutData->address }}</td>
    </tr>

  </table>

  <br/>

  <table width="100%">
    <thead style="background-color: lightgray;">
      <tr>
        <th>#</th>
        <th>Description</th>
        <th>Quantity</th>
        <th>Unit Price (Rp.)</th>
        <th>Total (Rp.)</th>
      </tr>
    </thead>
    <tbody>
        @foreach($checkoutData->carts as $cart)
      <tr>
        <th scope="row">{{ $loop->iteration }}</th>
        <td>{{ $cart->product->name }}</td>
        <td align="right">{{ $cart->quantity }}</td>
        <td align="right">Rp. {{ number_format($cart->product->price) }}</td>
        <td align="right">Rp. {{ number_format($cart->product->price * $cart->quantity) }}</td>
      </tr>
      @endforeach

    <tfoot>
        <tr>
            <td colspan="3"></td>
            <td align="right">Subtotal</td>
            <td align="right">Rp. {{ number_format($checkoutData->total) }}</td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td align="right">Ongkos Kirim</td>
            <td align="right">Rp. {{ number_format($checkoutData->deliveryfee) }}</td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td align="right">Total</td>
            <td align="right" class="gray">Rp. {{ number_format($checkoutData->total + $checkoutData->deliveryfee) }}</td>
        </tr>
    </tfoot>
  </table>

</body>
</html>