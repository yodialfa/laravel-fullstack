

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

//fungsi generate id
let counter = 0;
function generateUniqueID() {
  const now = new Date();
  const year = now.getFullYear();
  const month = String(now.getMonth() + 1).padStart(2, '0'); // Adding 1 because months are zero-indexed
  const day = String(now.getDate()).padStart(2, '0');
  const minutes = String(now.getMinutes()).padStart(2, '0');
  const seconds = String(now.getSeconds()).padStart(2, '0');
  const miliseconds = String(now.getMilliseconds()).padStart(2,'0');
  
  const noResi = `${year}${month}${day}${minutes}${seconds}${miliseconds}${counter}`;
  counter++;

  return noResi;
}


// fungsi elemen dinamis untuk getHarga
function updateElementValue(element, value) {
  // Fungsi ini memeriksa tipe elemen dan kemudian mengatur nilai sesuai dengan tipe elemen tersebut.
  if (element.is('input, select, textarea')) {
    element.val(value);
  } else {
    element.text(value);
  }
}

//fungsi getHarga
function getHarga(kotaAsal, kecAsal, kotaTujuan, kecTujuan, layananTrx, element) {
  // console.log("klik");
  // Ambil nilai yang dipilih dalam form
  const kotaasal = kotaAsal.val();
  const kecasal = kecAsal.val();
  const kotatujuan = kotaTujuan.val();
  const kectujuan = kecTujuan.val();
  const layanan = layananTrx.val();

  if (kotaasal && kecasal && kotatujuan && kectujuan && layanan) {
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
          if (data.price) {
            const priceData = data.price; // Consider the first customer for simplicity
            // console.log(customerData);
            updateElementValue(element, priceData); // Update the value of the name field
            
         } else
         {
             updateElementValue(element, 0);
         }
      },
      error: function (data) {
          console.log('Error:', data);
      }
    });
  }
}


//fungsi filled recipient
function updateRecipientData(inputElement, nameElement, addressElement) {
  const selectedPhone = inputElement.val();

  if (selectedPhone) {
      // Fetch the corresponding customer details from the server
      $.ajax({
          type: 'GET',
          url: '/transaksi/get-customer/' + selectedPhone,
          // data: { no_hp_cust: selectedPhone },
          dataType: 'json',
          success: function(data) {
            // console.log(data);
              if (data.customer) {
                  const customerData = data.customer; // Consider the first customer for simplicity
                  // console.log(customerData);
                  nameElement.val(customerData.nama_customer); // Update the value of the name field
                  addressElement.val(customerData.alamat_customer); // Update the value of the address field
                  // You can also update other fields similarly
              } else
              {
                  nameElement.val('');
                  addressElement.val('');
              }
          },
          error: function() {
              // Handle error
          }
      });
  }
}



// $(document).ready(function () {
//   // ketika submit cek tarif
//   $('#ambil').on('click', function () {
//       // console.log("klik");
//       // Ambil nilai yang dipilih dalam form
//       var kotaasal = $('#kotaasal').val();
//       var kecasal = $('#kecasal').val();
//       var kotatujuan = $('#kotatujuan').val();
//       var kectujuan = $('#kectujuan').val();
//       var layanan = $('#layanan').val();

//       // Kirim permintaan AJAX
//       $.ajax({
//           type: 'GET',
//           url: "/get-price",
//           data: {
//               kotaasal: kotaasal,
//               kecasal: kecasal,
//               kotatujuan: kotatujuan,
//               kectujuan: kectujuan,
//               layanan: layanan
//           },
//           success: function (data) {
//             // console.log("berhasil");
//               // Tampilkan harga yang diterima dari server
//               $('#harga').text('Harga: ' + data.price);
//           },
//           error: function (data) {
//               console.log('Error:', data);
//           }
//       });
//   });
// });




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
  // console.log('Tambah kecamatan clicked with selectedKotaId:', selectedKotaId);
  window.location.href = '/kecamatan/tambah/'+ selectedKotaId;
});


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


//set default
$(document).ready(function() {
  var beratTransaksi = $('#jumlah');
  var jumlahTransaksi = $('#berat');
  var diskonTransaksi = $('#diskon');
  var bySurat = $('#biaya_surat');
  var byAsuransi = $('#biaya_asuransi');
  var total = $('#total_harga');
  var elementIDs = ['jumlah', 'berat', 'diskon', 'biaya_surat', 'biaya_asuransi'];

  elementIDs.forEach(function(id) {
    $('#' + id).val(0);
  });

  beratTransaksi.val(0);
  jumlahTransaksi.val(0);
  diskonTransaksi.val(0);
  bySurat.val(0);
  byAsuransi.val(0);
  total.val(0);


  $('#no_resi').val(generateUniqueID());

  $(elementIDs.map(id => '#' + id).join(', ')).on('change', function() {

    // Ambil nilai dari elemen-elemen yang sesuai dengan event
    let beratTransaksi = parseFloat($('#berat').val());
    let hargaTrx = parseFloat($('#harga').val());
    let disc = parseFloat($('#diskon').val());
    let surat = parseFloat($('#biaya_surat').val());
    let asuransi = parseFloat($('#biaya_asuransi').val());
    

    var ongkir = beratTransaksi * hargaTrx;
    // console.log(ongkir);
    // var diskon = disc / 100;
    var totalDiskon = ongkir * (disc / 100);
    // console.log(totalDiskon);
    var total = ongkir - totalDiskon + surat + asuransi;
    // console.log(total);
      
    // Update nilai total untuk elemen yang sesuai
    $('#total_harga').val(total.toFixed(2));


  });



});

//  form submission using jQuery
$('#formTrx').submit(function(event) {
  // Set the value before submitting the form
  var uniqueID = generateUniqueID();
  console.log('Generated ID:', uniqueID);
  $('#no_resi').val(uniqueID);

});


$('#phone-input-pengirim').on('change', function() {
  updateRecipientData($(this), $('#nama-pengirim'), $('#alamat-pengirim'));
});

$('#phone-input-penerima').on('change', function() {
  updateRecipientData($(this), $('#nama-penerima'), $('#alamat-penerima'));
});



$('#layanan').on('change', function() {
  const hargaElement = $('#harga');
  getHarga($('#kotaasal'), $('#kecasal'), $('#kotatujuan'), $('#kectujuan'), $(this), hargaElement);
});

$('#ambil').on('click', function () {
  const hargaElement = $('#harga');
  getHarga($('#kotaasal'), $('#kecasal'), $('#kotatujuan'), $('#kectujuan'), $('layanan'), hargaElement);
});

// var successMessage = '{{ session('success') }}';
// var pdfUrl = '{{ session('pdf_url') }}';

// if (successMessage && pdfUrl) {
//     // Display success message
//     alert(successMessage);

//     // Initiate PDF download in a new tab/window
//     window.open(pdfUrl, '_blank');

//     // Clear success message and PDF URL from the session
//     '{{ session()->forget(['success', 'pdf_url']) }}';
// }


// var successMessage = '{{ session("success") }}';
// var pdfUrl =  @json(session('pdf_url'));

// if (successMessage && pdfUrl) {
//     console.log('PDF URL:', pdfUrl);
// //     // Display success message
// //     // alert(successMessage);

// //     // Initiate PDF download in a new tab/window
//     window.open(pdfUrl, '_blank');
    // window.location.href = '/generate-pdf/'+ pdfUrl;

    // sessionStorage.removeItem('success'); 
    // sessionStorage.removeItem('pdf_url');
    
// }



