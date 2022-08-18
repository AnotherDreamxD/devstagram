import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone("#dropzone",{
    dictDefaultMessage: "Sube aqui tu Imagen",
    acceptedFiles: ".png,.jpg,.jpeg,.gif",
    addRemoveLinks: true,
    dictRemoveFile: "Borrar Archivo",
    maxFiles: 1,
    uploadMultiple: false,

    //permite obtener el valor del value anterior para poder mostrar la imagen que ya se habia intentado subir ya que con old() solo recupera el value
    //pero no asi la visualizacion de la imagen

    init: function(){
        if(document.querySelector('[name="imagen"]').value.trim()){
            const imagenPublicada = {}
            imagenPublicada.size = 1234;
            imagenPublicada.name = document.querySelector('[name="imagen"]').value;

            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(this, imagenPublicada,`/uploads/${imagenPublicada.name}`)

            imagenPublicada.previewElement.classList.add('dz-success','dz-complete')
        }
    }

});


//Asigna el valor Json que se devuelve en el controlador de imagen hacia el value del input de imagen

dropzone.on("success",function(file, response){
    document.querySelector('[name="imagen"]').value = response.imagen
});

dropzone.on("removedfile",function(file, message){
    document.querySelector('[name="imagen"]').value = ''
})
