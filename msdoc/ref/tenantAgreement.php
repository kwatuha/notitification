<script>
function openWord(file) {
    try {
        var objword = new ActiveXObject("Word.Application");
    } catch (e) {
        alert(e + 'Error Word');
    }

    if (objword != null) {
        objword.Visible = true;
        objword.Documents.Open(file);
        objword.WindowState = 2;
        objword.WindowState = 1;
    }
}

</script><input type="button" value="ope n" onclick="openWord('Solarsystem.doc')"/><?php
require_once '../PHPWord.php';

$PHPWord = new PHPWord();

$document = $PHPWord->loadTemplate('TenancyAgreementTemplate.docx');

$document->setValue('Value1', 'Kwatuha Alfayo');
$document->setValue('Value2', 'iNDININ INZIRE WMI SENEN');
$document->setValue('Value32', 'pppppppppppppppppppppppppppppppppp');
$document->setValue('Value32', 'Kende in the cuttttttttttttttttttttttt');



/*$document->setValue('weekday', date('l'));
$document->setValue('time', date('H:i'));*/

$document->save('semaDickin.doc');
?>