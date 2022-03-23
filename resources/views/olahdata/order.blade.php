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
        <h4>Pencarian Data</h4>
        <div class="search mb-5">
            <form class="form-horizontal" method="GET" action="{{ url('list/order')}}">
                <div class="form-group mb-2">
                    <input value="{{ $invoice }}"  type="text" name="invoice" class="form-control"  placeholder="Invoice ID"/>
                </div>
                <div class="form-group mb-2">
                    <input value="{{ $tglawal }}" type="text" name="tglawal" role="datepicker" class="form-control" readonly  placeholder="tanggal awal"/>
                </div>
                <div class="form-group mb-2">
                    <input value="{{ $tglakhir }}" type="text" name="tglakhir" role="datepicker" class="form-control" readonly  placeholder="tanggal akhir"/>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary">Cari Data</button>
                    <a href="{{ url('list/order') }}" class="btn btn-primary">Reset</a>
                </div>
            </form>
        </div>
        
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Invoice ID</th>
                        <th>Nama Customer</th>
                        <th>Phone</th>
                        <th>Agent Name</th>
                        <th>Payment Method</th>
                        <th>Diskon</th>
                        <th>Total</th>
                        <th>Delivery Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="data">
                    @foreach($data as $record)
                    <tr>
                        <td>{{ $record->invoice_id }}</td>
                        <td>{{ $record->name }}</td>
                        <td>{{ $record->phone }}</td>
                        <td>{{ $record->agent_name }}</td>
                        <td>{{ $record->payment_method }}</td>
                        <td>{{ $record->payment_discount }}</td>
                        <td>{{ number_format($record->payment_final) }}</td>
                        <td>{{ date("d-m-Y", strtotime($record->delivery_date)) }}</td>
                        <td>
                            <a href="{{ url('/list/order/'.$record->invoice_id) }}" type="button" class="btn btn-primary" data-id="{{ $record->invoice_id }}">Detail Order</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

    

    
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript">

        $(document).ready(function(){
            $("input[role='datepicker']").datepicker({
                dateFormat : "dd-mm-yy"
            });
        });
    </script>
  </body>
  
</html>
