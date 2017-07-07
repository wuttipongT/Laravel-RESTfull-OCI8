<?php

namespace App\Api\V1\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class MenuController extends Controller
{
    //
    public function index($id){

      $sql_text = "
                  SELECT SECTIONS.MENU_CAT_NAME SECTION,
                        '[ '|| ITEMS.MENU_ID ||' ]'||' ' || ITEMS.MENU_NAME NAME,
                        ITEMS.MENU_ID COMPONENT
                  FROM
                  SFC_MENU_SECTIONS SECTIONS
                  INNER JOIN SFC_MENU_ITEMS ITEMS ON
                  ITEMS.MENU_BASED = SECTIONS.MENU_CAT_BASED
                  AND ITEMS.MENU_CAT = SECTIONS.MENU_CAT_ID
                  WHERE SECTIONS.MENU_CAT_BASED = {$id}
                  ORDER BY SECTIONS.MENU_ORDER,ITEMS.MENU_ORDER";

      return DB::select($sql_text);
    }
}
