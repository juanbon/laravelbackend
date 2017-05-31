function make_editor(e){

   editor = CKEDITOR.replace(e,{
                      toolbar:[[ 'Bold', 'Italic' ],
                  ['NumberedList','BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','Link']
                 ]
               }
               ); 

}
