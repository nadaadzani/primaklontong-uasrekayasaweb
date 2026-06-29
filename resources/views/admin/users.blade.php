@extends('admin.template')
@section('content')

<div class="main-content">
    <div class="page-header">
        <div>
            <h4><i class="fas fa-users"></i> Data Users</h4>
            <small class="text-muted">Kelola data pengguna aplikasi</small>
        </div>
        <div>
            <button type="button" id="btnAdd" class="btn btn-gradient">
                <i class="fas fa-plus me-2"></i> Tambah User
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card-custom">
        <div class="card-header">
            <i class="fas fa-table me-2"></i> Daftar Users
        </div>
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

<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="userForm">
            <div class="modal-content">
                <div class="modal-header" style="background: linear-gradient(135deg, #667eea, #764ba2); color: #fff;">
                    <h5 class="modal-title" id="userModalLabel"><i class="fas fa-user me-2"></i> Tambah User</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="userId" name="userId">
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label fw-bold">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password (min 6 karakter)">
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-gradient">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/2.3.8/js/dataTables.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<script>
    console.log('API_TOKEN:', API_TOKEN);

    if (!API_TOKEN) {
        toastr.error('Silakan login terlebih dahulu');
        setTimeout(() => {
            window.location.href = "{{ route('login') }}";
        }, 2000);
    }

    $(document).ready(function() {
        var table = $('#tabel_user').DataTable({
            ajax: {
                url: "/api/users-list",
                dataSrc: "data",
                method: "GET",
                headers: {
                    'Authorization': 'Bearer ' + API_TOKEN
                },
                error: function(xhr) {
                    if (xhr.status === 401) {
                        toastr.error('Sesi habis, silakan login kembali');
                        setTimeout(() => {
                            window.location.href = "{{ route('login') }}";
                        }, 2000);
                    } else {
                        toastr.error('Gagal memuat data users');
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
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger btn-delete" data-id="${row.id}">
                                <i class="fas fa-trash"></i>
                            </button>
                        `;
                    }
                }
            ]
        });

        $('#btnAdd').click(function() {
            $('#userForm')[0].reset();
            $('#userId').val('');
            $('#password').prop('required', false);
            $('#userModalLabel').html('<i class="fas fa-user-plus me-2"></i> Tambah User');
            var modal = new bootstrap.Modal(document.getElementById('userModal'));
            modal.show();
        });

        $('#userForm').submit(function(e) {
            e.preventDefault();
            
            const userId = $('#userId').val();
            const url = userId ? `/api/users/${userId}` : '/api/users';
            const method = userId ? 'PUT' : 'POST';
            
            let formData = {
                name: $('#name').val(),
                email: $('#email').val(),
            };
            
            const password = $('#password').val();
            if (password) {
                formData.password = password;
            }
            
            $.ajax({
                url: url,
                method: method,
                data: JSON.stringify(formData),
                contentType: 'application/json',
                headers: {
                    'Authorization': 'Bearer ' + API_TOKEN
                },
                success: function(response) {
                    var modal = bootstrap.Modal.getInstance(document.getElementById('userModal'));
                    modal.hide();
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
                        }
                        toastr.error(errorMsg);
                    } else if (xhr.status === 401) {
                        toastr.error('Sesi habis, silakan login kembali');
                        setTimeout(() => {
                            window.location.href = "{{ route('login') }}";
                        }, 2000);
                    } else {
                        toastr.error('Gagal menyimpan data');
                    }
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
                    $('#password').val('');
                    $('#userModalLabel').html('<i class="fas fa-user-edit me-2"></i> Edit User');
                    var modal = new bootstrap.Modal(document.getElementById('userModal'));
                    modal.show();
                },
                error: function() {
                    toastr.error('Gagal memuat data user');
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
                    error: function() {
                        toastr.error('Gagal menghapus data');
                    }
                });
            }
        });
    });
</script>

<style>
    .btn-gradient {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: #fff;
        border: none;
        padding: 10px 25px;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .btn-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102,126,234,0.35);
        color: #fff;
    }
    .btn-gradient i { margin-right: 8px; }
</style>

@endsection