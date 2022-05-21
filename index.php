<?php


require 'vendor/autoload.php';

use Frugone\Period\Period;
use Frugone\Period\TimeZone;
use Carbon\Carbon;


$period = Period::create( '2022-05-17 07:21:24', '2022-05-17 09:21:24');
$period->convertToTimezone(Period::TZ_UY);
pr($period);

$period = Period::create( '2022-05-17 07:21:24', '2022-05-17 09:21:24');
$period->toTimezone(Period::TZ_UTC, Period::TZ_UY);

pr($period);

echo '<hr>';



die;

title('Perdiodo de 120 minutos en zona horaria de Uruguay');
code('$period = Period::minutes(120)->toTimezone( Period::TZ_UY);');
code( 'print_r($period);');

$period = Period::minutes(120)->toTimezone( Period::TZ_UY);
echo $period;
line();


title('Perdiodo de fecha de dos meses');
code('$period = Period::months(2);') ;
code('echo $period; ') ;

$period = Period::months(2);
pr( $period->getDiffToString() );


pr( $period->toArray() );
line();

title('Perdiodo de fecha de dos años');
code('$period = Period::years(2)');
code('echo $period; ') ;
$period = Period::years(2);
result( $period );
line();


title('Periodo de 3 semanas anteriores y dos posteriores');
code('$period = Period::weeks(3,2);');
code('echo $period; ') ;
$period = Period::weeks(3,2);
result( $period );
line();


title('cambiar el formato en que se muestran las fechas');
code('$period = Period::months(2);') ;
$period = Period::months(2);
code('echo $period; ') ;
result( $period );
code('$period->outputFormat = \'Y-m-d\';') ;

space();
$period->outputFormat = 'Y-m-d';
code('echo $period; ') ;
result( $period );

line();

title('Setear time zone de salida');
text('Timezone España');
code('$period = Period::months(2);') ;
code( 'print_r($period);');

$period = Period::months(2);
resultPrint($period);

text('Timezone Uruguay');
code('$period->toTimezone(Period::TZ_UY);');
code( 'print_r($period);');

$period->toTimezone(Period::TZ_UY);
resultPrint($period);


line();

text('Supongamos que los usuarios ingresan un rango de fechas para una busqueda en un listado,  el usuario ingresará las fechas en su zona horaria
	pero en la DB los datos están guardados en UTC,
	Podemos crear el objeto Period  y convertir las fechas a UTC indicando en que timezone fueron ingresadas ');

text('Indicando en que timezone fueron ingresadas las fechas podemos convertir estas fechas al timezone adecuado ( por defecto UTC ) para realizar consultas en la db por ejemplo');


text('Ingreso fechas en zona horaria de Uruguay');
code( '$period = Period::create( \'2021-11-05 13:56\', \'2021-11-09 13:56:39\');');
text('Convierto las fechas a UTC');
code( '$period->convertToTimezone(Period::TZ_UY);');
code( 'print_r($period);');

$period = Period::create( '2021-11-05 13:56', '2021-11-09 13:56:39');
$period->convertToTimezone(Period::TZ_UY);
resultPrint($period);

line();

title('funciones utiles para crear graficas');

text('Si queremos graficar los valores de un mes en intervalos de 2 dias');

code('$period = Period::months(1);');
code('$range = $period->getDatePeriodByTime( 2 , \'day\');' );
space();
code('foreach( $range as $step ){');
code('&nbsp;&nbsp;&nbsp; print_r($step->format(\'Y-m-d\'));');
code('}');

$period = Period::months(1);
$range = $period->getDatePeriodByTime( 2 , 'day');
foreach( $range as $step ){
	pr($step->format('Y-m-d'));
}

text('Si queremos obtener un rango de fechas en una cantidad determina de pasos, por ejemplo 7');

code('$range = $period->getDatePeriod(7);');
code('foreach( $range as $step ){');
code('&nbsp;&nbsp;&nbsp; print_r($step->format(\'Y-m-d H:i:s\'));');
code('}');

$range = $period->getDatePeriod(7);
foreach( $range as $step ){
	pr($step->format('Y-m-d H:i:s'));
}

/***********/
// Functions
/***********/

function space(){
	echo "<br>";
}
function line(){
	echo "<hr>";
}

function code($code, $lineBreak=true ){
	echo '<code>'. $code .'</code> ';
	if($lineBreak) echo '<br>';
}

function title($title){
	echo '<p><b>'.ucfirst($title).'</b></p>';
}

function text($text){
	echo '<p>'.$text.'</p>';
}

function result($result){
	echo '<br>'.$result.'<br>';
}

function resultPrint($result){
	echo pr($result);
}

function prd($obj){
		pr($obj);
		die();
	}

	function pr($obj){
		echo "<pre>";
		print_r($obj);
		echo "</pre>";
	}