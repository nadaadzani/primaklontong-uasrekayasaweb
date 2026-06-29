@extends('admin.template')
@section('content')
<div class="main-content">
    <div class="container-fluid d-flex justify-content-between mb-3 py-3">
        <h3>Data Users</h3>
        <header class="justify-content-end">
            <button type="button" id="btnAdd" class="btn btn-primary">Tambah User</button>
        </header>
    </div>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered" id="tabel_user">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<!-- Modal -->
 <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="userForm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="userModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="userId" name="userId">
        <div class="form-group mb-3">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="form-group mb-3">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="form-group mb-3">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
    </form>
  </div>
</div>
@endsection
@section('script')
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.3.8/js/dataTables.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    // const API_TOKEN = "{{ session('api_token') }}" || "";
    console.log('API_TOKEN:', API_TOKEN);

    if (!API_TOKEN) {
        toastr.error('Silakan login terlebih dahulu');
        setTimeout(() => {
            window.location.href = "{{ route('login') }}";
        }, 2000);
    }

    $(document).ready(function() {
        // Initialize DataTable
        var table = $('#tabel_user').DataTable({
            ajax: {
                url: "/api/users-list",
                dataSrc: "data",
                method: "GET",
                headers: {
                    'Authorization': 'Bearer ' + API_TOKEN
                },
                error: function(xhr, status, error) {
                    if (xhr.status === 401) {
                        toastr.error('Sesi habis, silakan login kembali');
                        setTimeout(() => {
                            window.location.href = "{{ route('login') }}";
                        }, 2000);
                    } else {
                        toastr.error('Gagal memuat data users: ' + error);
                    }
                }
            },
            columns: [
                { 
                    data: null, 
                    render: function (data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                { data: 'name' },
                { data: 'email' },
                { 
                    data: null, 
                    render: function (data, type, row) {
                        return `
                            <button class="btn btn-sm btn-warning btn-edit" data-id="${row.id}">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-sm btn-danger btn-delete" data-id="${row.id}">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        `;
                    }
                }
            ],
            initComplete: function(settings, json) {
                if(json && json.message) {
                    toastr.success(json.message);
                }
            },
            error: function(xhr, status, error) {
                if (xhr.status === 401) {
                    toastr.error('Unauthorized. Please login again.');
                } else {
                    toastr.error('Error loading data: ' + error);
                }
            }
        });

        $('#btnAdd').click(function() {
            $('#userForm')[0].reset();
            $('#userId').val('');
            $('#password').prop('required', true);
            $('#userModalLabel').text('Tambah User');
            $('#userModal').modal('show');
        });

        $('#userForm').submit(function(e) {
            e.preventDefault();
            
            const userId = $('#userId').val();
            const url = userId ? `/api/users/${userId}` : '/api/users';
            const method = userId ? 'PUT' : 'POST';
            
            // Prepare data
            let formData = {
                name: $('#name').val(),
                email: $('#email').val(),
            };
            
            // Handle password
            const password = $('#password').val();
            if (password || !userId) {
                formData.password = password;
            }
            
            console.log('Sending data:', formData);
            
            $.ajax({
                url: url,
                method: method,
                data: JSON.stringify(formData),
                contentType: 'application/json',
                headers: {
                    'Authorization': 'Bearer ' + API_TOKEN
                },
                success: function(response) {
                    $('#userModal').modal('hide');
                    $('#tabel_user').DataTable().ajax.reload();
                    toastr.success(response.message || 'Data berhasil disimpan');
                    $('#userForm')[0].reset();
                },
                error: function(xhr) {
                    if (xhr.status === 422 && xhr.responseJSON) {
                        let errorMsg = '';
                        if (xhr.responseJSON.errors) {
                            $.each(xhr.responseJSON.errors, function(field, errors) {
                                errorMsg += `${field}: ${errors.join(', ')}\n`;
                            });
                        } else if (xhr.responseJSON.message) {
                            errorMsg = xhr.responseJSON.message;
                        }
                        toastr.error(errorMsg);
                    } else if (xhr.status === 401) {
                        toastr.error('Sesi habis, silakan login kembali');
                        setTimeout(() => {
                            window.location.href = "{{ route('login') }}";
                        }, 2000);
                    } else {
                        toastr.error('Gagal menyimpan data: ' + xhr.statusText);
                    }
                    console.log('Error:', xhr.responseJSON);
                }
            });
        });

        $('#tabel_user').on('click', '.btn-edit', function() {
            const userId = $(this).data('id');
            
            $.ajax({
                url: `/api/users/${userId}`,
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + API_TOKEN
                },
                success: function(response) {
                    const data = response.data || response;
                    $('#userId').val(data.id);
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                    $('#password').val('').prop('required', false);
                    $('#userModalLabel').text('Edit User');
                    $('#userModal').modal('show');
                },
                error: function(xhr) {
                    if (xhr.status === 401) {
                        toastr.error('Sesi habis, silakan login kembali');
                        setTimeout(() => {
                            window.location.href = "{{ route('login') }}";
                        }, 2000);
                    } else {
                        toastr.error('Gagal memuat data user: ' + xhr.statusText);
                    }
                }
            });
        });

        $('#tabel_user').on('click', '.btn-delete', function() {
            const userId = $(this).data('id');
            
            if (confirm('Apakah Anda yakin ingin menghapus user ini?')) {
                $.ajax({
                    url: `/api/users/${userId}`,
                    method: 'DELETE',
                    headers: {
                        'Authorization': 'Bearer ' + API_TOKEN
                    },
                    success: function(response) {
                        $('#tabel_user').DataTable().ajax.reload();
                        toastr.success(response.message || 'User berhasil dihapus');
                    },
                    error: function(xhr) {
                        if (xhr.status === 401) {
                            toastr.error('Sesi habis, silakan login kembali');
                            setTimeout(() => {
                                window.location.href = "{{ route('login') }}";
                            }, 2000);
                        } else {
                            toastr.error('Gagal menghapus data: ' + xhr.statusText);
                        }
                    }
                });
            }
        });
    });
</script>

<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

@endsection