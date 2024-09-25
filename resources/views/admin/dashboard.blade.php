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
                            <h3 class="page-title">Entreprise</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="admin-dashboard.html">Dashboard</a></li>
                                <li class="breadcrumb-item active">Entreprise</li>
                            </ul>
                        </div>
                        
                    </div>
                </div>
                <!-- /Page Header -->

                <div class="card" style="border: 0;box-shadow: 0 0 20px 0 rgba(76,87,125,.2);">
                    <div class="card-body ">
                        <form id="myForm">
                            @csrf
                            <br>
                                <label for="inputText4" class="col-form-label">Select Date Range:</label><br>
                                <input type="text"  id="date_range" class="form-control" name="date_range">
                            <br>
                            <div class="form-group" style="margin-top: 18px;">
                                <input type="submit" name="submit" value="Search" class="btn btn-primary">
                            </div>
                        </form>
                        

                    </div>
                </div>
                <div id="loadingMessage" style="display:none;">Loading...</div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table mb-0" id="desigTable">
                                <thead>
                                    <tr>
 
                                        <th class="width-thirty">#</th>
                                        <th>User ID</th>
                                        <th>raisonSociale</th>
                                        <th>formeJuridique</th>
                                        <th>dateCreation</th>
                                        <th>effectif</th>
                                        <th>siret</th>
                                        <th>adresse</th>
                                        <th>ville</th>
                                        <th>codePostal</th>
                                        <th >Action</th>
                                    </tr>
                                
                                </thead>
                                <tbody>
                                    @foreach($data as $entreprise)
                                    <tr>
                                        <td> {{$entreprise->id}}</td>
                                        <td>{{$entreprise->uid}}</td>
                                        <td>{{$entreprise->raisonSociale}}</td>
                                        <td>{{$entreprise->formeJuridique}}</td>
                                        <td>{{$entreprise->dateCreation}}</td>
                                        <td>{{$entreprise->effectif}}</td>
                                        <td>{{$entreprise->siret}}</td>
                                        <td>{{$entreprise->adresse}}</td>
                                        <td>{{$entreprise->ville}}</td>
                                        <td>{{$entreprise->codePostal}}</td>
                                        <td><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_designation" id="editEmployeeButton"><i class="fa-regular fa-trash-can m-r-5" data-id="{{$entreprise->id}}" ></i>Delete</a></div></div></td>
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Content -->

            
            <!-- Delete Designation Modal -->
            <div class="modal custom-modal fade" id="delete_designation" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3>Delete leave Approver</h3>
                                <p>Are you sure want to delete?</p>
                            </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                    <form id="desigDelete">
                                        @csrf
                                        <input id ="attendance_id" class="form-control" name="attendance_id" type="hidden">
                                        <button style="padding: 10px 74px;" type="submit" class="btn btn-primary continue-btn">Delete</button>
                                    </form>
                                </div>
                                    <div class="col-6">
                                        <a href="javascript:void(0);" data-bs-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Delete Designation Modal -->
        
        </div>
        <!-- /Page Wrapper -->


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
            'excel'
            ]
        });
    });

    $(function() {
    $('input[name="date_range"]').daterangepicker({
        // opens: 'left',
        // autoApply: true,
        locale: {
        format: 'YYYY-MM-DD'
    }
    }, function(start, end, label) {
        console.log("A date range was chosen: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });

    $(document).ready(function() {
        
        $('#myForm').submit(function(event) {
			event.preventDefault(); // Prevent the form from submitting normally
                
            var formData = new FormData(this);

			$.ajax({
			url: '/api/entreprise-list',
			type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
			success: function(response) {
                console.log(response)
                Swal.fire({
                    title: 'Please wait...',
                    text: 'Loading data...',
                    allowOutsideClick: false,  // Prevent closing by clicking outside
                    timer: 1000,  // 1-second timer
                    didOpen: () => {
                        Swal.showLoading();  // Show loading spinner
                    }
                });
                var table = $('#desigTable').DataTable();
				table.clear().draw();
                var rowNum = 1;

                // Iterate through the data and populate the table
                response.data.forEach(function(item) {
                    var createdAt = new Date(item.created_at).toLocaleString();
                    
                    var rowData = [
                        rowNum,
                        '<td >' + (item.uid || 'N/A') + '</td>',
                        '<td >' + (item.raisonSociale || 'N/A') + '</td>',
                        '<td >' + ( item.formeJuridique || 'N/A')  + '</td>',
                        '<td >' + (item.dateCreation || 'N/A') + '</td>',
                        '<td >' + (item.effectif || 'N/A') + '</td>',
                        '<td >' + (item.siret || 'N/A') + '</td>',
                        '<td >' + (item.adresse || 'N/A') + '</td>',
                        '<td >' + (item.ville || 'N/A') + '</td>',
                        '<td >' + (item.codePostal || 'N/A') + '</td>',
                        '<td ><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_designation" id="editEmployeeButton"><i class="fa-regular fa-trash-can m-r-5" data-id="'+item.id+'" ></i>Delete</a></div></div></td>'
                    ];
                    table.row.add(rowData);
                    
                    rowNum++;
                });
                
                table.draw();
			},
            error: function(xhr, textStatus, errorThrown) {
                console.log(xhr);
                if (xhr.status == 404) {
                    var table = $('#desigTable').DataTable();
				    table.clear().draw();
                    Swal.fire({
                            icon: 'error',
                            title: 'No Data Found For This Date',
                        });
                } else {
                    console.log('Error in API call');
                }
            }
			});
		});

        $(document).on('click', '.dropdown-item[data-bs-target="#delete_designation"]', function() {
            var attendance_id = $(this).find('.fa-regular.fa-trash-can').data('id');
            console.log(attendance_id);
            $('#attendance_id').val(attendance_id);
        });


        $('#desigDelete').submit(function(e) {
            e.preventDefault();
            var attendance_id = $('#attendance_id').val();
            console.log(attendance_id);
            var formData = new FormData(this);

            $.ajax({
                    url: baseUrl+'/delete-attendance/'+attendance_id, 
                    type: 'DELETE',
                    data: formData,
                    headers: {
                        'Authorization': 'Bearer ' + jwtToken
                    },
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // var dept_id = response.data;
                        console.log(response);
                        $('#delete_designation').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Attendance successfully deleted',
                            text: 'You have successfully deleted a Attendance',
                            showConfirmButton: true,
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                        
                    },
                    error: function(xhr, status, error) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.error;
                            var errorMessage = "<ul>";
                            for (var field in errors) {
                                errorMessage += "<li>" + errors[field][0] + "</li>";
                            }
                            errorMessage += "</ul>";
                            
                            Swal.fire({
                                icon: 'error',
                                title: 'Validation Error',
                                html: errorMessage
                            });
                        }
                    }
                });
        });
    });
</script>