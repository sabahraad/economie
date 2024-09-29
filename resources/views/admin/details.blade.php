@include('admin.header')
@include('admin.navbar')
@php
use Illuminate\Support\Str;
@endphp

<style>
    .document-wrapper {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin-bottom: 20px;
        border: 1px solid #ddd;
        padding: 20px;
        border-radius: 10px;
        background-color: #f9f9f9;
    }

    .document-item {
        width: 80%;
        margin-bottom: 10px;
    }

    .document-item img {
        max-width: 100px;
        height: auto;
    }

    .document-item label {
        font-weight: bold;
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

        <!-- Document Details -->
        <div class="document-wrapper">
            <div class="document-item">
                <label>UID:</label> {{ $data->uid ?? 'N/A' }}
            </div>
            <div class="document-item">
                <label>Raison Sociale:</label> {{ $data->raisonSociale ?? 'N/A' }}
            </div>
            <div class="document-item">
                <label>Forme Juridique:</label> {{ $data->formeJuridique ?? 'N/A' }}
            </div>
            <div class="document-item">
                <label>Date Creation:</label> {{ $data->dateCreation ?? 'N/A' }}
            </div>
            <div class="document-item">
                <label>Effectif:</label> {{ $data->effectif ?? 'N/A' }}
            </div>
            <div class="document-item">
                <label>Siret:</label> {{ $data->siret ?? 'N/A' }}
            </div>
            <div class="document-item">
                <label>Adresse:</label> {{ $data->adresse ?? 'N/A' }}
            </div>
            <div class="document-item">
                <label>Ville:</label> {{ $data->ville ?? 'N/A' }}
            </div>
            <div class="document-item">
                <label>Code Postal:</label> {{ $data->codePostal ?? 'N/A' }}
            </div>
            <div class="document-item">
                <label>Genre:</label> {{ $data->genre ?? 'N/A' }}
            </div>
            <div class="document-item">
                <label>Prénom:</label> {{ $data->prenom ?? 'N/A' }}
            </div>
            <div class="document-item">
                <label>Nom:</label> {{ $data->nom ?? 'N/A' }}
            </div>
            <div class="document-item">
                <label>Pays Naissance:</label> {{ $data->paysNaissance ?? 'N/A' }}
            </div>
            <div class="document-item">
                <label>Ville Naissance:</label> {{ $data->villeNaissance ?? 'N/A' }}
            </div>
            <div class="document-item">
                <label>Code Postal Naissance:</label> {{ $data->codePostalNaissance ?? 'N/A' }}
            </div>
            <div class="document-item">
                <label>Nationalité Naissance:</label> {{ $data->nationaliteNaissance ?? 'N/A' }}
            </div>
            <div class="document-item">
                <label>Mail:</label> {{ $data->mail ?? 'N/A' }}
            </div>
            @php
                $imageExtensions = ['jpg', 'jpeg', 'png', 'gif']; // Define image extensions
            @endphp

            <div class="document-item">
                <label>CNI Recto:</label>
                @if (isset($data['cniRecto']) && $data['cniRecto'])
                    @if (Str::endsWith($data->cniRecto, $imageExtensions))
                        <a href="{{ asset($data->cniRecto) }}" download="CNI_Recto">
                            <img src="{{ asset($data->cniRecto) }}" alt="CNI Recto" style="max-width: 100px;">
                        </a>
                    @elseif (Str::endsWith($data->cniRecto, '.pdf'))
                        <a href="{{ asset($data->cniRecto) }}" download="CNI_Recto">
                            <i class="fas fa-file-pdf"></i> Download PDF
                        </a>
                    @else
                        File format not supported
                    @endif
                @else
                    N/A
                @endif
            </div>

            <div class="document-item">
                <label>CNI Verso:</label>
                @if (isset($data['cniVerso']) && $data['cniVerso'])
                    @if (Str::endsWith($data->cniVerso, $imageExtensions))
                        <a href="{{ asset($data->cniVerso) }}" download="CNI_Verso">
                            <img src="{{ asset($data->cniVerso) }}" alt="CNI Verso" style="max-width: 100px;">
                        </a>
                    @elseif (Str::endsWith($data->cniVerso, '.pdf'))
                        <a href="{{ asset($data->cniVerso) }}" download="CNI_Verso">
                            <i class="fas fa-file-pdf"></i> Download PDF
                        </a>
                    @else
                        File format not supported
                    @endif
                @else
                    N/A
                @endif
            </div>

            <div class="document-item">
                <label>CNI Supplementaire:</label>
                @if (isset($data['cniSupplementaire']) && $data['cniSupplementaire'])
                    @if (Str::endsWith($data->cniSupplementaire, $imageExtensions))
                        <a href="{{ asset($data->cniSupplementaire) }}" download="CNI_Supplementaire">
                            <img src="{{ asset($data->cniSupplementaire) }}" alt="CNI Supplementaire" style="max-width: 100px;">
                        </a>
                    @elseif (Str::endsWith($data->cniSupplementaire, '.pdf'))
                        <a href="{{ asset($data->cniSupplementaire) }}" download="CNI_Supplementaire">
                            <i class="fas fa-file-pdf"></i> Download PDF
                        </a>
                    @else
                        File format not supported
                    @endif
                @else
                    N/A
                @endif
            </div>

            <div class="document-item">
                <label>Justificatif Domicile:</label>
                @if (isset($data['justifcatifDomicile']) && $data['justifcatifDomicile'])
                    @if (Str::endsWith($data->justifcatifDomicile, $imageExtensions))
                        <a href="{{ asset($data->justifcatifDomicile) }}" download="Justificatif_Domicile">
                            <img src="{{ asset($data->justifcatifDomicile) }}" alt="Justificatif Domicile" style="max-width: 100px;">
                        </a>
                    @elseif (Str::endsWith($data->justifcatifDomicile, '.pdf'))
                        <a href="{{ asset($data->justifcatifDomicile) }}" download="Justificatif_Domicile">
                            <i class="fas fa-file-pdf"></i> Download PDF
                        </a>
                    @else
                        File format not supported
                    @endif
                @else
                    N/A
                @endif
            </div>

            <div class="document-item">
                <label>Selfie:</label>
                @if (isset($data['selfie']) && $data['selfie'])
                    @if (Str::endsWith($data->selfie, $imageExtensions))
                        <a href="{{ asset($data->selfie) }}" download="Selfie">
                            <img src="{{ asset($data->selfie) }}" alt="Selfie" style="max-width: 100px;">
                        </a>
                    @elseif (Str::endsWith($data->selfie, '.pdf'))
                        <a href="{{ asset($data->selfie) }}" download="Selfie">
                            <i class="fas fa-file-pdf"></i> Download PDF
                        </a>
                    @else
                        File format not supported
                    @endif
                @else
                    N/A
                @endif
            </div>
            <div class="document-item">
                <label>Created At:</label> {{ $data->created_at ?? 'N/A' }}
            </div>
        </div>
    </div>
    <!-- /Page Content -->
</div>
