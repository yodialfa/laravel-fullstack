

/// Fungsi untuk mengisi dropdown kecamatan
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

        $.each(data.kecamatan, function (index, kecamatan) {
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
      console.log("klik");
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
            console.log("berhasil");
              // Tampilkan harga yang diterima dari server
              $('#harga').text('Harga: ' + data.price);
          },
          error: function (data) {
              console.log('Error:', data);
          }
      });
  });
});

// document.getElementById('formRegist').addEventListener('submit', function (e) {
//     e.preventDefault(); // Prevent the default form submission

//     const form = e.target;

//     fetch(form.action, {
//         method: form.method,
//         body: new FormData(form),
//     })
//     .then(response => {
//         if (response.ok) {
//             // Reload the page after a successful submission
//             window.location.reload();
//         } else {
//             // Handle errors if needed
//         }
//     })
//     .catch(error => {
//         console.error(error);
//     });
// });






