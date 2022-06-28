<?php
/**
 * Реализовать проверку заполнения обязательных полей формы в предыдущей
 * с использованием Cookies, а также заполнение формы по умолчанию ранее
 * введенными значениями.
 */

// Отправляем браузеру правильную кодировку,
// файл index.php должен быть в кодировке UTF-8 без BOM.
header('Content-Type: text/html; charset=UTF-8');

// В суперглобальном массиве $_SERVER PHP сохраняет некторые заголовки запроса HTTP
// и другие сведения о клиненте и сервере, например метод текущего запроса $_SERVER['REQUEST_METHOD'].
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  // Массив для временного хранения сообщений пользователю.
  $messages = array();

  // В суперглобальном массиве $_COOKIE PHP хранит все имена и значения куки текущего запроса.
  // Выдаем сообщение об успешном сохранении.
  if (!empty($_COOKIE['save'])) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('save', '', 100000) ;
    // Если есть параметр save, то выводим сообщение пользователю.
    $messages[] = 'Спасибо, результаты сохранены!';
  }

  // Складываем признак ошибок в массив.
  $errors = array();
  $errors['name'] = !empty($_COOKIE['name_error']);
  $errors['email'] = !empty($_COOKIE['email_error']);
  $errors['year_of_birth'] = !empty($_COOKIE['year_of_birth_error']);
  $errors['gender'] = !empty($_COOKIE['gender_error']);
  $errors['number_of_limbs'] = !empty($_COOKIE['number_of_limbs_error']);
  $errors['superpowers-3'] = !empty($_COOKIE['superpowers-3_error']);
  $errors['biography'] = !empty($_COOKIE['biography_error']);
  $errors['policy'] = !empty($_COOKIE['policy_error']);
  
  // TODO: аналогично все поля.

  // Выдаем сообщения об ошибках.
  if ($errors['name']) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('name_error', '', 100000);
    // Выводим сообщение.
    $messages[] = '<div class="error">Вы не заполнили имя!</div>';
  }
    if ($errors['email']) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('email_error', '', 100000);
    // Выводим сообщение.
    $messages[] = '<div class="error">Вы не заполнили e-mail!</div>';
  }
    if ($errors['year_of_birth']) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('year_of_birth_error', '', 100000);
    // Выводим сообщение.
    $messages[] = '<div class="error">Вы не выбрали год!</div>';
  }
    if ($errors['gender']) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('gender_error', '', 100000);
    // Выводим сообщение.
    $messages[] = '<div class="error">Вы не указали пол!</div>';
  }
      if ($errors['number_of_limbs']) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('number_of_limbs_error', '', 100000);
    // Выводим сообщение.
    $messages[] = '<div class="error">Вы не указали количество конечностей!</div>';
  }
      if ($errors['superpowers-3']) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('superpowers-3_error', '', 100000);
    // Выводим сообщение.
    $messages[] = '<div class="error">Вы не указали сверхспособности!</div>';
  }
      if ($errors['biography']) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('biography_error', '', 100000);
    // Выводим сообщение.
    $messages[] = '<div class="error">Вы не рассказали о себе!</div>';
  }
    if ($errors['policy']) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('policy_error', '', 100000);
    // Выводим сообщение.
    $messages[] = '<div class="error">Вы не рассказали о себе!</div>';
  }
  // TODO: тут выдать сообщения об ошибках в других полях.

  
  
  
  // Складываем предыдущие значения полей в массив, если есть.
  $values = array();
  $values['name'] = empty($_COOKIE['name_value']) ? '' : $_COOKIE['name_value'];
  $values['email'] = empty($_COOKIE['email_value']) ? '' : $_COOKIE['email_value'];
  $values['year_of_birth'] = empty($_COOKIE['year_of_birth_value']) ? '' : $_COOKIE['year_of_birth_value'];
  $values['gender'] = empty($_COOKIE['gender_value']) ? '' : $_COOKIE['gender_value'];
  $values['number_of_limbs'] = empty($_COOKIE['number_of_limbs_value']) ? '' : $_COOKIE['number_of_limbs_value'];
  $values['superpowers-3'] = empty($_COOKIE['superpowers-3_value']) ? '' : $_COOKIE['superpowers-3_value'];
  $values['biography'] = empty($_COOKIE['biography_value']) ? '' : $_COOKIE['biography_value'];
  $values['policy'] = empty($_COOKIE['policy_value']) ? '' : $_COOKIE['policy_value'];
  // TODO: аналогично все поля.

  // Включаем содержимое файла form.php.
  // В нем будут доступны переменные $messages, $errors и $values для вывода 
  // сообщений, полей с ранее заполненными данными и признаками ошибок.
  include('form.php');
}
// Иначе, если запрос был методом POST, т.е. нужно проверить данные и сохранить их в XML-файл.
else {
  // Проверяем ошибки.
  $errors = FALSE;
  if (empty($_POST['name'])) {
    // Выдаем куку на день с флажком об ошибке в поле name.
    setcookie('name_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    // Сохраняем ранее введенное в форму значение на месяц.
    setcookie('name_value', $_POST['name'], time() + 30 * 24 * 60 * 60);
  }
  if (empty($_POST['email'])) {
    // Выдаем куку на день с флажком об ошибке в поле fio.
    setcookie('email_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    // Сохраняем ранее введенное в форму значение на месяц.
    setcookie('email_value', $_POST['email'], time() + 30 * 24 * 60 * 60);
  }
  if ($_POST['year_of_birth'] == "default") {
    // Выдаем куку на день с флажком об ошибке в поле fio.
    setcookie('year_of_birth_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    // Сохраняем ранее введенное в форму значение на месяц.
    setcookie('year_of_birth_value', $_POST['year_of_birth'], time() + 30 * 24 * 60 * 60);
  }
  if (empty($_POST['gender'])) {
    // Выдаем куку на день с флажком об ошибке в поле fio.
    setcookie('gender_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    // Сохраняем ранее введенное в форму значение на месяц.
    setcookie('gender_value', $_POST['gender'], time() + 30 * 24 * 60 * 60);
  }
  if (empty($_POST['number_of_limbs'])) {
    // Выдаем куку на день с флажком об ошибке в поле fio.
    setcookie('number_of_limbs_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    // Сохраняем ранее введенное в форму значение на месяц.
    setcookie('number_of_limbs_value', $_POST['number_of_limbs'], time() + 30 * 24 * 60 * 60);
  }
  if (empty($_POST['superpowers-3'])) {
    // Выдаем куку на день с флажком об ошибке в поле fio.
    setcookie('superpowers-3_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    // Сохраняем ранее введенное в форму значение на месяц.
    setcookie('superpowers-3_value', $_POST['superpowers-3'], time() + 30 * 24 * 60 * 60);
  }
  if (empty($_POST['biography'])) {
    // Выдаем куку на день с флажком об ошибке в поле fio.
    setcookie('biography_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    // Сохраняем ранее введенное в форму значение на месяц.
    setcookie('biography_value', $_POST['biography'], time() + 30 * 24 * 60 * 60);
  }
  if (empty($_POST['policy'])) {
    // Выдаем куку на день с флажком об ошибке в поле fio.
    setcookie('policy_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    // Сохраняем ранее введенное в форму значение на месяц.
    setcookie('policy_value', $_POST['policy'], time() + 30 * 24 * 60 * 60);
  }

// *************
// TODO: тут необходимо проверить правильность заполнения всех остальных полей.
// Сохранить в Cookie признаки ошибок и значения полей.
// *************

  if ($errors) {
    // При наличии ошибок перезагружаем страницу и завершаем работу скрипта.
    header('Location: index.php');
    exit();
  }
  else {
    // Удаляем Cookies с признаками ошибок.
    setcookie('name_error', '', 100000);
    setcookie('email_error', '', 100000);
    setcookie('year_of_birth_error', '', 100000);
    setcookie('gender_error', '', 100000);
    setcookie('number_of_limbs_error', '', 100000);
    setcookie('superpowers-3_error', '', 100000);
    setcookie('biography_error', '', 100000);
    setcookie('policy_error', '', 100000);
    
    // TODO: тут необходимо удалить остальные Cookies.
  }

  // Сохранение в БД.
    $user = 'u47552';
    $pass = '1337327';
    $db = new PDO('mysql:host=localhost;dbname=u47552', $user, $pass, array(PDO::ATTR_PERSISTENT => true));

// Подготовленный запрос. Не именованные метки.
try {
    $stmt = $db->prepare("INSERT INTO us SET name = ?, email = ?, year_of_birth = ?, gender = ?, number_of_limbs = ?, biography = ?");
    $stmt->execute(array(
         $_POST['name'],
         $_POST['email'],
         $_POST['year_of_birth'],
         $_POST['gender'],
         $_POST['number_of_limbs'],
         $_POST['biography'],
    ));  
   
    $stmt = $db->prepare("INSERT INTO supers SET name = ?");
    $stmt->execute(array(
        $_POST['superpowers-3'] = implode(', ', $_POST['superpowers-3']),
    ));
} 
catch (PDOException $e) {
    print('Error : ' . $e->getMessage());
    exit();
}

  // Сохраняем куку с признаком успешного сохранения.
  setcookie('save', '1');

  // Делаем перенаправление.
  header('Location: index.php');
}