<?php

// ЗАГОТОВКА ПОД CRUD

// Save form data to DB
$errors = array();

// Удаление фильма
if ( @$_GET['action'] == 'delete' ) {
	$query = "DELETE FROM films WHERE id = '" . mysqli_real_escape_string($link, $_GET['id']) . "' LIMIT 1";
	mysqli_query($link, $query);

	if ( mysqli_affected_rows($link) > 0) {
		$resultInfo = "<p>Фильм был удален!</p>";
	} else {
		$resultError = "<p>Что-то пошло не так.</p>";
	}	
}

// Save form data to DB
// Save form data to DB
if ( array_key_exists('newFilm', $_POST) ) {
	
	// Обработка ошибок
	if ( $_POST['title'] == '' ) {
		$errors[] = "<p>Необходимо ввести название фильма!</p>";
	}
	if ( $_POST['genre'] == '' ) {
		$errors[] = "<p>Необходимо ввести жанр фильма!</p>";
	}
	if ( $_POST['year'] == '' ) {
		$errors[] = "<p>Необходимо ввести год фильма!</p>";
	}

	// Если ошибок нет - сохраняем фильм
	if ( empty($errors) ) {
		// Запись данных в БД
		$query = "INSERT INTO films (title, genre, year) VALUES (
		'" . mysqli_real_escape_string($link, $_POST['title']) . "', 
		'" . mysqli_real_escape_string($link, $_POST['genre']) . "', 
		'" . mysqli_real_escape_string($link, $_POST['year']) . "'
		)";

		if ( mysqli_query($link, $query) ) {
			$resultSuccess = "<p>Фильм был успешно добавлен!</p>";
		}
	}	
}
	
// Getting films from DB
$query = "SELECT * FROM `films`";
$films = array();

$result = mysqli_query($link, $query);

if ( $result = mysqli_query($link, $query) ) {
	while ( $row = mysqli_fetch_array($result) ) {
		$films[] = $row;
	}
}
?>