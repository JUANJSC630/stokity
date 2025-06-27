$(".select-role").change(function () {
    var role = $(this).val();
    if (role === "admin" || role === "") {
        // Ocultar si es admin o si no hay rol seleccionado
        $(".select-branch").hide();
    } else {
        // Mostrar solo si hay un rol seleccionado que no sea admin
        $(".select-branch").show();
    }
});

// Ejecutar también al cargar la página
$(document).ready(function() {
    var initialRole = $(".select-role").val();
    if (initialRole === "admin" || initialRole === "") {
        $(".select-branch").hide();
    } else {
        $(".select-branch").show();
    }
});
