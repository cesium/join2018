<?php

// Nome: recolhe_cv.php
// Invocada por: submissao_cv.html
//
// Objectivo: recolher o cv
//
// obter ip do cliente
if(getenv("HTTP_CLIENT_IP")) {
    $ipaddress = getenv("HTTP_CLIENT_IP");
} elseif(getenv("HTTP_X_FORWARDED_FOR")) {
    $ipaddress = getenv("HTTP_X_FORWARDED_FOR");
} else {
    $ipaddress = getenv("REMOTE_ADDR");
}

$caminho="/var/www/html/site_join_cv/";

// em debug
$debug=0;
$email_debug="jose@di.uminho.pt";

// variaveis
$url="http://join.di.uminho.pt";
$flag=0;
$ficheiro_log_cv_falhas="cv_join2016_falhas.csv";
$ficheiro_log_cv="cv_join2016.csv";


// obter dados do formulario
$email = $_POST['email'];
$nome = $_POST['nome'];
$ficheiro_cv = $_POST['ficheiro_cv'];

$mensagem='';
$mensagem_log='Faltam preencher os campos:';

// confirmar que os campos necessarios foram preenchidos
if ($email=='') {
	$mensagem='<h4>Error: É necessário preencher o campo <b>email</b>!</h4>';
	$mensagem_log .= ">email";
    	$flag=1;
}
if ($nome=='') {
	$mensagem .='<h4>Error: É necessário preencher o campo <b>nome</b>!</h4>';
	$mensagem_log .= ">nome";
    	$flag=1;
}
if ($_FILES['ficheiro_cv']['name']=='') {
	$mensagem .='<h4>Error: É necessário indicar o <b>ficheiro com o CV</b>!</h4>';
	$mensagem_log .= ">CV";
    	$flag=1;
}

if ($flag==1) {
	echo "<html>\n";
	echo "<head>\n";
	echo "</head>\n";
	# corpo
        echo "<body bgcolor=\"#E6E6FA\">\n";
        echo "<center>\n";
        echo "<h1>Departamento de Informática</h1>\n";
        echo "<br>\n";
        echo "<br>\n";
        echo "<body bgcolor=\"#E6E6FA\">\n";
        echo "<br><br>";
        # corpo
        echo "<center>\n";
        echo "<h2>Join2016-Submissão do <i>Curriculum Vitae</i></h2>";
	echo "$mensagem\n";
        echo "</center>\n";
    	$data_log = date("M d Y H:i:s");
    	$ficheiro_csv = fopen($caminho . $ficheiro_log_cv_falhas,"a");
    	while (! flock($ficheiro_csv, LOCK_EX)) { // fazer o lock ao ficheiro
    	}
    	fwrite($ficheiro_csv,$data_log . ",$ipaddress,$mensagem_log\n");
    	flock($ficheiro_csv, LOCK_UN); // libertar lock
    	fclose($ficheiro_csv);
	echo "<br><br><br>";
	echo "Por favor, <a href=\"javascript: history.back()\">volte</a> atrás no <i>browser</i> e volte a submeter. Obrigado.";
	echo "</center>";
	echo "</body>\n";
	echo "</html>\n";
	exit(10);
}

// gerar referencia para este registo
$reference=uniqid(true);
// ufa passou todos os testes
// guardar os ficheiros de upload
$filename = $_FILES['ficheiro_cv']['name'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);
$target_cv = $caminho . "uploads/" . "cv_" . "aluno_" . $email . "_" . $reference . ".$ext";
$nome_ficheiro_cv="cv_" . "aluno_" . $email . "_" . $reference . ".$ext";

$flag=0;
if (move_uploaded_file($_FILES['ficheiro_cv']['tmp_name'], $target_cv)) {
	$mensagem="Submissão do CV com sucesso";
	$mensagem_log="$ipaddress,$reference,$email,$nome,$nome_ficheiro_cv";
	$data_log = date("M d Y H:i:s");
	$ficheiro_csv = fopen($caminho . $ficheiro_log_cv,"a");
	while (! flock($ficheiro_csv, LOCK_EX)) { // fazer o lock ao ficheiro
	}
	fwrite($ficheiro_csv,$data_log . ",$mensagem_log\n");
	flock($ficheiro_csv, LOCK_UN); // libertar lock
	fclose($ficheiro_csv);
} else {
	$flag=1;
	$mensagem="Problemas ao fazer o upload do seu ficheiro {$_FILES['ficheiro_cv']['name']}";
	$mensagem_log="Problemas ao fazer o upload do seu ficheiro {$_FILES['ficheiro_cv']['name']}";
	$data_log = date("M d Y H:i:s");
	$ficheiro_csv = fopen($caminho . $ficheiro_log_cv_falhas,"a");
	while (! flock($ficheiro_csv, LOCK_EX)) { // fazer o lock ao ficheiro
	}
	fwrite($ficheiro_csv,$data_log . ",$ipaddress,$email,$zip, problemas a fazer upload do ficheiro\n");
	flock($ficheiro_csv, LOCK_UN); // libertar lock
	fclose($ficheiro_csv);
}

echo "<html>\n";
echo "<head>\n";
echo "</head>\n";
# corpo
echo "<body bgcolor=\"#E6E6FA\">\n";
echo "<center>\n";
echo "<h1>Departamento de Informática</h1>\n";
echo "<br>\n";
echo "<br>\n";
echo "<body bgcolor=\"#E6E6FA\">\n";
echo "<br><br>";
# corpo
echo "<center>\n";
echo "<h2>Join2016-Submissão do <i>Curriculum Vitae</i></h2>";
if ($flag==0) {
	echo "$mensagem\n";
	echo "</center>\n";
} else {
	echo "$mensagem\n";
	echo "<br><br><br>";
	echo "Por favor, <a href=\"javascript: history.back()\">volte</a> atrás no <i>browser</i> e volte a submeter. Obrigado.";
	echo "</center>";
}
echo "</body>\n";
echo "</html>\n";
exit(0);


// fim da script
?>
                                                                                                                                                                                                                            339,2         Bot
