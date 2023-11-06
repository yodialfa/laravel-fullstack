<!-- Modal -->
{{-- <div id="myModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;
        <div class="w-full inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-top">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Konfirmasi</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500" id="modal-message">Apakah Anda yakin ingin melanjutkan?</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button id="confirm" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-500 text-base font-medium text-white hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Ya, Lanjutkan
                </button>
                <button id="cancel" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:w-auto sm:text-sm">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div> --}}

{{-- endmodal --}}
{{-- <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true"> --}}

{{-- <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true"> --}}
  {{-- <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this item?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="confirmDelete">Confirm Delete</button>
      </div>
    </div>
  </div>
</div> --}}

<div id="confirmationModal" class="hidden fixed top-0 left-0 flex items-center justify-center w-full h-full bg-black bg-opacity-50">
    <!-- Modal content -->
    <div class="bg-white p-8 rounded shadow-lg w-1/2">
        <h2 class="text-2xl font-semibold mb-4">Modal Title</h2>
        <div class="modal-body">
            Are you sure you want to delete this item?
        </div>
          <button type="button" class="btn btn-primary" id="confirmDelete">Confirm Delete</button>
        
        <div class="mt-4 flex justify-end">
            <!-- Close button -->
            <button id="closeModal" class="bg-gray-300 text-gray-700 px-4 py-2 rounded cursor-pointer">Close</button>
        </div>
    </div>
</div>

