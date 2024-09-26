@include('admin.header')
@include('admin.navbar')

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
            <div class="document-item">
                <label>CNI Recto:</label>
                @if (isset($data['cniRecto']) && $data['cniRecto'])
                    <a href="{{ asset($data->cniRecto) }}" download="CNI_Recto">
                        <img src="{{ asset($data->cniRecto) }}" alt="CNI Recto">
                    </a>
                @else
                    N/A
                @endif
            </div>
            <div class="document-item">
                <label>CNI Verso:</label>
                @if (isset($data['cniVerso']) && $data['cniVerso'])
                    <a href="{{ asset($data->cniVerso) }}" download="cni_Verso">

                    <img src="{{ asset($data->cniVerso) }}" alt="CNI Verso">
                    </a>
                @else
                    N/A
                @endif
            </div>
            <div class="document-item">
                <label>CNI Supplementaire:</label>
                @if (isset($data['cniSupplementaire']) && $data['cniSupplementaire'])
                <a href="{{ asset($data->cniSupplementaire) }}" download="cni_Supplementaire">
                    <img src="{{ asset($data->cniSupplementaire) }}" alt="CNI Supplementaire">
                </a>
                @else
                    N/A
                @endif
            </div>
            <div class="document-item">
                <label>Justificatif Domicile:</label>
                @if (isset($data['justifcatifDomicile']) && $data['justifcatifDomicile'])
                <a href="{{ asset($data->justifcatifDomicile) }}" download="justifcatif_Domicile">
                    <img src="{{ asset($data->justifcatifDomicile) }}" alt="Justificatif Domicile">
                </a>
                @else
                    N/A
                @endif
            </div>
            <div class="document-item">
                <label>Selfie:</label>
                @if (isset($data['selfie']) && $data['selfie'])
                <a href="{{ asset($data->selfie) }}" download="selfie">
                    <img src="{{ asset($data->selfie) }}" alt="Selfie">
                </a>
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
