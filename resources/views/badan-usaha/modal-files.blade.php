<div class="modal fade" id="modalFiles{{ $usaha->id }}" tabindex="-1" aria-labelledby="modalFilesLabel{{ $usaha->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalFilesLabel{{ $usaha->id }}">File Dokumen Badan Usaha</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <ul class="list-group">
          <li class="list-group-item"><a href="{{ asset('storage/' . $usaha->photo_pjbu) }}" target="_blank">Photo PJBU</a></li>
          <li class="list-group-item"><a href="{{ asset('storage/' . $usaha->npwp_bu_file) }}" target="_blank">NPWP BU</a></li>
          <li class="list-group-item"><a href="{{ asset('storage/' . $usaha->nib_file) }}" target="_blank">NIB</a></li>
          <li class="list-group-item"><a href="{{ asset('storage/' . $usaha->ktp_pjbu_file) }}" target="_blank">KTP PJBU</a></li>
          <li class="list-group-item"><a href="{{ asset('storage/' . $usaha->npwp_pjbu_file) }}" target="_blank">NPWP PJBU</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
