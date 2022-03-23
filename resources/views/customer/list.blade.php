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
        <div class="mb-2">
            <button type="button" id="btn-modal">
                tambah data
            </button>
        </div>
        <div class="search mb-2">
            <form class="form-horizontal" method="GET" action="{{ url('/customer') }}">
                <div class="form-group">
                    <input type="text" readonly value="{{ $tglawal }}" name="tglawal" class="form-control" role="datepicker" placeholder="tanggal_awal" />
                </div>
                <div class="form-group">
                    <input type="text" readonly value="{{ $tglakhir }}"  name="tglakhir" class="form-control" role="datepicker" placeholder="tanggal_akhir" />
                </div>
                <div class="form-group">
                    <button class="btn btn-primary">cari data</button>
                    <a type="button" href="{{ url('customer') }}" class="btn btn-warning">reset</a>
                </div>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>No. Telp</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="data-customer">
                    @foreach($data as $record)
                    <tr>
                        <td>{{ $record->first_name }}</td>
                        <td>{{ $record->alamat }}</td>
                        <td>{{ $record->telp }}</td>
                        <td>
                            <button type="button" data-id="{{ $record->id }}" onclick="editdata(this)">edit</button>
                            <button type="button" data-id="{{ $record->id }}" onclick="detaildata(this)">detail</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

        <div class="pagination">

        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        @csrf
                        <div class="form-group mb-2">
                            <input type="text" placeholder="nama depan" name="nama" class="form-control" />
                        </div>
                        <div class="form-group mb-2">
                            <input type="text" placeholder="nama belakang" name="last_nama" class="form-control" />
                        </div>
                        <div class="form-group mb-2">
                            <input type="text" placeholder="alamat" name="alamat" class="form-control" />
                        </div>
                        <div class="form-group mb-2">
                            <input type="text" placeholder="no.telp" name="telp" class="form-control" />
                        </div>
                        <div class="form-group mb-2">
                            <input type="text" placeholder="tanggal" name="tanggal" role="datepicker" class="form-control" />
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary">Close</button>
                    <button type="button" class="btn btn-primary" onclick="savedata(this)">Save changes</button>
                </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="exampleModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        @csrf
                        <input type="hidden" name="id" />
                        <div class="form-group mb-2">
                            <input type="text" placeholder="nama depan" name="nama" class="form-control" />
                        </div>
                        <div class="form-group mb-2">
                            <input type="text" placeholder="nama belakang" name="last_nama" class="form-control" />
                        </div>
                        <div class="form-group mb-2">
                            <input type="text" placeholder="alamat" name="alamat" class="form-control" />
                        </div>
                        <div class="form-group mb-2">
                            <input type="text" placeholder="no.telp" name="telp" class="form-control" />
                        </div>
                        <div class="form-group mb-2">
                            <input type="text" placeholder="tanggal" name="tanggal" role="datepicker" class="form-control" />
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary">Close</button>
                    <button type="button" class="btn btn-primary" onclick="updatedata(this)">Save changes</button>
                </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="exampleModalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        @csrf
                        <div class="form-group mb-2">
                            <input type="text" placeholder="nama depan" name="nama" class="form-control" />
                        </div>
                        <div class="form-group mb-2">
                            <input type="text" placeholder="nama belakang" name="last_nama" class="form-control" />
                        </div>
                        <div class="form-group mb-2">
                            <input type="text" placeholder="alamat" name="alamat" class="form-control" />
                        </div>
                        <div class="form-group mb-2">
                            <input type="text" placeholder="no.telp" name="telp" class="form-control" />
                        </div>
                        <div class="form-group mb-2">
                            <input type="text" placeholder="tanggal" name="tanggal" readonly class="form-control" />
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary">Close</button>
                </div>
                </div>
            </div>
        </div>
    </div>

    

    
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript">
        
        $(document).ready(function(){

            var tglawal = $("input[name='tglawal']").val();
            var tglakhir = $("input[name='tglakhir']").val();

            if(tglawal == "" && tglakhir == "")
            {
                
                getCustomerlist();

            }

            $("#btn-modal").on("click", function(){
                $("#exampleModal").modal("show");
            });

            $("input[role='datepicker']").datepicker({
                dateFormat : "dd-mm-yy"
            });
        });

        function getCustomerlist()
        {
            
            var table = $("tbody#data-customer");

            $.ajax({
                url : "{{ url('customer/getCustomer') }}",
                type : "GET",
                dataType : "JSON",
                success : function(result, status, xhr){
                    
                    $.each(result.response.data, function(k, v){

                        datatable = "<tr><td>"+v.nama+"</td><td>"+v.alamat+"</td><td>"+v.telp+"</td><td><button type='button' data-id='"+v.id+"' onclick='editdata(this)'>edit</button> <button type='button' data-id='"+v.id+"' onclick='detaildata(this)'>detail</button></td></tr>";

                        $(table).append(datatable);
                    });

                    var ul = "<ul>";
                    $.each(result.response.links, function(k, v){

                        ul += "<li style='list-style-type:none; float:left; padding:10px;'><a href='"+v.url+"'>"+v.label+"</a></li>";
                    });

                        ul += "</ul>";

                    $(".pagination").append(ul);
                }
            });
        }

        function detaildata(obj)
        {
            var id = $(obj).attr("data-id");

            $.ajax({
                url : "{{ url('customer/getdetail') }}",
                type : "POST",
                dataType : "JSON",
                data : {
                    id : id,
                    _token : $("input[name='_token']").val()
                },
                beforeSend : function(){
                    $("#exampleModalDetail").modal("show");
                },
                success : function(result, status, xhr){
                    $("#exampleModalDetail").find("input[name='nama']").val(result.data.nama);
                    $("#exampleModalDetail").find("input[name='last_nama']").val(result.data.last_name);
                    $("#exampleModalDetail").find("input[name='alamat']").val(result.data.alamat);
                    $("#exampleModalDetail").find("input[name='telp']").val(result.data.telp);
                    $("#exampleModalDetail").find("input[name='tanggal']").val(result.data.created_at);
                }
            });
        }

        function savedata(obj)
        {
            var nama    = $("input[name='nama']").val();
            var lnama    = $("input[name='last_nama']").val();
            var alamat  = $("input[name='alamat']").val();
            var telp    = $("input[name='telp']").val();
            var tanngal = $("input[name='tanggal']").val();

            var table = $("tbody#data-customer");

            $.ajax({
                url : "{{ url('customer/create') }}",
                type : "POST",
                dataType : "JSON",
                data : {
                    nama : $("input[name='nama']").val(),
                    lnama : $("input[name='last_nama']").val(),
                    alamat : $("input[name='alamat']").val(),
                    telp : $("input[name='telp']").val(),
                    tgl : $("input[name='tanggal']").val(),
                    _token : $("input[name='_token']").val()
                },
                success : function(result, status, xhr){
                    
                    var nama    = result.data.nama;
                    var alamat  = result.data.alamat;
                    var telp    = result.data.telp;

                    var datatable = "<tr><td>"+nama+"</td><td>"+alamat+"</td><td>"+telp+"</td></tr>";

                    $(table).prepend(datatable);

                    if(result.status)
                    {
                        $("#exampleModal").modal("hide");
                    }

                }
            });
        }

        function editdata(obj)
        {
            

            $("tbody#data-customer").find("tr").removeAttr("role");
            var id = $(obj).attr("data-id");

            $(obj).parents("tr").attr("role", "selected");

            $.ajax({
                url : "{{ url('customer/show') }}",
                type : "POST",
                dataType : "JSON",
                data : {
                    id : id,
                    _token : $("input[name='_token']").val()

                },
                beforeSend: function(){
                    $("#exampleModalEdit").modal("show");
                },
                success : function(result,status, xhr)
                {
                    $("#exampleModalEdit").find("input[name='id']").val(result.data.id);
                    $("#exampleModalEdit").find("input[name='nama']").val(result.data.f_name);
                    $("#exampleModalEdit").find("input[name='last_nama']").val(result.data.l_name);
                    $("#exampleModalEdit").find("input[name='alamat']").val(result.data.alamat);
                    $("#exampleModalEdit").find("input[name='telp']").val(result.data.telp);
                    $("#exampleModalEdit").find("input[name='tanggal']").val(result.data.created_at);
                }
            });
        }

        function updatedata(obj)
        {
            var table = $("tbody#data-customer").find("tr[role='selected']");

            $.ajax({
                url : "{{ url('customer/update') }}",
                type : "POST",
                dataType : "JSON",
                data : {
                    id : $("#exampleModalEdit").find("input[name='id']").val(),
                    f_name : $("#exampleModalEdit").find("input[name='nama']").val(),
                    l_name : $("#exampleModalEdit").find("input[name='last_nama']").val(),
                    alamat : $("#exampleModalEdit").find("input[name='alamat']").val(),
                    telp : $("#exampleModalEdit").find("input[name='telp']").val(),
                    tgl : $("#exampleModalEdit").find("input[name='tanggal']").val(),
                    _token : $("input[name='_token']").val()
                },
                success : function(result, status, xhr)
                {   

                    console.log(result);
                    if(result.status)
                    {
                        var nama    = result.data.nama;
                        var alamat  = result.data.alamat;
                        var telp    = result.data.telp;

                        
                        $(table).find("td:eq(0)").text(nama);
                        $(table).find("td:eq(1)").text(alamat);
                        $(table).find("td:eq(2)").text(telp);
                        
                        $("#exampleModalEdit").modal("hide");
                    }
                }
            });
        }

    </script>

  </body>
  
</html>
