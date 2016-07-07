$("#printStatistics").click(function() {
    $("#statistics").printThis({
        debug: false,
        importCSS: false,
        importStyle: true,
        loadCSS: "public/stylesheets/printStyle.css",
        pageTitle: "Reporte Estadistico"
    });
});