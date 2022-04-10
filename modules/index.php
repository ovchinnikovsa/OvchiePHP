<?php

function dd($var)
{
    var_dump($var);
    die();
}

function post($key, $value = 'not defined')
{
    if ($value === 'not defined') {
        return $_POST[$key] ?? null;
    }
    $_POST[$key] = $value;
}

function session($key, $value = 'not defined')
{
    if ($value === 'not defined') {
        return $_SESSION[$key] ?? null;
    }
    $_SESSION[$key] = $value;
}

function session_clear_value($key): void
{
    unset($_SESSION[$key]);
}

function cfrs_set(): string
{
    $hash = time() + CFRS_TIME;
    session('cfrs_time', $hash);
    $hash = md5($hash . SALT);
    session('cfrs', $hash);

    ob_start();
    ?>
<input type="hidden" name="csrf" value="<?php echo $hash; ?>">
<?php
return ob_get_clean();
}

function cfrs_check(): void
{
    $post_csfr_time = session('cfrs_time') ?? 0;
    $post_csfr = session('cfrs') ?? '';

    if ($post_csfr !== session('cfrs') || $post_csfr_time < time()) {
        set_message('Время токена безопасности истекло');
    }

    session_clear_value('cfrs_time');
    session_clear_value('cfrs');
}

function redirect(string $path): void
{
    header('Location: http://' . $_SERVER['SERVER_NAME'] . $path);
    die();
}

function set_message(string $message, bool $error = true): void
{
    session('error', $error);
    session('message', $message);
    session('show_modal', true);
    redirect('/');
}

function show_message()
{
    $is_error = session('error') ?? false;
    $message = session('message') ?? false;
    session_clear_value('error');
    session_clear_value('message');
    session_clear_value('show_modal');

    if ($message) {
        ob_start();
        ?>
<p class="<?php echo $is_error ? 'error-message' : 'succsess-message'; ?>"><?php echo $message; ?></p>
<?php
return ob_get_clean();
    }
}

function escape($value)
{
    return htmlentities($value, ENT_QUOTES, "UTF-8");
}

function escape_db($value)
{
    global $mysqli;
    return "'" . $mysqli->real_escape_string($value) . "'";
}

function db_query(string $sql)
{
    global $mysqli;
    return $mysqli->query($sql);
}

function db_insert_model($name, $telegram, $phone)
{
    $sql = 'INSERT INTO `models` (`name`, `telegram`, `phone`)
    VALUES (' . escape_db($name) . ', ' . escape_db($telegram) . ', ' . escape_db($phone) . ')';
    return db_query($sql);
}