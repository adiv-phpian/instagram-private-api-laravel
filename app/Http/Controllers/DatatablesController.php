<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request,
    App\Http\Requests,
    \Lang,
    \Hash,
    App\Datatables\Editor\Editor,
    App\Datatables\Database\Database,
    App\Datatables\Editor\Field,
	  App\Datatables\Editor\Format,
	  App\Datatables\Editor\Mjoin,
	  App\Datatables\Editor\Options,
	  App\Datatables\Editor\Upload,
	  App\Datatables\Editor\Validate,
	  App\Datatables\Editor\Validate\Options as ValidateOptions,
		App\Datatables\Ext\Ext,
    Cartalyst\Sentinel\Native\Facades\Sentinel;

class DatatablesController extends Controller
{
    //

    public $db;

    public function __construct()
    {
      $config = \Config::get('database');
      $default = $config['default'];
      $driver = $config['connections'][$default];

      $sql_details = array(
        "type" => "Mysql",
        "user" => $driver['username'],
        "pass" => $driver['password'],
        "host" => $driver['host'],
        "port" => $driver['port'],
        "db"   => $driver['database'],
        "dsn"  => "",
        "pdoAttr" => array()
      );

      $this->db = new Database($sql_details);
    }

    public function users(Request $request){


      $columns = array('id',
          'user_info',
          'updated_at',
          'created_at');



    foreach($columns as $column){
      $fields[] = Field::inst( $column );
    }

     // Build our Editor instance and process the data coming from _POST
     return $this->convert_from_latin1_to_utf8_recursively(
       Editor::inst( $this->db, 'i_p_models' )
       ->fields($fields)
       ->process( $_POST )
       ->to_array()
     );

   }


   public function proxies(Request $request){


     $columns = array('ip',
         'port',
         'username',
         'password',
         'created_at');


   foreach($columns as $column){
     $fields[] = Field::inst( $column );
   }

   if($request->action == "create") $fields[] = Field::inst( 'created_at' )->setValue(date("Y-m-d H:i:s"));

    // Build our Editor instance and process the data coming from _POST
    return $this->convert_from_latin1_to_utf8_recursively(
      Editor::inst( $this->db, 'ip_lists' )
      ->fields($fields)
      ->process( $_POST )
      ->to_array()
    );

  }


 /**
 * Encode array from latin1 to utf8 recursively
 * @param $dat
 * @return array|string
 */
   public static function convert_from_latin1_to_utf8_recursively($dat)
   {
      if (is_string($dat)) {
         return utf8_encode($dat);
      } elseif (is_array($dat)) {
         $ret = [];
         foreach ($dat as $i => $d) $ret[ $i ] = self::convert_from_latin1_to_utf8_recursively($d);

         return $ret;
      } elseif (is_object($dat)) {
         foreach ($dat as $i => $d) $dat->$i = self::convert_from_latin1_to_utf8_recursively($d);

         return $dat;
      } else {
         return $dat;
      }
   }

}
