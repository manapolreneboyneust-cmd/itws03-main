<?php



function basePath($path = '')
{
    return __DIR__ . '/' . $path;
}


function baseUrl($path = '')
{
    $base = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
    $base = rtrim($base, '/');

    if ($base === '' || $base === '/' || $base === '.') {
        $base = '';
    }

    if ($path === '') {
        return $base === '' ? '/' : $base . '/';
    }

    return $base . '/' . ltrim($path, '/');
}



function loadView($name, $data = [])
{
    $viewPath = basePath("App/views/{$name}.view.php");

    if (file_exists($viewPath)) {
        extract($data);
        require $viewPath;
    } else {
        echo "View '{$name}' not found.";
    }
}



function loadPartial($name, $data = [])
{
    $partialPath = basePath("App/views/partials/{$name}.php");

    if (file_exists($partialPath)) {
        extract($data);
        require $partialPath;
    } else {
        echo "Partial '{$name}' not found.";
    }
}

function formatSalary($salary)
{
    return '₱' . number_format(floatval($salary));
}

function inspectAndDie($value)
{
    echo '<pre>';
    die(var_dump($value));
    echo '</pre>';
}



function sanitize($dirty)
{
    return filter_var(trim($dirty), FILTER_SANITIZE_SPECIAL_CHARS);
}


function redirect($url)
{
    if (!preg_match('/^https?:\/\//i', $url)) {
        $url = baseUrl(ltrim($url, '/'));
    }

    header("Location: {$url}");
    exit;
}
