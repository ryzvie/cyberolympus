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
        
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Customer</th>
                        <th>Total Beli</th>
                    </tr>
                </thead>
                <tbody id="data">
                    @foreach($data as $record)
                    <tr>
                        <td>{{ $record->first_name }}</td>
                        <td>{{ $record->total }}</td>
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


  </body>
  
</html>
