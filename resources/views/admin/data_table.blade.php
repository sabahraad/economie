@include('admin.header')
@include('admin.navbar')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<style>
    .table {
            --bs-table-bg: transparent; /* Set it to a transparent color */
        }
    .bg-danger td {
            color: white; /* Set text color to white */
        }
    .dt-button{
      color: white !important;
      background-color: #6564ad !important;
      cursor: pointer;
      border-radius: 5px;
      border: none;
      padding: 10px 20px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      /* margin: 4px 2px; */
    }
</style>
<!-- Page Wrapper -->
<div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content container-fluid">
            
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Document</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="admin-dashboard.html">Dashboard</a></li>
                                <li class="breadcrumb-item active">Document</li>
                            </ul>
                        </div>
                        
                    </div>
                </div>
                <!-- /Page Header -->

                <div id="loadingMessage" style="display:none;">Loading...</div>
                <div class="mb-3">
                    <a href="{{ route('downloadALL') }}" class="btn btn-success" style="margin-left: 10px;">Download All</a>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                        <form action="{{ route('download.selected') }}" method="POST">
                            @csrf

                            <!-- Add the Download Button above the table -->
                            <div class="mb-3">
                                <button type="submit" class="btn btn-success">Download Selected</button>
                            </div>
                            
                            <div class="table-responsive">
                                <table class="table table-striped custom-table mb-0" id="desigTable">
                                    <thead>
                                        <tr>
                                        <th>
                                            <input type="checkbox" id="selectAll" onclick="toggleCheckboxes(this)" style="margin-left: 8px;">
                                            </th>
                                            <th>UID</th>
                                            <th>email</th>
                                            <th>Files Count</th>
                                            <th>Entreprise</th>
                                            <th>Gerant</th>
                                            <th>Uploaded Files</th>
                                            <th>Selfie</th>
                                            <th>Complete</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            @foreach ($data as $row)
                                            <tr>
                                                <td><input type="checkbox" name="uids[]" value="{{ $row['uid'] }}" class="individual-checkbox"></td>
                                                <td><a href="{{ route('details', ['uid' => $row['uid']]) }}" >{{ $row['uid'] }}</a></td>
                                                <td>{{ $row['email'] ?? 'N/A'}}</td>
                                                <td>{{ $row['files_count'] ?? 'N/A' }}</td>
                                                <td>{{ $row['entreprise_status'] }}</td>
                                                <td>{{ $row['gerant_status'] }}</td>
                                                <td>{{ $row['upload_status'] }}</td>
                                                <td>{{ $row['selfie_status'] }}</td>
                                                <td>{{ $row['percentage'] }} %</td>
                                                <td>{{ $row['created_at'] ?? 'N/A' }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $row['uid'] }}')">Delete</button>
                                                </td>                                                
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Content -->
            <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/jquery.slimscroll.min.js') }}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script>
    $(document).ready(function() {
        $('#desigTable').DataTable({
        dom: 'Bfrtip', 
        buttons: [
            ''
            ]
        });
    });

    function toggleCheckboxes(selectAllCheckbox) {
        const checkboxes = document.querySelectorAll('.individual-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = selectAllCheckbox.checked; // Check or uncheck based on the state of the "Select All" checkbox
        });
    }

    function confirmDelete(uid) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            // Call the delete API
            deleteUser(uid);
        }
    });
}

function deleteUser(uid) {
    $.ajax({
        url: `api/delete/${uid}`, // Change this to your actual delete API endpoint
        type: 'DELETE',
        success: function(response) {
            Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
            ).then(() => {
                location.reload(); // Reload the page to see the changes
            });
        },
        error: function(xhr) {
            Swal.fire(
                'Error!',
                'There was an error deleting the file.',
                'error'
            );
        }
    });
}
</script>

