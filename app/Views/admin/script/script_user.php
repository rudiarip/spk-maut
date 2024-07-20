<div class="modal fade" id="modal-add" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form enctype="multipart/form-data" id="inputform">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel4">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password1">Password</label>
                        <input type="password" class="form-control" id="password1" name="password1" placeholder="Masukkan Password" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password2">Ulangi Password</label>
                        <input type="password" class="form-control" id="password2" name="password2" placeholder="Ulangi Password" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="user_group">Pilih Group</label>
                        <select id="user_group" name="user_group" class="form-control user-group">
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="1" selected>Aktif</option>
                            <option value="0">Non-Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary" id="btn-simpan"><i class="fas fa-save"></i> Simpan</button>
                </div>
        </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modal-edit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form enctype="multipart/form-data" id="editform">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel4">Edit <?= $subjudul ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="kodedit" name="kodedit">
                    <div class="form-group mb-3">
                        <label for="eusername">Username</label>
                        <input type="text" class="form-control" id="eusername" name="eusername" placeholder="Masukkan Username" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="eemail">Email</label>
                        <input type="email" class="form-control" id="eemail" name="eemail" placeholder="Masukkan Email" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="epassword1">Password</label>
                        <input type="password" class="form-control" id="epassword1" name="epassword1" placeholder="Masukkan Password" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="epassword2">Ulangi Password</label>
                        <input type="password" class="form-control" id="epassword2" name="epassword2" placeholder="Ulangi Password" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="euser_group">Pilih Group</label>
                        <select id="euser_group" name="euser_group" class="form-control user-group">
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="estatus" class="form-label">Status</label>
                        <select name="estatus" id="estatus" class="form-control" required>
                            <option value="1" selected>Aktif</option>
                            <option value="0">Non-Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"> Close</button>
                    <button type="submit" class="btn btn-primary " id="btn_edit"><i class="fas fa-save"></i> Simpan</button>
                </div>
        </div>
        </form>
    </div>
</div>


<script>
    $(document).ready(function() {
        tampildata();
        fetchGroup();

        $("#user_group").select2({
            theme: 'bootstrap4',
            placeholder: "Pilih",
            dropdownParent: $("#modal-add"),
            allowClear: true
        });

        $("#euser_group").select2({
            theme: 'bootstrap4',
            placeholder: "Pilih",
            dropdownParent: $("#modal-edit"),
            allowClear: true
        });

        function tampildata() {
            $('#user').DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "paging": true,
                "serverSide": true,
                "searching": true,
                "language": {
                    "processing": "Loading. Please wait..."
                },
                "ajax": {
                    url: "<?= base_url() ?>user/datatables",
                    type: "POST",
                    data: function(d) {
                        d.search = $('#user_filter input').val(); // Mengambil nilai pencarian dari input DataTable
                    }
                },
            });
        }

        // INPUT
        $('#inputform').submit(function(e) {
            e.preventDefault();

            var pass1 = $('#password1').val()
            var pass2 = $('#password2').val()

            if (pass1 != pass2) {
                toastr.error('Password 1 dan 2 Tidak Cocok');

                return false;
            }

            $.ajax({
                type: "POST",
                url: "<?php echo base_url() ?>user/store",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                dataType: 'JSON',
                success: function(response) {
                    if (response.status) {

                        toastr.success(response.message);

                        $('#user').DataTable().ajax.reload();
                        $('#modal-add').modal('hide');
                    } else {
                        toastr.error(response.message);
                    }
                },

                error: function(response) {
                    Swal.fire({
                        type: 'error',
                        title: 'OOPS!!',
                        text: 'Server Error!'
                    });
                }
            });
        });

        //editview
        $('#user').on('click', '.bedit', function() {
            var id = $(this).attr('data');
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() ?>user/showedit",
                dataType: "JSON",
                data: {
                    id: id
                },
                success: function(response) {
                    if (response.status) {
                        let data = response.data

                        $('[name="kodedit"]').val(data.id);
                        $('[name="eusername"]').val(data.username);
                        $('[name="eemail"]').val(data.email);
                        $('[name="euser_group"]').val(data.id_group).trigger('change');
                        $('[name="estatus"]').val(data.status);

                        $('#modal-edit').modal('show');
                    } else {
                        toastr.error(response.message);
                    }
                }
            });
            return false;
        });

        //aksi edit
        $('#editform').submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>user/store_edit",
                data: new FormData(this),
                processData: false,
                contentType: false,
                dataType: 'JSON',
                beforeSend: function() {
                    $('#btn_edit').html('<i id="spinn" class="fa fa-spinner fa-spin fa-1x fa-fw"></i><span> LOADING...</span>')
                    $('#btn_edit').attr('disabled', '');
                },
                success: function(response) {

                    $('#btn_edit').removeAttr('disabled', '');
                    $("#btn_edit").html('<i class="fas fa-save"></i> Simpan')

                    if (response.status) {
                        toastr.success(response.message);
                        $('#user').DataTable().ajax.reload();
                        $('#modal-edit').modal('hide');
                    } else {
                        toastr.warning(response.message);
                    }
                },

                error: function(response) {
                    $('#btn_edit').removeAttr('disabled', '');
                    $("#btn_edit").html('<i class="fas fa-save"></i> Simpan')

                    Swal.fire({
                        type: 'error',
                        title: 'OOPS!!',
                        text: 'Server Error!',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        });

        // hapus
        $('#user').on('click', '.bhapus', function() {
            var id = $(this).attr('data');
            swal.fire({
                title: 'Yakin Menghapus data ini?',
                text: "Tekan YES jika anda yakin ",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes'
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: '<?php echo base_url() ?>user/destroy',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id: id
                        },
                        success: function(response) {
                            if (response.status) {
                                toastr.success(response.message);

                                $('#user').DataTable().ajax.reload();
                            } else {
                                toastr.warning(response.message);

                            }
                        },
                        error: function(response) {
                            data = JSON.parse(response.responseText);
                            Swal.fire({
                                icon: 'error',
                                text: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }

                    });
                }
            });

        });

        $('#modal-add').on('hidden.bs.modal', function() {
            $('#username').val('')
            $('#email').val('')
            $('#password1').val('')
            $('#password2').val('')
            $('#user_group').val('')
            $('#status').val('1')
        });

        $('#modal-edit').on('hidden.bs.modal', function() {
            $('#eusername').val('')
            $('#eemail').val('')
            $('#epassword1').val('')
            $('#epassword2').val('')
            $('#euser_group').val('')
            $('#estatus').val('1')
        });

    })

    fetchGroup = async () => {
        let url = "<?= base_url('user/list_group_js') ?>";

        let response = await fetch(url, {
            method: 'POST',
        });

        let result = await response.json();

        if (!result.status) {
            return;
        }

        let groups = result.data;

        let dokt = '<option value="" selected>Pilih</option>';
        groups.forEach(res => {
            dokt += `<option value="${res.id}">${res.nama}</option>`;
        });

        $(".user-group").html(dokt);
        return;
    }
</script>