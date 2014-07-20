

var _menError="";

function quitaEspacio(text)
{
    text=$.trim(text);
    return text;

}

function isValidCombo(Elemento, campo, no_select){

    if((Elemento.val() == "-1" && !no_select) || Elemento.val() == "-2")
        {
                _menError="Debes seleccionar una opci\u00f3n para: " + campo;
                //Elemento.addClass("ui-state-error");
                Elemento.focus();
                return false;
        }

        return true;
}       

function isValid(Elemento,campo,tipo,vacio)
{		
        var patron="";

        switch(tipo)
        {
                case "name": //Juan P�rez
                        patron=/^[\u00e1\u00e9\u00ed\u00f3\u00fa\u00c1\u00c9\u00cd\u00d3\u00da\u00f1\u00d1a-zA-Z\s]*$/;
                break;
                case "mail":	
                        patron=/^[a-zA-Z][\w\.-]*[a-zA-Z0-9]@[a-zA-Z0-9][\w\.-]*[a-zA-Z0-9]\.[a-zA-Z][a-zA-Z\.]*[a-zA-Z]$/;
                break;
                case "cp":	//77500
                        patron=/^[0-9]{5}$/;
                break;
                case "rfc": // ROOA8BZ830829BZ8 � ROA 830829BZ8
                        patron= /^[a-zA-Z]{3,4}(\d{6})((\D|\d){3})?$/; //^([a-zA-Z]{3})([a-zA-Z\s]{1})\d{6}([a-zA-Z0-9]{3})$/;/                                
                        break;
                case "word":	//Atenci�n: Esto es lo que se puede hacer, continue
                        patron=/^[\u00e1\u00e9\u00ed\u00f3\u00fa\u00c1\u00c9\u00cd\u00d3\u00da\u00f1\u00d1a-zA-Z0-9\s_\-\.\,\(\)\?\#\'\´\%\:\/\\\;\"\"\$\*\&\+\@\!\¡]+$/;
                break;
                case "money": //$2,500,999.00
                        patron =/^\$?[0-9,]*[0-9]+(\.[0-9]+)?$/;
                break;
                case "alphanumeric": //letras y numeros sin espacios
                        patron =/^[a-zA-Z0-9]+$/;
                break;
                case "alpha":       //Solo letras sin espacios
                        patron =/^[a-zA-Z]+$/;
                break;
                case "date": // antes 10/10/2009  � 10-10-2009 ahora 2010/01/01  o 2010-01-01
                        patron=/^([0][1-9]|[12][0-9]|3[01])([\/|-])(0[1-9]|1[0-2])([\/|-])\d{4}$/;
                        //patron=/^(\d{4})([\/|-])(0[1-9]|1[0-2])([\/|-])([0][1-9]|[12][0-9]|3[01])$/
                break;
                case "decimal":     // -12345.67890  123.4567890
                        patron = /^-?[0-9]+(\.[0-9]*)?$/;
                break;
                case "numeric_decimal":     //  123.4567890 o  414 +
                        patron = /^[0-9,]+\.?[0-9]*$/;
                break;
                case "numeric":     // -123  1234567890
                        patron = /^-?[0-9]+$/;
                break;
                case "numericpos": //solo acepta numeros positivos
                        patron = /^[0-9]+$/;
                break;
                case "time"://formato 24hrs
                        patron=/^(0[1-9]|1\d|2[0-3]):([0-5]\d)$/;
                break;
                case "telephone": //(998)-163-9238 � +999-(9)-998-163-9238
                        patron=/^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,3})|(\(?\d{2,3}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$/;
                break;
                break;
                case 'url':
                        patron = /(http[s]?:\/\/|ftp:\/\/)?(www\.)?[a-zA-Z0-9-\.]+\.(com|org|net|mil|edu|ca|co.uk|com.au|gov|travel|com.mx)$/;
                break;
        }

        regex=new RegExp(patron); 

        if(quitaEspacio(Elemento.val())=="" && !vacio)
        {	
                _menError="El valor de la casilla " + campo + " es requerido.";
                Elemento.focus();
                return false;
        }
        if(!regex.test(Elemento.val()) && quitaEspacio(Elemento.val())!="")
        {
                _menError="En la casilla "+ campo +": el formato de entrada es incorrecto.";
                Elemento.focus();
                return false;
        }

        return true;
}        







