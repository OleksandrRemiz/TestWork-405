jQuery(function($){
    jQuery('.upload_image_button').click(function( event ){
        event.preventDefault();
        const button = $(this);
        const customUploader = wp.media({
            title: 'Выберите изображение плз',
            library : {
                type : 'image'
            },
            button: {
                text: 'Выбрать изображение'
            },
            multiple: false
        });
 
        // событие выбора изображения
        customUploader.on('select', function() {
            const image = customUploader.state().get('selection').first().toJSON();
            button.parent().prev().attr( 'src', image.url );
            button.prev().val( image.id );
        });
        // открыти модального окна с выбором изображения
        customUploader.open();
    });

    jQuery('.remove_image_button').click(function( event){
        event.preventDefault();
        if ( true == confirm( "Уверены?" ) ) {
            const src = $(this).parent().prev().data('src');
            $(this).parent().prev().attr('src', src);
            $(this).prev().prev().val('');
        }
    });
});