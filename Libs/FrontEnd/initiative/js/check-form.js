function validate_form ( )
{
	valid = true;

        if ( document.contact.name.value == "" )
        {
                alert ( "Пожалуйста заполните поле 'Имя'." );
                valid = false;
        }

        if ( document.contact.email.value == "" )
        {
                alert ( "Пожалуйста заполните поле 'Email'." );
                valid = false;
        }

        if ( document.contact.massage.value == "" )
        {
                alert ( "Пожалуйста заполните поле 'Сообщение'." );
                valid = false;
        }

        return valid;
		
		
}
