function readURL(input) {
    var cont = 0;
    
    // Remove previous elements
    $('#tableBodyImages').empty();
    
    var filesCount = input.files.length;
    for(var i=0; i < filesCount; i++ ) {
            var reader = new FileReader();
            reader.onload = function (e) {
            $('#tableBodyImages').append( `
                <tr id="row-${cont}">
                    <td><img src="${e.target.result}" style="width:6em;"/></td>
                    <td><input name="descripcion-${cont}"type="text" placeholder="Agrega una descripción..." class="form-control"></td>
                </tr>
            ` );
            cont ++;
        }
        reader.readAsDataURL(input.files[i]);
        
    }
}
$("#inputFiles").change(function(){
    readURL(this);
});
