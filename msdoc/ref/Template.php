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

$document = $PHPWord->loadTemplate('Template.docx');
$document->setValue('mulinami', 'Kwatuha is ab rigt fu');
$document->setValue('Value1', 'my di ggggggggggggggggggggggggggggggggggggggggggggggg');
$document->setValue('Value2', 'Mercury');
$document->setValue('Value3', 'Venus');
$document->setValue('Value4', 'Earth');
$document->setValue('Value5', 'Mars');
$document->setValue('Value6', 'Jupiter');
$document->setValue('Value7', 'Saturn');
$document->setValue('Value8', 'Uranus');
$document->setValue('Value9', 'Neptun');
$document->setValue('Value10', 'Pluto');

$document->setValue('weekday', date('l'));
$document->setValue('time', date('H:i'));

$document->save('We_Solarsystem.doc');
?>