

//Fungsi untuk mengisi dropdown kecamatan
function isiDropdownKecamatan(selectedKota, targetDropdownId) {
  if (selectedKota !== '') {
    $.ajax({
      type: 'GET',
      url: '/get-kecamatan/' + selectedKota, // Ganti dengan URL Anda
      success: function (data) {
        var kecamatanDropdown = $('#' + targetDropdownId); // Gunakan ID yang diteruskan
        kecamatanDropdown.empty(); // Menghapus opsi sebelumnya (jika ada)
        
        // Tambahkan opsi default ke dalam dropdown
        kecamatanDropdown.append($('<option>', {
          value: '', // Nilai opsi default (bisa kosong atau sesuai kebutuhan)
          text: '--Pilih Kecamatan--', // Teks opsi default
          disabled: true, // Opsi tidak dapat dipilih
          selected: true // Opsi default terpilih
        }));

        $.each(data, function (index, kecamatan) {
          kecamatanDropdown.append($('<option>', {
            value: kecamatan.id,
            text: kecamatan.NamaKecamatan
          }));
        });
      }
    });
  }
}

// Event handler untuk dropdown kota (misalnya, kotaasal)
$(document).ready(function () {
  $('#kotaasal').change(function () {
    var selectedKotaasal = $(this).val();
    isiDropdownKecamatan(selectedKotaasal, 'kecasal'); // Panggil fungsi untuk mengisi dropdown kecamatan
  });

});

// Event handler untuk dropdown kota (misalnya, kectujuan)
$(document).ready(function () {
  $('#kotatujuan').change(function () {
    var selectedKotatujuan = $(this).val();
    isiDropdownKecamatan(selectedKotatujuan, 'kectujuan'); // Panggil fungsi untuk mengisi dropdown kecamatan
  });
});


$(document).ready(function () {
  // ketika submit cek tarif
  $('#ambil').on('click', function () {
      // console.log("klik");
      // Ambil nilai yang dipilih dalam form
      var kotaasal = $('#kotaasal').val();
      var kecasal = $('#kecasal').val();
      var kotatujuan = $('#kotatujuan').val();
      var kectujuan = $('#kectujuan').val();
      var layanan = $('#layanan').val();

      // Kirim permintaan AJAX
      $.ajax({
          type: 'GET',
          url: "/get-price",
          data: {
              kotaasal: kotaasal,
              kecasal: kecasal,
              kotatujuan: kotatujuan,
              kectujuan: kectujuan,
              layanan: layanan
          },
          success: function (data) {
            // console.log("berhasil");
              // Tampilkan harga yang diterima dari server
              $('#harga').text('Harga: ' + data.price);
          },
          error: function (data) {
              console.log('Error:', data);
          }
      });
  });
});




// ambil kecamatan admin
$(document).ready(function() {
  let selectedKotaId;
  // Event ketika opsi kota dipilih
  $('#selectKota').change(function () {
      selectedKotaId = $(this).val();
      console.log('klik');

      // Kirim request Ajax untuk mendapatkan kecamatan berdasarkan kota
      $.ajax({
          url: '/get-kecamatan/' + selectedKotaId,
          type: 'GET',
          success: function(data) {
            // console.log('Data kecamatan diterima:', data);
              // Hapus data lama dari tabel
              $('#tableKecamatan tbody').empty();

              // Tambahkan data kecamatan ke dalam tabel
              $.each(data, function(index, kecamatan) {
                // Tambahkan tombol edit dan hapus ke setiap baris
                var newRow = '<tr class="">' +
                    '<td class="text-center">' + kecamatan.id + '</td>' +
                    '<td>' + kecamatan.NamaKecamatan + '</td>' +
                    
                    '<td class="flex items-center justify-center gap-4">' +
                    '<button class="btn-edit bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded" data-kecamatan-id="' + kecamatan.id + '">Edit</button>' +

                    '<button class="btn-hapus bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded" data-kecamatan-id="' + kecamatan.id + '">Hapus</button>' +
                    
                    '</td>' +
                    '</tr>';
                $('#tableKecamatan tbody').append(newRow);
            });
            
          },
          error: function(error) {
              console.error('Error:', error);
          }
      });
  });




  //Tambahkan event click untuk tombol edit
  $('#tableKecamatan').on('click', '.btn-edit', function() {
      const kecamatanId = $(this).data('kecamatan-id');
      // Implementasikan logika edit sesuai kebutuhan
      console.log('Edit kecamatan with ID:', kecamatanId);
      window.location.href = '/kecamatan/update/' + selectedKotaId + '/' + kecamatanId;
  });





  // Tambahkan event click untuk tombol hapus
  $('#tableKecamatan').on('click', '.btn-hapus', function () {
    const kecamatanId = $(this).data('kecamatan-id');

    // Mendapatkan elemen-elemen yang diperlukan
    const modal = document.getElementById('myModal');
    const confirmButton = document.getElementById('confirm');
    const cancelButton = document.getElementById('cancel');
    const closeButton = document.getElementById('close');
    const modalMessage = document.getElementById('modal-message');
    const deleteForm = document.getElementById('delete-form');


    // Set atribut data-kecamatan-id pada modal
    modal.setAttribute('data-kecamatan-id', kecamatanId);

    // Set action pada form
    deleteForm.setAttribute('action', '/kecamatan/hapus/' + kecamatanId);


    // Tampilkan modal ketika tombol hapus diklik
    const message = "Apakah Anda yakin ingin menghapus kecamatan dengan ID " + kecamatanId + "?";
    modalMessage.textContent = message;
    modal.classList.remove('hidden');

  
    // Menambahkan event listener untuk tombol konfirmasi
    confirmButton.addEventListener('click', function () {
        // Implementasikan logika hapus sesuai kebutuhan
        console.log('Hapus kecamatan with ID:', kecamatanId);

        // Sembunyikan modal setelah proses hapus selesai
        modal.classList.add('hidden');
        // window.location.href = '{{ route('kecamatan') }}';
    });

    // Menambahkan event listener untuk tombol batal
    cancelButton.addEventListener('click', () => {
        // Sembunyikan modal jika tombol batal diklik
        modal.classList.add('hidden');
    });

    closeButton.addEventListener('click', () => {
      // Sembunyikan modal jika tombol batal diklik
      modal.classList.add('hidden');
  });
  });

});


  //tambah kecamatan event
$('#tambahkec').on('click', function() {
  var selectedKotaId = $('#selectKota').val(); 
  console.log('Tambah kecamatan clicked with selectedKotaId:', selectedKotaId);
  window.location.href = '/kecamatan/tambah/'+ selectedKotaId;
});


