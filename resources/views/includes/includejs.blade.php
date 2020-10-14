<?php
/**
 * @var string $url
 * @var array $params
 */
$path = base_path('resources/views/' . $url);
$content = file_get_contents($path);
if (isset($params)) {
    foreach ($params as $key => $value) {
        if (is_array($value)) {
            $content = str_replace($key, json_encode($value), $content);
        } else
            $content = str_replace($key, $value, $content);
    }
}
?>
<script type="text/javascript">{!! $content !!}</script>
