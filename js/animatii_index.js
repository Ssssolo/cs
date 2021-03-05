 $(function() {
        $(".preloader").fadeOut();
    });
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    });
	
	// ============================================================== 
    // Logare -> inregistrare
    // ============================================================== 
    $('#to-register').on("click", function() {
        $("#loginform").slideUp();
        $("#registerform").fadeIn();
    }); 
	
	// ============================================================== 
    // Inregistrare -> logare
    // ============================================================== 
    $('#to-login').on("click", function() {
        $("#registerform").slideUp();
        $("#loginform").slideDown();
    });
	
	// ============================================================== 
    // Logare -> recuperare
    // ============================================================== 
    $('#to-recover').on("click", function() {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
    }); 
	
	// ============================================================== 
    // Recuperare -> logare
    // ============================================================== 
    $('#to-login2').on("click", function() {
        $("#recoverform").slideUp();
        $("#loginform").slideDown();
    });