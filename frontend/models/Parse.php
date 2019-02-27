<?php
/**
 * Created by PhpStorm.
 * User: slavko
 * Date: 27.02.2019
 * Time: 15:00
 */

namespace frontend\models;

use Yii;
use yii\base\Model;

class Parse extends Model
{
    /**
     * @param string $value '2015.09.15 23:26:35'
     * @return false|int
     */
    private static function parseDate($value)
    {
        $dt = explode(' ',$value);
        $d = explode('.',$dt[0]);
        $t = explode(':',$dt[1]);
        return mktime($t[0],$t[1],$t[1],$d[1],$d[2],$d[0]);
    }

    /**
     * @param string $html content with table
     * @return array
     */
    public static function getParsing($html)
    {
        $doc = new \DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTML($html);
        libxml_use_internal_errors(false);

        $xp = new \DOMXPath($doc);
        $expression = '//table/tr';
        $rows = [];
        $i = 0;
        foreach ($xp->query($expression) as $node){
            foreach ($xp->query('td', $node) as $r){
                $rows[$i][] = $r->nodeValue;
            }
            $i++;
        }
        $table = [];
        $profit = 0;
        foreach ($rows as $row){
            if (isset($row[2]) and $row[2] == 'balance'){
                $profit = floatval($row[4]);
                $time = self::parseDate($row[1]);
                $table[$time] = [
                    'type' => $row[2],
                    'time' => $time,
                    'date' => date('d.m.Y H:i:s',$time),
                    'profit' => $profit,
                    'delta' => 0,
                ];
            } elseif (isset($row[2]) and $row[2] == 'buy'){
                if (isset($row[10])){
                    $delta = floatval($row[13]);
                    $profit += $delta;
                    $time = self::parseDate($row[1]);
                    $table[$time] = [
                        'type' => $row[2],
                        'time' => $time,
                        'date' => date('d.m.Y H:i:s',$time),
                        'profit' => $profit,
                        'delta' => $delta,
                    ];
                }
            }
        }
        ksort($table);

        return $table;
    }

}