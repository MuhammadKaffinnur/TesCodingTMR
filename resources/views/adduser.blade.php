<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Users</title>
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-4">Data User</h2>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-danger"> Logout
                </button>
            </form>
        </div>
        
        <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#exampleModal">+ Data User</button>
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" id="success-alert" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Provinsi</th>
                        <th scope="col">Kabupaten</th>
                        <th scope="col">Kecamatan</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $s)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{$s->name}}</td>
                            <td>{{$s->email}}</td>
                            <td>
                                {{ collect($provinsi)->firstWhere('id', $s->provinsi)['name'] ?? '' }}
                            </td>
                            <td>
                                {{ collect($kabupaten[$s->provinsi] ?? [])->firstWhere('id', $s->kabupaten)['name'] ?? '' }}
                            </td>
                            <td>
                                {{ collect($kecamatan[$s->kabupaten] ?? [])->firstWhere('id', $s->kecamatan)['name'] ?? '' }}
                            </td>
                            <td>
                                <div class="d-flex">
                                    <button type="button" class="btn btn-primary btn-sm mr-2" data-toggle="modal" data-target="#editModal{{ $s->id }}">Update</button>
                                    <form action="{{ route('adduser.delete', $s->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this user?')" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <div class="modal fade" id="editModal{{ $s->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $s->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form id="editForm" action="{{ route('adduser.update', ['id' => $s->id]) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="editName" class="form-label">Nama</label>
                                                <input type="text" class="form-control" id="editName" name="name" value="{{ $s->name }}" style="border: 1px solid;" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="editEmail" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="editEmail" name="email" value="{{ $s->email }}" style="border: 1px solid;" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="editPassword" class="form-label">Password</label>
                                                <input type="password" class="form-control" id="editPassword" name="password" style="border: 1px solid;" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="editProvinsi" class="form-label">Provinsi</label>
                                                <select class="form-control" id="editProvinsi{{ $s->id }}" name="provinsi" style="border: 1px solid;" required>
                                                    <option value="">-- Pilih Provinsi --</option>
                                                    @foreach ($provinsi as $p)
                                                        <option value="{{ $p['id'] }}" {{ $s->provinsi_id == $p['id'] ? 'selected' : '' }}>{{ $p['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="editKabupaten" class="form-label">Kabupaten</label>
                                                <select class="form-control" id="editKabupaten{{ $s->id }}" name="kabupaten" style="border: 1px solid;" required>
                                                    <option value="">-- Pilih Kabupaten --</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="editKecamatan" class="form-label">Kecamatan</label>
                                                <select class="form-control" id="editKecamatan{{ $s->id }}" name="kecamatan" style="border: 1px solid;" required>
                                                    <option value="">-- Pilih Kecamatan --</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Update User</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="createForm" action="{{ route('adduser.add') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" style="border: 1px solid;" required>
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" style="border: 1px solid;" required>
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" style="border: 1px solid;" required>
                        </div>
                        <div class="form-group">
                            <label for="provinsi" class="form-label">Provinsi</label>
                            <select class="form-control" id="provinsi" name="provinsi" style="border: 1px solid;" required>
                                <option value="">-- Pilih Provinsi --</option>
                                @foreach ($provinsi as $p)
                                    <option value="{{ $p['id'] }}">{{ $p['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kabupaten" class="form-label">Kabupaten</label>
                            <select class="form-control" id="kabupaten" name="kabupaten" style="border: 1px solid;" required>
                                <option value="">-- Pilih Kabupaten --</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kecamatan" class="form-label">Kecamatan</label>
                            <select class="form-control" id="kecamatan" name="kecamatan" style="border: 1px solid;" required>
                                <option value="">-- Pilih Kecamatan --</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('provinsi').addEventListener('change', function () {
            fetchKabupaten(this.value, 'kabupaten', 'kecamatan');
        });
    
        document.getElementById('kabupaten').addEventListener('change', function () {
            fetchKecamatan(this.value, 'kecamatan');
        });
    
        function fetchKabupaten(provinsiId, kabupatenId, kecamatanId) {
            if (!provinsiId) {
                document.getElementById(kabupatenId).innerHTML = '<option value="">Pilih Kabupaten</option>';
                document.getElementById(kecamatanId).innerHTML = '<option value="">Pilih Kecamatan</option>';
                return;
            }
    
            fetch(`/api/provinces/${provinsiId}/regencies`)
                .then(response => response.json())
                .then(data => {
                    let kabupatenSelect = document.getElementById(kabupatenId);
                    kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten</option>';
                    data.forEach(kabupaten => {
                        let option = document.createElement('option');
                        option.value = kabupaten.id;
                        option.textContent = kabupaten.name;
                        kabupatenSelect.appendChild(option);
                    });
                });
                
                let tableRow = document.querySelector(`#editModal{{ $s->id }}`).querySelector('tbody tr');
                let kabupatenCell = tableRow.querySelector(`td:nth-child(5)`); // Kolom ke-5 adalah kolom "Kabupaten"
                kabupatenCell.textContent = data[0].name; // Misalnya Anda mengambil kabupaten pertama dari data
        }
    
        function fetchKecamatan(kabupatenId, kecamatanId) {
            if (!kabupatenId) {
                document.getElementById(kecamatanId).innerHTML = '<option value="">Pilih Kecamatan</option>';
                return;
            }
    
            fetch(`/api/regencies/${kabupatenId}/districts`)
                .then(response => response.json())
                .then(data => {
                    let kecamatanSelect = document.getElementById(kecamatanId);
                    kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                    data.forEach(kecamatan => {
                        let option = document.createElement('option');
                        option.value = kecamatan.id;
                        option.textContent = kecamatan.name;
                        kecamatanSelect.appendChild(option);
                    });
                });
                let tableRow = document.querySelector(`#editModal{{ $s->id }}`).querySelector('tbody tr');
                let kecamatanCell = tableRow.querySelector(`td:nth-child(6)`); // Kolom ke-6 adalah kolom "Kecamatan"
                kecamatanCell.textContent = data[0].name; // Misalnya Anda mengambil kecamatan pertama dari data
        }
    
        @foreach($users as $s)
            document.getElementById('editProvinsi{{ $s->id }}').addEventListener('change', function () {
                fetchKabupaten(this.value, 'editKabupaten{{ $s->id }}', 'editKecamatan{{ $s->id }}');
            });
    
            document.getElementById('editKabupaten{{ $s->id }}').addEventListener('change', function () {
                fetchKecamatan(this.value, 'editKecamatan{{ $s->id }}');
            });
    
            fetchKabupaten('{{ $s->provinsi_id }}', 'editKabupaten{{ $s->id }}', 'editKecamatan{{ $s->id }}');
        @endforeach
    </script>

<script src="{{ asset('js/jquery.min.js')  }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>