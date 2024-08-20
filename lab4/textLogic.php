<?php
use DiDom\Document;

require_once($_SERVER['DOCUMENT_ROOT'] . '/Project/vendor/autoload.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/Project/lab4/presets.php');
function convertText(): array
{
    $html = '';
    if (array_key_exists('task', $_POST)) {
        $html = $_POST['task'];
    }
    if (!$html) {
        return array();
    }

    $result = array();

    $result['task_1'] = task_1($html);
    $html = task_7($html);
    $result['task_11'] = task_11($html);
    $html = task_16($html, array('пух', 'рот', 'делать', 'ехать', 'около', 'для', 'Винни-Пух'));
    $result['tasks'] = $html;
    return $result;
}

function task_1(string $html): string
{
    $result = '';
    $count = preg_match_all('/<h[1-2][\s\S]*>([\s\S]*)<\/h[1-2]>/muU', $html, $headers);

    if ($count != 0) {
        $result .= '<ol>';
        $listLvl = null;
        for ($i = 0; $i < $count; $i++) {
            if (mb_strpos($headers[0][$i], 'h1') !== false) {
                if ($listLvl === 2) {
                    $result .= '</ol>';
                }
                $listLvl = 1;
            } elseif (mb_strpos($headers[0][$i], 'h2') !== false) {
                if ($listLvl === 1) {
                    $result .= '<ol>';
                }
                $listLvl = 2;
            }
            $result .= '<li>';
            $result .= $headers[1][$i];
            $result .= '</li>';
        }

        if ($listLvl === 2) {
            $result .= '</ol>';
        }

        $result .= '</ol>';
    }
    return $result;
}

function task_7(string $html): string
{
    $searchingSigns = array("!", '.', '?');
    foreach ($searchingSigns as $sign) {
        $safeSign = quotemeta($sign);
        $html = preg_replace("/$safeSign{4,}/mu", str_pad('', 3, $sign), $html);
    }

    return $html;
}

function task_11($html): string
{
    $result = '';
    global $headerCount;
    $headerCount = 1;
    $html = preg_replace_callback('/<h[1-3][\s\S]*>[\s\S]*<\/h[1-3]>/muU', 'task_11_callback', $html);
    $count = preg_match_all('/<h[1-3][\s\S]*>([\s\S]*)<\/h[1-3]>/muU', $html, $headers);

    if ($count != 0) {
        $result .= '<ol>';
        $listLvl = null;
        for ($i = 0; $i < $count; $i++) {
            if (mb_strpos($headers[0][$i], 'h1') !== false) {
                if ($listLvl === 2) {
                    $result .= '</ol>';
                }
                $listLvl = 1;
            } elseif (mb_strpos($headers[0][$i], 'h2') !== false) {
                if ($listLvl === 1) {
                    $result .= '<ol>';
                }
                $listLvl = 2;
            }

            preg_match('/<h[1-3][\s\S]*id="([\s\S]*)"[\s\S]*>/muU', $headers[0][$i], $id);
            $id = $id[1];

            $result .= "<li><a href=\"#$id\">";
            $result .= $headers[1][$i];
            $result .= '</a></li>';
        }

        if ($listLvl === 2) {
            $result .= '</ol>';
        }

        $result .= '</ol>';
    }
    return $result . $html;
}

function task_11_callback($matches)
{
    $tag = mb_substr($matches[0], 0, mb_strpos($matches[0], '>'));
    if (mb_strpos($tag, 'id=') === false) {
        global $headerCount;
        $matches[0] = substr_replace($matches[0], " id=\"$headerCount\"", 3, 0);
        $headerCount += 1;
    }

    return $matches[0];
}

function task_16(string $html, array $tabooWords)
{
    $html = ' ' . $html;
    $regWords = array();
    foreach ($tabooWords as $word) {
        $regWords[] = quotemeta($word);
    }

    $regWords = '(' . implode("|", $regWords) . ')';
    
    //$html = str_ireplace(' '.$word, str_pad(' ', mb_strlen($word) + 1, "#"), $html);   //Плохо работает с русским текстом
    $html = preg_replace_callback("/\s$regWords/mui", 'task_16_callback', $html);

    return substr($html, 1);
}

function task_16_callback($matches)
{
    return ' '.str_repeat('#', mb_strlen($matches[1]));
}

function presets(): void
{
    if (!array_key_exists('preset', $_GET)) {
        return;
    }

    $text = '';
    switch ($_GET['preset']) {
        case 1:
            $text = preset1();
            break;
        case 2:
            $text = preset2();
            break;
        case 3:
            $text = preset3();
            break;
    }

    $_POST['task'] = $text;
}