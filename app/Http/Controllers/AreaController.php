<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Area;

class AreaController extends Controller{
    
    private $_area;


    public function __construct(Area $area) {
        $this->_area = $area;
    }
    /*lista os totais*/
    public function index(){
        return response()->json(['total'=>Area::sum('area')]);
    }
    private function _save($post,$is_ret=true){
        /* default */
        $resp = ['retorno' => 'dados inconsistentes','area'=>''];
        if(is_numeric($post['base']) && is_numeric($post['altura'])){
            /* apos validar, formata-se os parametros para o banco em decimal (10,2) */
            $base = number_format((float)$post['base'], 2, '.', '');
            $altura = number_format((float)$post['altura'], 2, '.', '');
            try{
                if($is_ret){
                    /* area retangulo B*A */
                    $area = number_format(round($base * $altura,2), 2, '.', '');
                    $model = new Area(['base'=>$base,'altura'=>$altura,'area'=>$area,'tipo'=>0]);
                }else{
                    /* area triangulo B*A/2 */
                    $area = number_format(round($base * $altura / 2,2), 2, '.', '');
                    $model = new Area(['base'=>$base,'altura'=>$altura,'area'=>$area,'tipo'=>1]);
                }
                $model->save();
                $resp = ['retorno' => 'salvo','area'=>$area];
            } catch (Exception $ex) {
                $resp = ['retorno' => 'dados não foram salvos','area'=>'','ex'=>$ex->getMessage()];
            }
        }
        return $resp;
    }
    /*salva retangulo ja com a área*/
    public function saveRet(Request $request){
        $resp = $this->_save($request->all(), true);
        return response()->json($resp);
    }
    /*salva triangulo ja com a área*/
    public function saveTri(Request $request){
        $resp = $this->_save($request->all(), false);
        return response()->json($resp);
    }
}