
<!DOCTYPE HTML>
<HTML>
<TILE>
</TIILE>
<BODY>
<?php
session_start();
ob_clean();
if ($_SESSION["admin"] == 1)
{
    include 'admin_meniu_s.php';
    echo" <style>
        body {
            background-image: url();
            height: 400px;
            background-position: center;
            background-repeat: no-repeat, repeat;
            background-size: auto;
            position: relative;
        }</style>";
}else
{
    include 'user_meniu.php';
}

?>
<br>
<center><h1>SCHEMA VACCINARE PENTRU PISICI</h1></center>
<br>
<center>
<table border="1" width="806" height="415">
	<tr>
		<td>
		Vaccinarea de baza impotriva panleucopeniei,infectiei cu virusul herpetic si
a calicivirozei D o u a v a c c i n a r i l a u n i n t e r v a l d e 3 – 4 saptamani. Vaccinarea primara cu
o doza de vaccin FeliBio PCH la pisoii avand varsta de 8 – 10 saptamani si vaccinare cu o doza de vaccin FeliBio PCHR de la varsta de peste 3 luni
		</td>
		<td>
		Vaccinarea de baza impotriva dermatofitozei Vaccinarea profilactica se efectueaza de la
varsta de douasprezece saptamani. Pisicile vaccinate primar trebuie vaccinate o data in
intervalul de 14 – 21 zile. in cazul vaccinarii terapeutice, daca este necesar, se mai poate
aplica o alta doza de vaccin (a treia), la 18 – 24 zile de la revaccinare.
		</td>
	</tr>
	<tr>
		<td colspan="2">
		<center>Revaccinarea</center>
        <br>Urmatoarele revaccinari regulate cu vaccinul FeliBio PCH, FeliBio PCHR sau Biocan M se
efectueaza in intervale de cate 12 luni.
        <center>Dozarea si metoda de aplicare</center>
        <br>Doza vaccinului FeliBio este intotdeauna de un ml, indiferent de varsta, masa sau rasa
animalului, vaccinarea primara efectuandu-se prima data la varsta de opt saptamani.
Vaccinul Biocan M este destinat pisoilor avand varsta de peste douasprezece saptamani, cu
aplicare subcutanata, in zona de dupa omoplat, sau intramuscular in muschiul membrului.
Se recomanda efectuarea vaccinarii primare in jumatatea stanga iar a vaccinarii in jumatatea
dreapta a corpului.
		</td>
	</tr>
	<td colspan="2">
	<p align="center">Reactii adverse (frecventa si gravitate)</p>
        <br>La locul de vaccinare pot avea loc reactii locale rezonabile (de regula, de marimea unui bob
de mazare), care dispar dupa cel mult 3 saptamani. in mod exceptional, pot aparea si reactii
de hipersensibilitate.
	</td>
</table></center>

</BODY>
</HTML>
