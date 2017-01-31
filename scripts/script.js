// Add Record 
function addRecord() {
    // get values
    var identyfikator = $("#identyfikator").val();
    var powierzchnia = $("#powierzchnia").val();
    var uwagi = $("#uwagi").val();
    // Add record
    $.post("ajax/dodajDzialke.php", {
        identyfikator: identyfikator,
        powierzchnia: powierzchnia,
        uwagi: uwagi
    }, function (data, status) {
        // close the popup
		$('#table').load(document.URL +  ' #table');
        $("#add_new_record_modal").modal("hide");
        // clear fields from the popup
        $("#identyfikator").val("");
        $("#powierzchnia").val("");
        $("#uwagi").val("");
    });
}
function deleteRow(id) {
    var conf = confirm("Czy na pewno chcesz usunąć ten wiersz?");
    if (conf == true) {
        $.post("ajax/usunDzialke.php", {
                id: id
            },
            function (data, status) {
                // reload table
                $('#table').load(document.URL +  ' #table');
            }
        );
	}
}

function getParcelDetails(id) {
    // Add Parcel ID to the hidden field for furture usage
    $("#hidden_parcel_id").val(id);
    $.post("ajax/readParcelDetails.php", {
            id: id
        },
        function (data, status) {
            // PARSE json data
            var parcel = JSON.parse(data);
            // Assing existing values to the modal popup fields
            $("#update_identyfikator").val(parcel.identyfikator);
            $("#update_powierzchnia").val(parcel.powierzchniaDzialki);
            $("#update_uwagi").val(parcel.uwagi);
        }
    );
    // Open modal popup
    $("#update_parcel_modal").modal("show");
}
function updateParcelDetails() {
    // get values
	var identyfikator = $("#update_identyfikator").val();
    var powierzchnia = $("#update_powierzchnia").val();
    var uwagi = $("#update_uwagi").val();
 
    // get hidden field value
    var id = $("#hidden_parcel_id").val();
 
    // Update the details by requesting to the server using ajax
    $.post("ajax/updateParcelDetails.php", {
            id: id,
			identyfikator: identyfikator,
			powierzchnia: powierzchnia,
			uwagi: uwagi
        },
        function (data, status) {
            // hide modal popup
            $("#update_parcel_modal").modal("hide");
            // reload table
            $('#table').load(document.URL +  ' #table');
        }
    );
}

function addField(idDzialki) {
    // get values
	var idRosliny = $("#idRosliny").val();
    var powierzchnia = $("#powierzchnia").val();
	var dataZasiewu = $("#dataZasiewu").val();
	var iloscZasiewu = $("#iloscZasiewu").val();
	var dataZbioru = $("#dataZbioru").val();
	var iloscZbioru = $("#iloscZbioru").val();
	var uwagi = $("#uwagi").val();
	
    // Add record
    $.post("ajax/addField.php", {
		idRosliny: idRosliny,
        powierzchnia: powierzchnia,
		dataZasiewu: dataZasiewu,
		iloscZasiewu: iloscZasiewu,
		dataZbioru: dataZbioru,
		iloscZbioru: iloscZbioru,
		uwagi: uwagi,
		idDzialki: idDzialki
		
    }, function (data, status) {
        // close the popup
		$('#table2').load(document.URL +  ' #table2');
        $("#add_new_record_modal").modal("hide");

        // clear fields from the popup
		$("#idRosliny").val("");
		$("#powierzchnia").val("");
		$("#dataZasiewu").val("");
		$("#iloscZasiewu").val("");
		$("#dataZbioru").val("");
		$("#iloscZbioru").val("");
        $("#uwagi").val("");
    });
}

function removeField(id) {
    var conf = confirm("Czy na pewno chcesz usunąć ten wiersz?");
    if (conf == true) {
        $.post("ajax/removeField.php", {
                id: id
            },
            function (data, status) {
                // reload table
                $('#table2').load(document.URL +  ' #table2');
            }
        );
	}
}

function getFieldDetails(id) {
    // Add Parcel ID to the hidden field for furture usage
    $("#hidden_field_id").val(id);
    $.post("ajax/readFieldDetails.php", {
            id: id
        },
        function (data, status) {
            
            var fields = JSON.parse(data);
			$("#update_idRosliny").val(fields.idRosliny);
			$("#update_powierzchnia").val(fields.powierzchniaUprawy);
			$("#update_dataZasiewu").val(fields.dataZasiewu);
			$("#update_iloscZasiewu").val(fields.iloscZasiewu);
			$("#update_dataZbioru").val(fields.dataZbioru);
			$("#update_iloscZbioru").val(fields.iloscZbioru);
			$("#update_uwagi").val(fields.uwagi);
        }
    );
    // Open modal popup
    $("#update_field_modal").modal("show");
}
function updateFieldDetails() {
    // get values
	var idRosliny = $("#update_idRosliny").val();
	var powierzchnia = $("#update_powierzchnia").val();
	var dataZasiewu = $("#update_dataZasiewu").val();
	var iloscZasiewu = $("#update_iloscZasiewu").val();
	var dataZbioru = $("#update_dataZbioru").val();
	var iloscZbioru = $("#update_iloscZbioru").val();
	var uwagi = $("#update_uwagi").val();
 
    // get hidden field value
    var id = $("#hidden_field_id").val();
 
    // Update the details by requesting to the server using ajax
    $.post("ajax/updateFieldDetails.php", {
            id: id,
			idRosliny: idRosliny,
			powierzchnia: powierzchnia,
			dataZasiewu: dataZasiewu,
			iloscZasiewu: iloscZasiewu,
			dataZbioru: dataZbioru,
			iloscZbioru: iloscZbioru,
			uwagi: uwagi,
        },
        function (data, status) {
            // hide modal popup
            $("#update_field_modal").modal("hide");
            // reload table
            $('#table2').load(document.URL +  ' #table2');
        }
    );
}


