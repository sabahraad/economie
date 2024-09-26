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
               

                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                        <form action="{{ route('download.selected') }}" method="POST">
                            @csrf

                            
                            <div class="table-responsive">
                                <table class="table table-striped custom-table mb-0" id="desigTable">
                                    <thead>
                                        <tr>
                                        <th>#
                                            </th>
                                            <th>UID</th>
                                            <th>raisonSociale</th>
                                            <th>formeJuridique</th>
                                            <th>dateCreation</th>
                                            <th>effectif</th>
                                            <th>siret</th>
                                            <th>adresse</th>
                                            <th>ville</th>
                                            <th>codePostal</th>
                                            <th>genre</th>
                                            <th>prenom</th>
                                            <th>nom</th>
                                            <th>paysNaissance</th>
                                            <th>villeNaissance</th>
                                            <th>codePostalNaissance</th>
                                            <th>nationaliteNaissance</th>
                                            <th>mail</th>
                                            <th>cniRecto</th>
                                            <th>cniVerso</th>
                                            <th>cniSupplementaire</th>
                                            <th>justifcatifDomicile</th>
                                            <th>selfie</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <tr>
                                                <td>{{ $data->id ?? 'N/A'}}</td>
                                                <td>{{ $data->uid ?? 'N/A'}}</td>
                                                <td>{{ $data->raisonSociale ?? 'N/A'}}</td>
                                                <td>{{ $data->formeJuridique ?? 'N/A'}}</td>
                                                <td>{{ $data->dateCreation ?? 'N/A'}}</td>
                                                <td>{{ $data->effectif ?? 'N/A'}}</td>
                                                <td>{{ $data->siret ?? 'N/A'}}</td>
                                                <td>{{ $data->adresse ?? 'N/A'}}</td>
                                                <td>{{ $data->ville ?? 'N/A'}}</td>
                                                <td>{{ $data->codePostal ?? 'N/A'}}</td>
                                                <td>{{ $data->genre ?? 'N/A'}}</td>
                                                <td>{{ $data->prenom ?? 'N/A'}}</td>
                                                <td>{{ $data->nom ?? 'N/A'}}</td>
                                                <td>{{ $data->paysNaissance ?? 'N/A'}}</td>
                                                <td>{{ $data->villeNaissance ?? 'N/A'}}</td>
                                                <td>{{ $data->codePostalNaissance ?? 'N/A'}}</td>
                                                <td>{{ $data->nationaliteNaissance ?? 'N/A'}}</td>
                                                <td>{{ $data->mail ?? 'N/A'}}</td>
                                                <td>
                                                    @if (isset($data['cniRecto']) && $data['cniRecto'])
                                                        <img src="{{ asset($data->cniRecto) }}" alt="CNI Recto" style="width: 100px; height: auto;">
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (isset($data['cniVerso']) && $data['cniVerso'])
                                                        <img src="{{ asset($data->cniVerso) }}" alt="CNI Verso" style="width: 100px; height: auto;">
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (isset($data['cniSupplementaire']) && $data['cniSupplementaire'])
                                                        <img src="{{ asset($data->cniSupplementaire) }}" alt="CNI Supplementaire" style="width: 100px; height: auto;">
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (isset($data['justifcatifDomicile']) && $data['justifcatifDomicile'])
                                                        <img src="{{ asset($data->justifcatifDomicile) }}" alt="Justificatif Domicile" style="width: 100px; height: auto;">
                                                    @else
                                                        N/A
                                                    @endif

                                                </td>
                                                <td>
                                                    @if (isset($data['selfie']) && $data['selfie'])
                                                        <img src="{{ asset($data->selfie) }}" alt="Selfie" style="width: 100px; height: auto;">
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>{{ $data->created_at ?? 'N/A' }}</td>
                                            </tr>
    
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
</script>