$(document).ready(function() {
    $("#cpassword").change(function() {
        var password = $("#password").val();
        var cpassword = $("#cpassword").val();
        if (password != cpassword) {
            $("#cpassword").addClass("is-invalid");
        } else {
            $("#cpassword").removeClass("is-invalid");

        }
    })
    // Show/Hide Password
    $("#button-addon2").click(function() {
        var passInput = $("#password");
        var icon = $("#iconPassword");
        if (passInput.attr('type') === 'password') {
            passInput.attr('type', 'text');
            icon.removeClass("fa-eye-slash");
            icon.addClass("fa-eye");
        } else {
            passInput.attr('type', 'password');
            icon.removeClass("fa-eye");
            icon.addClass("fa-eye-slash");
        }
    })
    //submenu
    $(".sub-btn").click(function() {
        $(this).next(".sub-menu").slideToggle();
        $(this).find(".dropdown").toggleClass("rotate");
    });

    //sidebar
    $(".menu-btn").click(function() {
        $(".side-bar").addClass("active");
        $(".menu-btn").css("visibility", "hidden");
        $(".navbar").addClass("on");
        $(".main").addClass("on");

        //Icon action
        $(".btnAction").addClass("mb-1");

    });

    $(".close-btn").click(function() {
        $(".side-bar").removeClass("active");
        $(".menu-btn").css("visibility", "visible");
        $(".navbar").removeClass("on");
        $(".main").removeClass("on");

        //Icon action
        $(".btnAction").removeClass("mb-1");
    });
    // Alert Success
    $(".btnX").click(function() {
        $(".alert-success").removeClass("alert");
        $(".alert-success").css("visibility", "hidden");
    });

    // Alert Danger
    $(".btnX").click(function() {
        $(".alert-danger").removeClass("alert");
        $(".alert-danger").css("visibility", "hidden");
    });
    // Aktifkan kolom jatuh tempo
    $("#tgl_kembali").change(function() {
        $("#jatuh_tempo").removeAttr("disabled");
    })

    // Jumlah hari (Admin)
    $("#jatuh_tempo").change(function() {
        var tgl_kembali = Date.parse($("#tgl_kembali").val());
        var jatuh_tempo = Date.parse($("#jatuh_tempo").val());
        var jumlah_hari = (jatuh_tempo - tgl_kembali) / 86400000; // menjadi hari
        if (jumlah_hari < 0) {
            $("#jumlah_hari").val(Math.abs(Math.floor(jumlah_hari)));
        } else {
            jumlah_hari = 0;
            $("#jumlah_hari").val(jumlah_hari);
        }
        // Total denda
        $("#total_denda").val(Math.abs(jumlah_hari * 1000));
    })
    // Jumlah hari (User)
    $("#tgl_kembali").change(function() {
        var tgl_kembali = Date.parse($("#tgl_kembali").val());
        var jatuh_tempo = Date.parse($("#jatuh_tempo").val());
        var jumlah_hari = (jatuh_tempo - tgl_kembali) / 86400000; // menjadi hari
        if (jumlah_hari < 0) {
            $("#jumlah_hari").val(Math.abs(Math.floor(jumlah_hari)));

        } else {
            jumlah_hari = 0;
            $("#jumlah_hari").val(jumlah_hari);
        }
        // Total denda
        $("#total_denda").val(Math.abs(jumlah_hari * 1000));
    })
    // Select2
    $('.select2').select2({
        placeholder: "Pilih..",
        // allowClear: true
    });

    // Preview foto
    function bacaGambar(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('.img-preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#foto").change(function() {
        bacaGambar(this);
    });
});