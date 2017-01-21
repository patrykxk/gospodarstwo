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
function DeleteRow(id) {
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

function GetParcelDetails(id) {
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
function UpdateParcelDetails() {
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