<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <title>Hello, world!</title>
  </head>
  <body>
    
    <div class="container">
        <h4>Order</h4>
        <div class="mb-5">
            <table class="table">
                <thead>
                    <th>Invoice ID</th>
                    <th>Nama</th>
                    <th>Tanggal Pesan</th>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $order->first()->invoice_id}}</td>
                        <td>{{ $order->first()->name}}</td>
                        <td>{{ $order->first()->order_time}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <h4>Detail Order</h4>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Product</th>
                        <th>Harga</th>
                        <th>QTY</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody id="data">
                    @php 
                        $total = 0;
                    @endphp
                    @foreach($detail as $record)
                    
                    <tr>
                        <td>{{ $record->product_name }}</td>
                        <td>{{ number_format($record->price) }}</td>
                        <td>{{ $record->qty }}</td>
                        <td>{{ number_format($record->total_price) }}</td>
                    </tr>
                    @php 
                        $total += $record->total_price;
                    @endphp
                    @endforeach
                    <tr style="font-weight:bold;">
                        <td colspan="3">Total Bayar</td>
                        <td colspan="3">{{ number_format($total) }}</td>
                    </tr>
                </tbody>

            </table>
        </div>
    </div>

    

    
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript">

        
    </script>
  </body>
  
</html>
