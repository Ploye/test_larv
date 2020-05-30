<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dosen</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container" style="margin-top: 50px">

    <h1>Data Dosen</h1>
    @if (session('added_success'))
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        {{session('added_success')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif

      @if (session('updated_success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{session('updated_success')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
        @if (session('deleted_success'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{session('deleted_success')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
    <button class="btn btn-primary" data-toggle="modal" data-target="#insertModal">Tambah Data</button>
    <br>
    <br>
    <table class="table table-bordered">
        <thead  class="text-center">
            <tr>
                <td>No</td>
                <td>NIDN</td>
                <td>Nama</td>
                <td>Status</td>
                <td>Keterangan</td>
                <td>Aksi</td>
            </tr>
        </thead>
        <tbody class="text-center">
            @php
                $no = 1;   
            @endphp

            @foreach ($dosens as $dosen)
                <tr>
                    <td>{{ $no++}}</td>
                    <td>{{ $dosen->nidn}}</td>
                    <td>{{ $dosen->nama}}</td>
                    <td>
                    @if ($dosen->status == 1)
                        Aktif
                    @else
                        Tidak Aktif
                    @endif
                    </td>
                    <td>{{ $dosen->keterangan}}</td>
                    <td><div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-primary" id="btn-edit-dosen"
                         data-toggle="modal" 
                         data-target="#update"
                         data-nidn="{{$dosen->nidn}}"
                         data-nama="{{$dosen->nama}}"
                         data-status="{{$dosen->status}}"
                         data-keterangan="{{$dosen->keterangan}}"
                        >Update</button>
                        
                        <button type="button" class="btn btn-danger" id="btn-delete-dosen"

                        data-toggle="modal" 
                        data-target="#delete"
                        data-nidn="{{$dosen->nidn}}"
                        
                        >Delete</button>
                      </div></td>
                </tr>
            @endforeach
          
        </tbody>
    </table>
    <hr/>
    <h1>RecycleBin</h1>
    <table class="table table-bordered">
      <thead  class="text-center">
          <tr>
              <td>No</td>
              <td>NIDN</td>
              <td>Nama</td>
              <td>Status</td>
              <td>Keterangan</td>
              <td>Aksi</td>
          </tr>
      </thead>
      <tbody class="text-center">
          @php
              $no = 1;   
          @endphp

          @foreach ($trash as $del)
              <tr>
                  <td>{{ $no++}}</td>
                  <td>{{ $del->nidn}}</td>
                  <td>{{ $del->nama}}</td>
                  <td>
                  @if ($del->status == 1)
                      Aktif
                  @else
                      Tidak Aktif
                  @endif
                  </td>
                  <td>{{ $del->keterangan}}</td>
                  <td><div class="btn-group" role="group" aria-label="Basic example">
                      <button type="button" class="btn btn-primary" id="btn-edit-dosen"
                       data-toggle="modal" 
                       data-target="#update"
                       data-nidn="{{$del->nidn}}"
                      >Update</button>
                      <button type="button" class="btn btn-danger" id="btn-delete-dosen"
                      data-toggle="modal" 
                      data-target="#delete"
                      data-nidn="{{$del->nidn}}"
                      >Delete</button>
                    </div></td>
              </tr>
          @endforeach
        
      </tbody>
  </table>
</div>
<!-- Modal -->
<div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Dosen</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form method="post" action="{{action('DosenController@store')}}">
            @csrf
                <div class="form-group">
                  <label>NIDN</label>
                  <input type="number" name="nidn" class="form-control" required>
                </div>
                <div class="form-group">
                <label>Nama</label>
                  <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="form-group">
                <label>Keterangan</label>
                <textarea class="form-control" name="keterangan" required></textarea>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
<div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Dosen</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form method="post" action="{{action('DosenController@update', 'update')}}">
            @method('PATCH')
            @csrf
                <div class="form-group">
                  <label>NIDN</label>
                  <input type="number" name="nidn" class="form-control" id="edit-nidn" readonly>
                </div>
                <div class="form-group">
                <label>Nama</label>
                  <input type="text" name="nama" class="form-control" id="edit-nama">
                </div>
                <div class="form-group">
                    <label>Status</label>
                      <select class="form-control" name="status" id="edit-status">
                          <option value="1">Aktif</option>
                          <option value="0">Tidak Aktif</option>
                      </select>
                    </div>
                <div class="form-group">
                <label>Keterangan</label>
                <textarea class="form-control" name="keterangan" id="edit-keterangan"></textarea>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-warning">Update</button>
        </form>
        </div>
      </div>
    </div>
  </div>
   <!-- Modal DELETE -->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Dosen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     
      <div class="modal-body">
        <strong>Apakah anda yakin akan menghapus data tersebut? </strong>
      <form method="post" action="{{action('DosenController@destroy', 'delete')}}">
          @method('DELETE')
          @csrf
                <input type="hidden" name="nidn" id="delete-nidn">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Delete</button>
      </form>
      </div>
    </div>
  </div>
</div>
    {{-- JS DOM --}}
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $(document).on('click','#btn-edit-dosen',function(){
            let nidn = $(this).data('nidn');
            // let nama = $(this).data('nama');
            // let keterangan = $(this).data('keterangan');
            // let status = $(this).data('status');

            // $('#edit-nidn').val(nidn);
            // $('#edit-nama').val(nama);
            // $('#edit-keterangan').text(keterangan);
            
            // $('#edit-status option').filter(function(){
            //     return ($(this).val()== status);
            // }).prop('selected', true);

              // AJAX 
            $.ajax({
              type: "get",
              url: 'dosen/'+nidn,
              dataType: 'json',
              success: function(res){
                  // console.log(res);

                   $('#edit-nidn').val(res[0].nidn);
                   $('#edit-nama').val(res[0].nama);
                   $('#edit-keterangan').text(res[0].keterangan);
            
                   $('#edit-status option').filter(function(){
                       return ($(this).val()== res[0].status);
                   }).prop('selected', true);
              }
            });

            
        });

        $(document).on('click','#btn-delete-dosen',function(){
            let nidn = $(this).data('nidn');
            $('#delete-nidn').val(nidn);

          });
    </script>
</body>
</html>